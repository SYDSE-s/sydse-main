<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // category
        $kuliner_kering = DB::table('members')->where('business_category', 'kuliner kering')->get();
        $kuliner_basah = DB::table('members')->where('business_category', 'kuliner basah')->get();
        $fashion = DB::table('members')->where('business_category', 'fashion')->get();
        $jasa = DB::table('members')->where('business_category', 'jasa')->get();
        $craft = DB::table('members')->where('business_category', 'craft')->get();
        $drink = DB::table('members')->where('business_category', 'drink')->get();
        $beauty = DB::table('members')->where('business_category', 'beauty')->get();
        $furniture = DB::table('members')->where('business_category', 'furniture')->get();

        // products
        $products = DB::table('products')->get();
        
        return view('home', [
            'kuliner_kering' => $kuliner_kering,
            'kuliner_basah' => $kuliner_basah,
            'fashion' => $fashion,
            'jasa' => $jasa,
            'craft' => $craft,
            'drink' => $drink,
            'beauty' => $beauty,
            'furniture' => $furniture,
            'products' => $products
        ]);
    }
}
