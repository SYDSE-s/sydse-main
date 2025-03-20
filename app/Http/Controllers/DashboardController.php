<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    // dashboard index (member-data)
    public function index()
    {

        $member = Member::all();
        return view('dashboard.index', [
            'data_member' => $member
        ]);
    }


    public function manageProduct()
    {
        $products = DB::table('products')->where('member_id', Auth::user()->id)->get();
        
        return view('dashboard.manage-product.manage-product', [
            'products' => $products
        ]);
    }


    public function addProductV()   // view
    {
        return view('dashboard.manage-product.add-product');
    }

    public function addProduct(Request $request)    // create new product
    {
        $validated = $request->validate([
            'product_photo' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'product_category' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        // product photo
        $product_photo = $request->file('product_photo');
        $file_name = time() . '_' . $product_photo->getClientOriginalName();
        $product_photo->move(public_path('product_photo'), $file_name);

        Product::create([
            'member_id' => Session::get('member.id'),
            'name' => $validated['name'],
            'price' => $validated['price'],
            'product_category' => $validated['product_category'],
            'description' => $validated['description'],
            'product_photo' => $file_name
        ]);

        return redirect('/manage-product')->with('success', 'Berhasil menambahkan 1 produk');
    }


    public function editProductV($id)   // view
    {
        $product = Product::findOrFail($id);
        return view('dashboard.manage-product.edit-product', [
            'product' => $product
        ]);
    }

    public function editProduct(Request $request, $id)    // edit product
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'product_category' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('product_photo')) {
            $request->validate([
                'product_photo' => 'image|mimes:jpeg,png,jpg|max:3000',
            ]);

            if ($product->product_photo && file_exists(public_path('product_photo/' . $product->product_photo))) {
                unlink(public_path('product_photo/' . $product->product_photo));
            }

            $product_photo = $request->file('product_photo');
            $file_name = time() . '_' . $product_photo->getClientOriginalName();
            $product_photo->move(public_path('product_photo'), $file_name);

            $product->product_photo = $file_name;
        }

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'product_category' => $validated['product_category'],
            'description' => $validated['description'],
        ]);

        return redirect('/manage-product')->with('success', 'Produk berhasil di edit');
    }

    public function deleteProduct($id) {
        $product = Product::findOrFail($id);

        unlink(public_path('product_photo/' . $product->product_photo));
        $product->delete();

        return redirect('/manage-product')->with('success', 'produk berhasil di hapus');
    }
}
