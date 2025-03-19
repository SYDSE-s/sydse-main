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
                'product_category' => 'kuliner basah',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-tiga-rasa.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu Kukus',
                'price' => '20.000',
                'product_category' => 'kuliner basah',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-kukus.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu Gulung',
                'price' => '22.000',
                'product_category' => 'kuliner basah',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-gulung.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu coklat',
                'price' => '22.000',
                'product_category' => 'kuliner basah',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-coklat.jpg'
            ],

            [
                'member_id' => '1',
                'name' => 'Bolu Keju',
                'price' => '22.000',
                'product_category' => 'kuliner basah',
                'description' => 'Bolu khas Solo',
                'product_photo' => 'bolu-keju.jpg'
            ],

            [
                'member_id' => '2',
                'name' => 'Aneka Cookies',
                'price' => '25.000',
                'product_category' => 'kuliner kering',
                'description' => 'Cookies',
                'product_photo' => 'cookies.jpg'
            ],

            [
                'member_id' => '2',
                'name' => 'Pastry Strawbery Jam',
                'price' => '28.000',
                'product_category' => 'kuliner kering',
                'description' => 'Kue pastry dengan selai strawbery',
                'product_photo' => 'pastry.jpg'
            ],

            [
                'member_id' => '3',
                'name' => 'Sweater Polos',
                'price' => '99.000',
                'product_category' => 'fashion',
                'description' => 'Sweater berbahan lembut dan tebal',
                'product_photo' => 'sweater.jpg'
            ],

            [
                'member_id' => '3',
                'name' => 'Sweater Hitam Polos',
                'price' => '102.000',
                'product_category' => 'fashion',
                'description' => 'Sweater berbahan lembut dan tebal',
                'product_photo' => 'sweater2.jpg'
            ],

            [
                'member_id' => '3',
                'name' => 'Sweater Cristmas',
                'price' => '85.000',
                'product_category' => 'fashion',
                'description' => 'Sweater berbahan lembut dan tebal',
                'product_photo' => 'sweater3.jpg'
            ],

            [
                'member_id' => '5',
                'name' => 'Tas Bambu',
                'price' => '49.000',
                'product_category' => 'craft',
                'description' => 'Kerajinan berkualitas tinggi',
                'product_photo' => 'kerajinan-tas.jpeg'
            ],

            [
                'member_id' => '5',
                'name' => 'Wadah Bambu',
                'price' => '35.000',
                'product_category' => 'craft',
                'description' => 'Kerajinan berkualitas tinggi',
                'product_photo' => 'kerajinan-wadah.jpg'
            ],

            [
                'member_id' => '5',
                'name' => 'Pot',
                'price' => '49.000',
                'product_category' => 'craft',
                'description' => 'Kerajinan berkualitas tinggi',
                'product_photo' => 'kerajinan-pot.jpg'
            ],
            [
                'member_id' => '8',
                'name' => 'Set Kursi Dinner',
                'price' => '400.000',
                'product_category' => 'furniture',
                'description' => 'Satu set dinner, include kursi dan meja',
                'product_photo' => 'chair.jpg'
            ],
            [
                'member_id' => '8',
                'name' => 'Sofa',
                'price' => '450.000',
                'product_category' => 'furniture',
                'description' => 'Satu Set sofa empuk',
                'product_photo' => 'sofa.jpg'
            ],
            [
                'member_id' => '7',
                'name' => 'Set Facial Skin Care',
                'price' => '250.000',
                'product_category' => 'beauty',
                'description' => 'Satu set perawatan kulit wajah',
                'product_photo' => 'beauty.jpg'
            ],
            [
                'member_id' => '6',
                'name' => 'Choco Boba Ice',
                'price' => '15.000',
                'product_category' => 'drink',
                'description' => 'Minuman coklat manis dengan toping boba',
                'product_photo' => 'boba.jpg'
            ],
            [
                'member_id' => '6',
                'name' => 'Avocado Smoothies',
                'price' => '17.000',
                'product_category' => 'drink',
                'description' => 'Smoothies Avocado',
                'product_photo' => 'avocado-smoothies.jpg'
            ],
            [
                'member_id' => '6',
                'name' => 'Ice Tea',
                'price' => '3.000',
                'product_category' => 'drink',
                'description' => 'Es Teh seger',
                'product_photo' => 'ice-tea.jpg'
            ],
            [
                'member_id' => '4',
                'name' => 'Gaskeun Delivery',
                'price' => '~',
                'product_category' => 'jasa',
                'description' => 'Delivery makanan',
                'product_photo' => 'gaskeun.png'
            ],
        ]);

        "SELECT n.nama_nasabah, n.alamat_nasabah, t.jenis_transaksi, t.jumlah 
        FROM nasabah n 
        JOIN transaksi t ON n.id_nasabah = t.id_nasabahFK
        WHERE t.jenis_transaksi ='kredit'
        ORDER BY n.nama_nasabah";

        "SELECT r.no_rekening, n.nama_nasabah, t.jenis_transaksi, t.jumlah 
        FROM nasabah n 
        JOIN nasabah_has_rekening nr ON n.id_nasabah = nr.id_nasabahFK
        JOIN rekening r ON r.no_rekening = nr.no_rekeningFK
        JOIN transaksi t ON r.no_rekening = t.no_rekeningFK
        WHERE t.tanggal='2022-11-21'
        ORDER BY n.nama_nasabah";

        "SELECT r.no_rekening, n.nama_nasabah, t.jenis_transaksi, t.jumlah 
        FROM nasabah n 
        JOIN nasabah_has_rekening nr ON n.id_nasabah = nr.id_nasabahFK
        JOIN rekening r ON r.no_rekening = nr.no_rekeningFK
        JOIN transaksi t ON r.no_rekening = t.no_rekeningFK
        WHERE t.jumlah=20000";

        "
        SELECT * FROM transaksi WHERE tanggal='2022-11-21';
        SELECT * FROM transaksi WHERE jumlah=20000;
        ";
    }
}
