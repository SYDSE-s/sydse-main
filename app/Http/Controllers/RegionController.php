<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index() {
        $regions = Region::all();
        foreach($regions as $region) {
            $city = explode('.', $region['kode']);
            // var_dump($city);

        }
        
        return view('auth.activation', [
            'regions' => $regions,
        ]);
    }
}
