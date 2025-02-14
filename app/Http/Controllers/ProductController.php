<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $test = Product::all()->first();

        // foreach($product as $p) {
        //     var_dump($p->member->halal_license);
        // };

        return view('product.index', [
            'products' => $products,
            'test' => $test
        ]);
    }

    public function detail($id)
    {
        $product = Product::with('member')->where('id', $id)->first();

        return view('product.detail', [
            'product' => $product
        ]);
    }

    public function search(Request $request)
    {
        $filtered_product = DB::table('products')
                ->where('name', 'like', $request['search-product'].'%')
                ->orWhere('product_category', 'like', $request['search-product'].'%')
                ->get();

        return view("product.index", [
            'filtered_product' => $filtered_product
        ]);
    }
}
