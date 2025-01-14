<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'member_id' => '1',
                'name' => 'Bolu Tiga Rasa',
                'price' => '25.000',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-tiga-rasa.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu Kukus',
                'price' => '20.000',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-kukus.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu Gulung',
                'price' => '22.000',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-gulung.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu coklat',
                'price' => '22.000',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-coklat.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu Keju',
                'price' => '22.000',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-keju.jpg'
            ],

            [
                'member_id' => '2',
                'name' => 'Aneka Cookies',
                'price' => '25.000',
                'description' => 'Cookies',
                'product_photo' => 'cookies.jpg'
            ],

            [
                'member_id' => '2',
                'name' => 'Pastry Strawbery Jam',
                'price' => '28.000',
                'description' => 'Kue pastry dengan selai strawbery',
                'product_photo' => 'pastry.jpg'
            ],

            [
                'member_id' => '3',
                'name' => 'Sweater Polos',
                'price' => '99.000',
                'description' => 'Sweater berbahan lembut dan tebal',
                'product_photo' => 'sweater.jpg'
            ],

            [
                'member_id' => '3',
                'name' => 'Sweater Hitam Polos',
                'price' => '102.000',
                'description' => 'Sweater berbahan lembut dan tebal',
                'product_photo' => 'sweater2.jpg'
            ],

            [
                'member_id' => '3',
                'name' => 'Sweater Cristmas',
                'price' => '85.000',
                'description' => 'Sweater berbahan lembut dan tebal',
                'product_photo' => 'sweater3.jpg'
            ],

            [
                'member_id' => '5',
                'name' => 'Tas Bambu',
                'price' => '49.000',
                'description' => 'Kerajinan berkualitas tinggi',
                'product_photo' => 'kerajinan-tas.jpeg'
            ],

            [
                'member_id' => '5',
                'name' => 'Wadah Bambu',
                'price' => '35.000',
                'description' => 'Kerajinan berkualitas tinggi',
                'product_photo' => 'kerajinan-wadah.jpg'
            ],

            [
                'member_id' => '5',
                'name' => 'Pot',
                'price' => '49.000',
                'description' => 'Kerajinan berkualitas tinggi',
                'product_photo' => 'kerajinan-pot.jpg'
            ],
            [
                'member_id' => '8',
                'name' => 'Set Kursi Dinner',
                'price' => '400.000',
                'description' => 'Satu set dinner, include kursi dan meja',
                'product_photo' => 'chair.jpg'
            ],
            [
                'member_id' => '8',
                'name' => 'Sofa',
                'price' => '450.000',
                'description' => 'Satu Set sofa empuk',
                'product_photo' => 'sofa.jpg'
            ],
            [
                'member_id' => '7',
                'name' => 'Set Facial Skin Care',
                'price' => '250.000',
                'description' => 'Satu set perawatan kulit wajah',
                'product_photo' => 'beauty.jpg'
            ],
            [
                'member_id' => '6',
                'name' => 'Choco Boba Ice',
                'price' => '15.000',
                'description' => 'Minuman coklat manis dengan toping boba',
                'product_photo' => 'boba.jpg'
            ],
            [
                'member_id' => '6',
                'name' => 'Avocado Smoothies',
                'price' => '17.000',
                'description' => 'Smoothies Avocado',
                'product_photo' => 'avocado-smoothies.jpg'
            ],
            [
                'member_id' => '6',
                'name' => 'Ice Tea',
                'price' => '3.000',
                'description' => 'Es Teh seger',
                'product_photo' => 'ice-tea.jpg'
            ],
            [
                'member_id' => '4',
                'name' => 'Gaskeun Delivery',
                'price' => '~',
                'description' => 'Delivery makanan',
                'product_photo' => 'gaskeun.png'
            ],
        ]);
    }
}
