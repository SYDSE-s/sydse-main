<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\Region;
use App\Models\Bank;
use Illuminate\Http\Request;

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
    public function index2()
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
            'email' => 'required|email|max:255',
            'phone_number' => 'required|max:255',
            'province' => 'required|max:255',
            'city' => 'required|max:255',
            'sub_district' => 'required|max:255',
            'village' => 'required|max:255',
            'id_card_number' => 'required|max:255',
            'id_card_photo' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            'id_card_selfie' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            // 'product_photo' => 'required|image|mimes:jpeg,png,jpg|max:4048',
            'bank_name' => 'required|max:255',
            'bank_account_number' => 'required|max:255',
            'bank_holders_name' => 'required|max:255',
            'nib_license' => 'nullable|max:255',
            'halal_license' => 'nullable|max:255',
            'pirt_license' => 'nullable|max:255',
            'bpom_license' => 'nullable|max:255',
            'hki_license' => 'nullable|max:255',
            'nutrition_test_license' => 'nullable|max:255',
            'haccp_license' => 'nullable|max:255',
        ]);

        // Simpan id_card_photo
        $idCardPhotoPath = $request->file('id_card_photo')->store('private/id_card_photos');
        $idCardPhotoName = basename($idCardPhotoPath);
        
        
        // Simpan id_card_selfie
        $idCardSelfiePath = $request->file('id_card_selfie')->store('private/id_card_selfies');
        $idCardSelfieName = basename($idCardSelfiePath);

        // product_photo
        $images = $request->file('product_photo');
        $imagesName = uniqid() . '.' . $images->getClientOriginalExtension();
        $images->move(public_path('product_photo'), $imagesName);

        // Simpan data lainnya ke database
        $member = new Member();
        $member->business_name = $validated['business_name'];
        $member->business_category = $validated['business_category'];
        $member->business_duration = $validated['business_duration'];
        $member->owner_name = $validated['owner_name'];
        $member->email = $validated['email'];
        $member->phone_number = $validated['phone_number'];
        $member->province = $validated['province'];
        $member->city = $validated['city'];
        $member->sub_district = $validated['sub_district'];
        $member->village = $validated['village'];
        $member->id_card_number = $validated['id_card_number'];
        $member->id_card_photo = $idCardPhotoName;
        $member->id_card_selfie = $idCardSelfieName;
        $member->product_photo = $imagesName;
        $member->bank_name = $validated['bank_name'];
        $member->bank_account_number = $validated['bank_account_number'];
        $member->bank_holders_name = $validated['bank_holders_name'];

        // Optional licenses
        $member->nib_license = $validated['nib_license'];
        $member->halal_license = $validated['halal_license'];
        $member->pirt_license = $validated['pirt_license'];
        $member->bpom_license = $validated['bpom_license'];
        $member->hki_license = $validated['hki_license'];
        $member->nutrition_test_license = $validated['nutrition_test_license'];
        $member->haccp_license = $validated['haccp_license'];

        $member->save();

        return redirect('activation');
    }
}
