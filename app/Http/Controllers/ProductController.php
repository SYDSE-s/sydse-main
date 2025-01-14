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
        $product = Product::all();

        // foreach($product as $p) {
        //     var_dump($p->member->halal_license);
        // };

        return view('product.index', [
            'product' => $product
        ]);
    }

    public function detail($id)
    {
        $product = Product::with('member')->where('id', $id)->first();

        return view('product.detail', [
            'product' => $product
        ]);
    }
}
