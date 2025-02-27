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

        return view('member.register', [
            'regions' => $regions,
            'banks' => $banks
        ]);
    }
    public function index2() // same page with auto fade animation
    {
        $regions = Region::all();
        $banks = Bank::all();

        return view('member.register2', [
            'regions' => $regions,
            'banks' => $banks
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required|max:255',
            'business_category' => 'required|max:255',
            'business_duration' => 'required|max:255',
            'owner_name' => 'required|max:255',
            'phone_number' => 'required|max:255|unique:members',
            'province' => 'required|max:255',
            'city' => 'required|max:255',
            'sub_district' => 'required|max:255',
            'village' => 'required|max:255',
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            // 'id_card_number' => 'required|max:255',
            // 'id_card_photo' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            // 'id_card_selfie' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            // 'product_photo' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            // 'bank_name' => 'required|max:255',
            // 'bank_account_number' => 'required|max:255',
            // 'bank_holders_name' => 'required|max:255',
            'nib_license' => 'nullable|max:255',
            'halal_license' => 'nullable|max:255',
            'pirt_license' => 'nullable|max:255',
            'bpom_license' => 'nullable|max:255',
            'hki_license' => 'nullable|max:255',
            'nutrition_test_license' => 'nullable|max:255',
            'haccp_license' => 'nullable|max:255',
        ]);

        // Simpan id_card_photo
        // $idCardPhotoPath = $request->file('id_card_photo')->store('private/id_card_photos');
        // $idCardPhotoName = basename($idCardPhotoPath);


        // Simpan id_card_selfie
        // $idCardSelfiePath = $request->file('id_card_selfie')->store('private/id_card_selfies');
        // $idCardSelfieName = basename($idCardSelfiePath);

        // product_photo
        // $images = $request->file('product_photo');
        // $imagesName = uniqid() . '.' . $images->getClientOriginalExtension();
        // $images->move(public_path('product_photo'), $imagesName);


        // create new user
        $user = new User();
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        $user->save();


        // Simpan data lainnya ke database
        $member = new Member();
        $member->user_id = $user['id'];
        $member->business_name = $validated['business_name'];
        $member->business_category = $validated['business_category'];
        $member->business_duration = $validated['business_duration'];
        $member->owner_name = $validated['owner_name'];
        $member->phone_number = $validated['phone_number'];
        $member->province = $validated['province'];
        $member->city = $validated['city'];
        $member->sub_district = $validated['sub_district'];
        $member->village = $validated['village'];
        // $member->id_card_number = $validated['id_card_number'];
        // $member->id_card_photo = $idCardPhotoName;
        // $member->id_card_selfie = $idCardSelfieName;
        // $member->product_photo = $imagesName;
        // $member->bank_name = $validated['bank_name'];
        // $member->bank_account_number = $validated['bank_account_number'];
        // $member->bank_holders_name = $validated['bank_holders_name'];

        // Optional licenses
        $member->nib_license = $validated['nib_license'];
        $member->halal_license = $validated['halal_license'];
        $member->pirt_license = $validated['pirt_license'];
        $member->bpom_license = $validated['bpom_license'];
        $member->hki_license = $validated['hki_license'];
        $member->nutrition_test_license = $validated['nutrition_test_license'];
        $member->haccp_license = $validated['haccp_license'];

        $member->save();

        Auth::login($user); // Langsung login setelah registrasi

        return redirect('dashboard');
    }


    public function create2(Request $request)
    {
        $step = $request->step;
        if ($request->has('back')) {
            Session::put('step', $request->back);
            // var_dump(Session::get('step'));
            // var_dump($request->all());
            return redirect()->back()->with('step_back', $request->back);
        }

        if ($step == 1) {
            $validated_data = Validator::make($request->all(),[
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
            $validated_data = Validator::make($request->all(),[
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
            $validated_data = Validator::make($request->all(),[
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
            $validated_data = Validator::make($request->all(),[
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
            $validated_data = Validator::make($request->all(),[
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
            $user = User::create($user);

            // create member
            session()->put('step1.user_id', $user['id']);

            $member = array_merge(
            Session::get('step1'),
            Session::get('step2'),
            Session::get('step4'),
            Session::get('step5'));

            Member::create($member);
            Session::flush();

            // set login session and redirect
            Auth::login($user);
            return redirect('/dashboard');
        }
    }
}
