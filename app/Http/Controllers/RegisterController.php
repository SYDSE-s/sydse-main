<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function create(Request $request)
    {
        // store DB
        User::create([
            'name' => $request['name'],
            'business_name' => $request['business_name'],
            'category' => $request['category'],
            'no_whatsapp' => $request['no_whatsapp'],
        ]);

        // set session
        session(['stored_userdata' => [
            'no_whatsapp' => $request['no_whatsapp']
        ]]);

        var_dump($request['no_whatsapp']);
        return redirect('activation');
        
    }
}