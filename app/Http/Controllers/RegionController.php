<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        
    }

    public function getRegions(Request $request)
    {
        $parentCode = $request->input('parent_code');
        $level = $request->input('level');

        // Filter berdasarkan level
        $regions = match ($level) {
            'sub-district' => Region::whereRaw("CHAR_LENGTH(kode) = 8") // Kecamatan (3 segmen)
                ->where('kode', 'like', "$parentCode.%")
                ->get(['kode', 'nama']),
            'village' => Region::whereRaw("CHAR_LENGTH(kode) = 13") // Desa (4 segmen)
                ->where('kode', 'like', "$parentCode.%")
                ->get(['kode', 'nama']),
            default => []
        };

        return response()->json($regions);
    }

    public function test(Request $request) {
        var_dump($request['city']);
        var_dump($request['sub-district']);
        var_dump($request['village']);
    }
}
