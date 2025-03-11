<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ShippingMethod;
use App\Models\PaymentMethod;
use App\Models\Address;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set your Midtrans server key and environment
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index($productId)
    {
        $product = Product::with('member')->findOrFail($productId);
        $shippingMethods = ShippingMethod::all();
        $paymentMethods = PaymentMethod::all();

        // Calculate initial costs
        $subtotal = $product->price * 1000;
        $defaultShipping = 5000;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $defaultShipping + $tax;

        return view('checkout.index', compact(
            'product',
            'subtotal',
            'defaultShipping',
            'tax',
            'total',
            'shippingMethods',
            'paymentMethods'
        ));
    }

    // Previous methods remain unchanged...
    public function saveInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'postal_code' => 'required|string|max:10',
            'product_id' => 'required|exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Store in session for later use
        $request->session()->put('checkout_info', $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Information saved successfully'
        ]);
    }

    public function updateShipping(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_method_id' => 'required|exists:shipping_methods,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $shippingMethod = ShippingMethod::findOrFail($request->shipping_method_id);
        $checkoutInfo = $request->session()->get('checkout_info');
        $checkoutInfo['shipping_method_id'] = $shippingMethod->id;
        $checkoutInfo['shipping_cost'] = $shippingMethod->cost;

        // Update session
        $request->session()->put('checkout_info', $checkoutInfo);

        // Recalculate total
        $product = Product::findOrFail($checkoutInfo['product_id']);
        $subtotal = $product->price * 1000;
        $tax = $subtotal * 0.05;
        $total = $subtotal + $shippingMethod->cost + $tax;

        return response()->json([
            'success' => true,
            'message' => 'Shipping method updated',
            'shipping_cost' => $shippingMethod->cost,
            'total' => $total
        ]);
    }

    public function updatePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_method_id' => 'required|exists:payment_methods,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);
        $checkoutInfo = $request->session()->get('checkout_info');
        $checkoutInfo['payment_method_id'] = $paymentMethod->id;

        // Update session
        $request->session()->put('checkout_info', $checkoutInfo);

        return response()->json([
            'success' => true,
            'message' => 'Payment method updated'
        ]);
    }

    public function applyPromo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'promo_code' => 'required|string|exists:promo_codes,code'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promo tidak valid'
            ]);
        }

        $promoCode = PromoCode::where('code', $request->promo_code)
            ->where('is_active', true)
            ->whereDate('valid_until', '>=', now())
            ->first();

        if (!$promoCode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode promo sudah tidak berlaku'
            ]);
        }

        $checkoutInfo = $request->session()->get('checkout_info');
        $checkoutInfo['promo_code'] = $promoCode->code;
        $checkoutInfo['discount_amount'] = $promoCode->discount_amount;
        $checkoutInfo['discount_type'] = $promoCode->discount_type;

        // Update session
        $request->session()->put('checkout_info', $checkoutInfo);

        // Recalculate total
        $product = Product::findOrFail($checkoutInfo['product_id']);
        $subtotal = $product->price * 1000;
        $tax = $subtotal * 0.05;
        $shippingCost = $checkoutInfo['shipping_cost'] ?? 5000;

        // Apply discount
        $discount = 0;
        if ($promoCode->discount_type === 'percentage') {
            $discount = $subtotal * ($promoCode->discount_amount / 100);
        } else {
            $discount = $promoCode->discount_amount;
        }

        $total = $subtotal + $shippingCost + $tax - $discount;

        return response()->json([
            'success' => true,
            'message' => 'Kode promo berhasil digunakan',
            'discount' => $discount,
            'total' => $total
        ]);
    }

    /**
     * Complete order and process payment with Midtrans
     */
    public function confirmOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agree_terms' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $checkoutInfo = $request->session()->get('checkout_info');

        if (!$checkoutInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Checkout information not found'
            ]);
        }

        try {
            // Create an order
            $product = Product::findOrFail($checkoutInfo['product_id']);
            $shippingCost = $checkoutInfo['shipping_cost'] ?? 5000;
            $subtotal = $product->price * 1000;
            $tax = $subtotal * 0.05;

            // Calculate discount if any
            $discount = 0;
            if (isset($checkoutInfo['promo_code'])) {
                $promoCode = PromoCode::where('code', $checkoutInfo['promo_code'])->first();
                if ($promoCode) {
                    if ($promoCode->discount_type === 'percentage') {
                        $discount = $subtotal * ($promoCode->discount_amount / 100);
                    } else {
                        $discount = $promoCode->discount_amount;
                    }
                }
            }

            $total = $subtotal + $shippingCost + $tax - $discount;

            // Save address
            $address = new Address([
                'name' => $checkoutInfo['name'],
                'address' => $checkoutInfo['address'],
                'province' => $checkoutInfo['province'],
                'city' => $checkoutInfo['city'],
                'district' => $checkoutInfo['district'],
                'postal_code' => $checkoutInfo['postal_code'],
                'phone' => $checkoutInfo['phone'],
                'user_id' => Auth::id() ?? null
            ]);
            $address->save();

            // Generate order number
            $orderNumber = 'ORD-' . time();

            // Create order
            $order = new Order([
                'user_id' => Auth::id() ?? null,
                'address_id' => $address->id,
                'payment_method_id' => $checkoutInfo['payment_method_id'],
                'shipping_method_id' => $checkoutInfo['shipping_method_id'] ?? null,
                'order_number' => $orderNumber,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'tax' => $tax,
                'discount' => $discount,
                'total' => $total,
                'promo_code' => $checkoutInfo['promo_code'] ?? null,
                'status' => 'pending',
                'notes' => $request->notes ?? null
            ]);
            $order->save();

            // Create order detail
            $orderDetail = new OrderDetail([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price * 1000,
                'subtotal' => $product->price * 1000
            ]);
            $orderDetail->save();

            // Prepare Midtrans payment
            $params = [
                'transaction_details' => [
                    'order_id' => $orderNumber,
                    'gross_amount' => (int) $total,
                ],
                'customer_details' => [
                    'first_name' => $checkoutInfo['name'],
                    'email' => $checkoutInfo['email'],
                    'phone' => $checkoutInfo['phone'],
                    'billing_address' => [
                        'address' => $checkoutInfo['address'],
                        'city' => $checkoutInfo['city'],
                        'postal_code' => $checkoutInfo['postal_code'],
                        'country_code' => 'IDN',
                    ],
                ],
                'item_details' => [
                    [
                        'id' => $product->id,
                        'price' => $product->price * 1000,
                        'quantity' => 1,
                        'name' => $product->name,
                    ],
                    [
                        'id' => 'shipping-fee',
                        'price' => $shippingCost,
                        'quantity' => 1,
                        'name' => 'Biaya Pengiriman',
                    ],
                    [
                        'id' => 'tax-fee',
                        'price' => $tax,
                        'quantity' => 1,
                        'name' => 'Pajak (5%)',
                    ],
                ],
            ];

            // If there's a discount, add it as a negative item
            if ($discount > 0) {
                $params['item_details'][] = [
                    'id' => 'discount',
                    'price' => -$discount,
                    'quantity' => 1,
                    'name' => 'Diskon Promo',
                ];
            }

            $snapToken = Snap::getSnapToken($params);

            // Save the token to the order
            $order->payment_token = $snapToken;
            $order->save();

            // Clear checkout session
            $request->session()->forget('checkout_info');

            return response()->json([
                'success' => true,
                'message' => 'Order successfully created',
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'snap_token' => $snapToken,
                'redirect_url' => route('payment.midtrans', $order->id)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Show Midtrans payment page
     */
    public function showMidtransPayment($orderId)
    {
        $order = Order::findOrFail($orderId);

        if (!$order->payment_token) {
            abort(404, 'Payment token not found');
        }

        return view('checkout.midtrans-payment', compact('order'));
    }

    /**
     * Handle Midtrans notification callback
     */
    public function handleNotification(Request $request)
    {
        $notificationBody = json_decode($request->getContent(), true);

        $transactionStatus = $notificationBody['transaction_status'];
        $orderId = $notificationBody['order_id'];
        $fraudStatus = $notificationBody['fraud_status'] ?? null;

        $order = Order::where('order_number', $orderId)->firstOrFail();

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                // Payment challenged by fraud detection
                $order->status = 'pending';
            } else if ($fraudStatus == 'accept') {
                // Payment verified and accepted
                $order->status = 'paid';
            }
        } else if ($transactionStatus == 'settlement') {
            // Payment settled (bank transfer)
            $order->status = 'paid';
        } else if ($transactionStatus == 'deny') {
            // Payment denied
            $order->status = 'failed';
        } else if ($transactionStatus == 'cancel' || $transactionStatus == 'expire') {
            // Payment cancelled or expired
            $order->status = 'cancelled';
        } else if ($transactionStatus == 'pending') {
            // Payment pending
            $order->status = 'pending';
        }

        $order->payment_status = $transactionStatus;
        $order->payment_time = now();
        $order->save();

        return response()->json(['status' => 'OK']);
    }

    /**
     * Finish payment - called when customer has completed payment process
     */
    public function finishPayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Check payment status from database
        if ($order->status === 'paid') {
            return redirect()->route('checkout.success', $order->order_number);
        } else {
            return view('checkout.waiting-payment', compact('order'));
        }
    }

    /**
     * Show order success page
     */
    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['orderDetails.product', 'address', 'paymentMethod', 'shippingMethod'])
            ->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}
