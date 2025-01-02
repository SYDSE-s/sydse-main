<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Nette\Utils\Random;
use Ramsey\Uuid\Type\Integer;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->insert([
            [
                'business_name' => 'Kamal f&b',
                'business_category' => 'kuliner kering',
                'business_duration' => '4',
                'owner_name' => 'Ahmad Kamaludin',
                'email' => 'kamal@example.com',
                'phone_number' => '6281901035799',
                'province' => 'JAWA TENGAH',
                'city' => 'Tegal',
                'sub_district' => 'Suradadi',
                'village' => 'Purwahamba',
                'id_card_number' => '3302930930239',
                'id_card_photo' => 'photo.jpg',
                'id_card_selfie' => 'selfie.jpg',
                'product_photo' => 'product.jpg',
                'bank_name' => 'BANK MANDIRI',
                'bank_account_number' => '20339329298',
                'bank_holders_name' => 'Ahmad Kamaludin',
                'nib_license' => 'nib93920280',
                'halal_license' => 'halal232892090',
                'pirt_license' => 'pirt237239030',
                'bpom_license' => 'bpom2932300282',
                'hki_license' => 'hki1929239',
                'nutrition_test_license' => 'nutrition99238920',
                'haccp_license' => 'haccp020120939',
                'request_activation' => true,
                'request_verification' => true,
                'verification' => '02382308239',
                'qr_code_path' => 'ksioweojsk',
                
            ],
            [
                'business_name' => "Yulita's Fashion",
                'business_category' => 'fashion',
                'business_duration' => '4',
                'owner_name' => 'Yulita Dwi Syahrotin',
                'email' => 'yulitaa@example.com',
                'phone_number' => '6288226713099',
                'province' => 'JAWA TENGAH',
                'city' => 'Tegal',
                'sub_district' => 'Suradadi',
                'village' => 'Kertasari',
                'id_card_number' => '3302930930239',
                'id_card_photo' => 'photo.jpg',
                'id_card_selfie' => 'selfie.jpg',
                'product_photo' => 'product.jpg',
                'bank_name' => 'BANK MANDIRI',
                'bank_account_number' => '20339329298',
                'bank_holders_name' => 'Yulita Dwi Syahrotin',
                'nib_license' => 'nib93920280',
                'halal_license' => 'halal232892090',
                'pirt_license' => 'pirt237239030',
                'bpom_license' => 'bpom2932300282',
                'hki_license' => 'hki1929239',
                'nutrition_test_license' => 'nutrition99238920',
                'haccp_license' => 'haccp020120939',
                'request_activation' => true,
                'request_verification' => true,
                'verification' => '02382308239',
                'qr_code_path' => 'ksioweojsk',
            ],
            [
                'business_name' => "Fadhil's craft",
                'business_category' => 'craft',
                'business_duration' => '3',
                'owner_name' => 'Fadhil Triatmaja',
                'email' => 'fadhil@example.com',
                'phone_number' => '628551231400',
                'province' => 'JAWA TENGAH',
                'city' => 'Tegal',
                'sub_district' => 'Kramat',
                'village' => 'Babakan',
                'id_card_number' => '3302930930239',
                'id_card_photo' => 'photo.jpg',
                'id_card_selfie' => 'selfie.jpg',
                'product_photo' => 'product.jpg',
                'bank_name' => 'BANK MANDIRI',
                'bank_account_number' => '20339329298',
                'bank_holders_name' => 'Fadhil Triatmaja',
                'nib_license' => 'nib93920280',
                'halal_license' => 'halal232892090',
                'pirt_license' => 'pirt237239030',
                'bpom_license' => 'bpom2932300282',
                'hki_license' => 'hki1929239',
                'nutrition_test_license' => 'nutrition99238920',
                'haccp_license' => 'haccp020120939',
                'request_activation' => false,
                'request_verification' => false,
                'verification' => '02382308239',
                'qr_code_path' => 'ksioweojsk',
            ],
            [
                'business_name' => "Anterin kuy",
                'business_category' => 'jasa',
                'business_duration' => '6',
                'owner_name' => 'Rafki',
                'email' => 'rafki@example.com',
                'phone_number' => '6285741148380',
                'province' => 'JAWA TENGAH',
                'city' => 'Tegal',
                'sub_district' => 'Kramat',
                'village' => 'Bongkok',
                'id_card_number' => '3302930930239',
                'id_card_photo' => 'photo.jpg',
                'id_card_selfie' => 'selfie.jpg',
                'product_photo' => 'product.jpg',
                'bank_name' => 'BANK MANDIRI',
                'bank_account_number' => '20339329298',
                'bank_holders_name' => 'Rafki',
                'nib_license' => 'nib93920280',
                'halal_license' => 'halal232892090',
                'pirt_license' => 'pirt237239030',
                'bpom_license' => 'bpom2932300282',
                'hki_license' => 'hki1929239',
                'nutrition_test_license' => 'nutrition99238920',
                'haccp_license' => 'haccp020120939',
                'request_activation' => false,
                'request_verification' => false,
                'verification' => '02382308239',
                'qr_code_path' => 'ksioweojsk',
            ]
        ]);
    }
}