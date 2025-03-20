<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\Region;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


use function PHPSTORM_META\type;

class RegisterMemberController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        $banks = Bank::all();

        return view('auth.register-member', [
            'regions' => $regions,
            'banks' => $banks
        ]);
    }

    public function create(Request $request)
    {
        $step = $request->step;
        if ($request->has('back')) {
            Session::put('step', $request->back);
            // var_dump(Session::get('step'));
            // var_dump($request->all());
            return redirect()->back()->with('step_back', $request->back);
        }

        if ($step == 1) {
            $validated_data = Validator::make($request->all(), [
                'user_id' => '',
                'business_name' => 'required|max:255',
                'business_category' => 'required|max:255',
                'business_duration' => 'required|max:10',
                'owner_name' => 'required|max:50',
                'phone_number' => 'required|max:15',
            ]);

            if ($validated_data->fails()) {
                return redirect()->back()
                    ->withErrors($validated_data)
                    ->withInput()
                    ->with('step', 1);
            }

            Session::put('step1', $request->only(['business_name', 'business_category', 'business_duration', 'owner_name', 'phone_number']));

            return redirect()->back()->with('step', 2);
        }

        if ($step == 2) {
            $validated_data = Validator::make($request->all(), [
                'province' => 'required|max:255',
                'city' => 'required|max:255|not_in:Pilih Kota / Kabupaten',
                'sub_district' => 'required|max:255|not_in:Pilih Kecamatan',
                'village' => 'required|max:255|not_in:Pilih Desa',
                'address' => 'required|max:255|not_in:Alamat Lengkap'
            ]);

            if ($validated_data->fails()) {
                return redirect()->back()
                    ->withErrors($validated_data)
                    ->withInput()
                    ->with('step', 2);
            }

            Session::put('step2', $request->only(['province', 'city', 'sub_district', 'village', 'address']));

            return redirect()->back()->with('step', 3);
        }

        if ($step == 3) {
            $validated_data = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);


            if ($validated_data->fails()) {
                return redirect()->back()
                    ->withErrors($validated_data)
                    ->withInput()
                    ->with('step', 3);
            }

            Session::put('step3', $request->only(['name', 'username', 'email', 'password']));

            return redirect()->back()->with('step', 4);
        }

        if ($step == 4) {
            $validated_data = Validator::make($request->all(), [
                'nib_license' => 'nullable|max:255',
                'halal_license' => 'nullable|max:255',
                'pirt_license' => 'nullable|max:255',
                'bpom_license' => 'nullable|max:255'
            ]);

            if ($validated_data->fails()) {
                return redirect()->back()
                    ->withErrors($validated_data)
                    ->withInput()
                    ->with('step', 4);
            }

            Session::put('step4', $request->only(['nib_license', 'halal_license', 'pirt_license', 'bpom_license']));

            return redirect()->back()->with('step', 5);
        }

        if ($step == 5) {
            $validated_data = Validator::make($request->all(), [
                'hki_license' => 'nullable|max:255',
                'nutrition_test_license' => 'nullable|max:255',
                'haccp_license' => 'nullable|max:255',
            ]);

            if ($validated_data->fails()) {
                return redirect()->back()
                    ->withErrors($validated_data)
                    ->withInput()
                    ->with('step', 5);
            }

            Session::put('step5', $request->only(['hki_license', 'nutrition_test_license', 'haccp_license']));

            return redirect()->back()->with('step', 6);
        }

        if ($step == 6) {

            // create user
            $user = Session::get('step3');
            $user['role'] = 'member';
            $user['password'] = Hash::make($user['password']);
            $user = User::create($user);

            // create member
            session()->put('step1.user_id', $user['id']);
            $member = array_merge(
                Session::get('step1'),
                Session::get('step2'),
                Session::get('step4'),
                Session::get('step5')
            );

            $member = Member::create($member);
            Session::flush();

            // set login session and redirect
            Auth::login($user);
            return redirect('/dashboard');
        }
    }
}
