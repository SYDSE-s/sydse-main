<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function index(Request $request) {
        $member = Member::all();
        return view('member.activation', [
            'member' => $member
        ]);
    }

    public function update(Request $request) {
        var_dump($request->session()->get('stored_userdata'));
    }
}