<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function index(Request $request) {
        $user = User::all();
        return view('auth.activation', [
            'user' => $user
        ]);
    }

    public function update(Request $request) {
        var_dump($request->session()->get('stored_userdata'));
        // return redirect('https://youtube.com');
    }
}
