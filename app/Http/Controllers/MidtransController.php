<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getToken(Request $request)
    {
        try {
            $params = [
                'transaction_details' => $request->transaction_details,
                'customer_details' => $request->customer_details,
                'item_details' => $request->item_details,
            ];

            $snapToken = Snap::getSnapToken($params);

            return response()->json(['token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        try {
            $notificationBody = json_decode($request->getContent(), true);
            $transactionStatus = $notificationBody['transaction_status'];
            $orderId = $notificationBody['order_id'];

            // Handle the transaction status
            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                // Payment success
                // Update your database here
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'cancel' || $transactionStatus == 'expire') {
                // Payment failed
                // Update your database here
            } else if ($transactionStatus == 'pending') {
                // Payment pending
                // Update your database here
            }

            return response()->json(['status' => 'OK']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
