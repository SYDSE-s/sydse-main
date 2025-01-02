<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class DashboardController extends Controller
{
    // dashboard index (member-data)
    public function index()
    {

        $member = Member::all();

        return view('dashboard.member-data.index', [
            'data_member' => $member
        ]);
    }


    // details member
    public function details($id)
    {

        $member = DB::table('members')
            ->where('id', '=', $id)
            ->get();

        return view('dashboard.member-data.details', [
            'data_members' => $member
        ]);
    }


    // requesting verification
    public function requestVerif()
    {
        $requesting = DB::table('members')
            ->where('request_verification', '=', true)
            ->get();
        return view('dashboard.request-verification.index', [
            'data_member' => $requesting
        ]);
    }


    // details member
    public function requestVerifDetails($id)
    {

        $member = DB::table('members')
            ->where('id', '=', $id)
            ->get();

        return view('dashboard.request-verification.details', [
            'data_members' => $member
        ]);
    }


    // show private photo (id card)
    public function showIdPhoto($filename)
    {
        $test = true;
        if (!$test) {
            abort(403, 'Akses ditolak.');
        } else {
            $path = "private/id_card_photos/{$filename}";

            if (!Storage::exists($path)) {
                abort(404, 'File tidak ditemukan.');
            }

            $fileContent = Storage::get($path);
            $mimeType = Storage::mimeType($path);
        }
        return response($fileContent, 200)->header('Content-Type', $mimeType);
    }


    // show private photo (id card)
    public function showIdSelfie($filename)
    {
        $test = true;
        if (!$test) {
            abort(403, 'Akses ditolak.');
        } else {
            $path = "private/id_card_selfies/{$filename}";

            if (!Storage::exists($path)) {
                abort(404, 'File tidak ditemukan.');
            }

            $id_selfie = Storage::get($path);
            $selfieMimeType = Storage::mimeType($path);
        }
        return response($id_selfie, 200)->header('Content-Type', $selfieMimeType);
    }
}
