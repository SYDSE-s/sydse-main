<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin123',
                'email' => 'admin@gmail.com',s
                'role' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kamal',
                'username' => 'Ahmad Kamaludin',
                'email' => 'raihan@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Raihan',
                'username' => 'Raihan Galih',
                'email' => 'kamaludina95@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yulita',
                'username' => 'Yulita Dwi Syahrotin',
                'email' => 'yulita@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rafki',
                'username' => 'Rafki Setyoaji',
                'email' => 'rafki@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fadhil',
                'username' => 'Fadhil Triatmaja',
                'email' => 'fadhil@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Rahmat',
                'username' => 'Rahmatullah',
                'email' => 'rahmat@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'yulita fashion',
                'username' => 'Yulita Dwi Syahrotin Fashion',
                'email' => 'yulita2@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Joko',
                'username' => 'Joko Sutejo',
                'email' => 'joko@gmail.com',
                'role' => 'member',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
