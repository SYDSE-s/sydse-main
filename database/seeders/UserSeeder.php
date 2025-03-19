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


        "INSERT INTO nasabah(id_nasabah, nama_nasabah, alamat_nasabah) VALUES
        (6, 'Satria Eka Jaya', 'Jl. Slamet RIyadi 30'),
        (7, 'Indri Hapsari', 'Jl. Sutoyo 5'),
        (8, 'Sari Murti', 'Jl. pangandaran 11'),
        (9, 'Canka Lokananta', 'Jl. Tidar 86'),
        (10, 'Budi Murtono', 'Jl. Merak 22'),
        ";
        "INSERT INTO cabang_bank(kode_cabang, nama_cabangFK, alamat_cabang) VALUES
        ('BRUS', 'Bank Rut Unit Surakarta', 'Jl. Slamet RIyadi 18'),
        ('BRUM', 'Bank Rut Unit Magelang', 'Jl. P.Tendean 63'),
        ('BRUB', 'Bank Rut Unit Boyolali', 'Jl. Ahmad Yani 45'),
        ('BRUK', 'Bank Rut Unit Klaten', 'Jl. Suparman 23'),
        ('BRUY', 'Bank Rut Unit Yogyakarta', 'Jl. Anggrek 21'),
        ('BRUW', 'Bank Rut Unit Wonogiri', 'Jl. Untung Suropati 12');
        ";
        "INSERT INTO rekening(no_rekening, kode_cabangFK, pin, saldo) VALUES
        (101, 'BRUS', 1111, 500000),
        (102, 'BRUS', 2222, 3500000),
        (103, 'BRUS', 3333, 15000),
        (104, 'BRUM', 4444, 90000),
        (105, 'BRUM', 5555, 91000),
        (106, 'BRUS', 6666, 5100),
        (107, 'BRUS', 7777, 10000),
        (108, 'BRUB', 0000, 50000),
        (109, 'BRUB', 9999, 0),
        (110, 'BRUY', 1234, 55000),
        (111, 'BRUK', 4321, 15000),
        (112, 'BRUK', 0123, 300000),
        (113, 'BRUY', 8888, 255000)
        ";
        "INSERT INTO nasabah_has_rekening(id_nasabahFK, no_rekeningFK) VALUES
        (1, 104),
        (2, 103),
        (3, 105),
        (3, 106),
        (4, 101),
        (4, 107),
        (5, 102),
        (5, 107),
        (6, 109),
        (7, 109),
        (8, 111),
        (9, 110),
        (10, 113),
        (8, 112),
        (10, 108);
        ";
        "INSERT INTO transaksi (not_transaksi, id_nasabahFK, no_rekeningFK, jenis_transaksi, tanggal, jumlah) VALUES
        (1, 101, 1, 'debit', '2022-11-01', 50000),
        (2, 102, 2, 'kredit', '2022-11-02', 75000),
        (3, 103, 3, 'debit', '2022-11-03', 60000),
        (4, 104, 4, 'kredit', '2022-11-04', 80000),
        (5, 105, 5, 'debit', '2022-11-05', 55000),
        (6, 106, 1, 'kredit', '2022-11-06', 90000),
        (7, 107, 2, 'debit', '2022-11-07', 70000),
        (8, 108, 3, 'kredit', '2022-11-08', 65000),
        (9, 109, 4, 'debit', '2022-11-09', 72000),
        (10, 110, 5, 'kredit', '2022-11-10', 83000),
        (11, 101, 1, 'debit', '2022-11-11', 60000),
        (12, 102, 2, 'kredit', '2022-11-12', 58000),
        (13, 103, 3, 'debit', '2022-11-13', 74000),
        (14, 104, 4, 'kredit', '2022-11-14', 81000),
        (15, 105, 5, 'debit', '2022-11-15', 53000),
        (16, 106, 1, 'kredit', '2022-11-16', 96000),
        (17, 107, 2, 'debit', '2022-11-17', 68000),
        (18, 108, 3, 'kredit', '2022-11-18', 71000),
        (19, 109, 4, 'debit', '2022-11-19', 75000),
        (20, 110, 5, 'kredit', '2022-11-20', 85000),
        (21, 101, 1, 'debit', '2022-11-21', 62000),
        (22, 102, 2, 'kredit', '2022-11-22', 57000),
        (23, 103, 3, 'debit', '2022-11-23', 76000),
        (24, 104, 4, 'kredit', '2022-11-24', 88000),
        (25, 105, 5, 'debit', '2022-11-25', 50000),
        (26, 106, 1, 'kredit', '2022-11-26', 94000),
        (27, 107, 2, 'debit', '2022-11-27', 69000),
        (28, 108, 3, 'kredit', '2022-11-28', 72000),
        (29, 109, 4, 'debit', '2022-11-29', 76000),
        (30, 110, 5, 'kredit', '2022-11-30', 87000);
        ";

        "UPDATE nasabah
        SET alamat_nasabah = 'Jl. Slamet Riyadi 34'
        WHERE nama_nasabah = 'Indri Hapsari';
        ";

        "UPDATE cabang_bank
        SET alamat_cabang = 'Jl. A. Yani 23'
        WHERE kode_cabang = 'BRUW';
        ";

        "DELETE FROM nasabah
        WHERE id_nasabah = 7;
        ";

        "DELETE FROM cabang_bank
        WHERE nama_cabangFK = 'Bank Rut Unit Magelang';
        ";
        
        "
            INSERT INTO mahasiswa (nim, ruang_kelasFK, dosenFK, nama, alamat, tanggal_lahir, jenis_kelamin) VALUES
            ('220001', 1, 101, 'Ahmad Ramadhan', 'Jl. Merdeka No. 1', '2002-05-10', 'L'),
            ('220002', 1, 102, 'Budi Santoso', 'Jl. Diponegoro No. 2', '2003-06-12', 'L'),
            ('220003', 2, 103, 'Citra Dewi', 'Jl. Gatot Subroto No. 3', '2002-07-15', 'P'),
            ('220004', 2, 104, 'Dian Kusuma', 'Jl. Sudirman No. 4', '2001-08-20', 'L'),
            ('220005', 3, 105, 'Eka Putri', 'Jl. Ahmad Yani No. 5', '2003-09-25', 'P'),
            ('220006', 3, 106, 'Farhan Jaya', 'Jl. Imam Bonjol No. 6', '2002-10-30', 'L'),
            ('220007', 4, 107, 'Gita Lestari', 'Jl. Cendana No. 7', '2001-11-05', 'P'),
            ('220008', 4, 108, 'Hendra Wijaya', 'Jl. Kemuning No. 8', '2003-12-10', 'L'),
            ('220009', 5, 109, 'Indah Permata', 'Jl. Kenanga No. 9', '2002-01-15', 'P'),
            ('220010', 5, 110, 'Joko Prasetyo', 'Jl. Melati No. 10', '2001-02-20', 'L'),
            ('220011', 6, 101, 'Karina Sari', 'Jl. Flamboyan No. 11', '2003-03-25', 'P'),
            ('220012', 6, 102, 'Lutfi Hakim', 'Jl. Mawar No. 12', '2002-04-30', 'L'),
            ('220013', 7, 103, 'Mega Sari', 'Jl. Anggrek No. 13', '2001-05-05', 'P'),
            ('220014', 7, 104, 'Nanda Saputra', 'Jl. Dahlia No. 14', '2003-06-10', 'L'),
            ('220015', 8, 105, 'Oki Firmansyah', 'Jl. Tulip No. 15', '2002-07-15', 'L'),
            ('220016', 8, 106, 'Putri Amelia', 'Jl. Teratai No. 16', '2001-08-20', 'P'),
            ('220017', 9, 107, 'Qori Ramadhan', 'Jl. Bakung No. 17', '2003-09-25', 'L'),
            ('220018', 9, 108, 'Rizki Akbar', 'Jl. Sepatu No. 18', '2002-10-30', 'L'),
            ('220019', 10, 109, 'Siti Aminah', 'Jl. Anyelir No. 19', '2001-11-05', 'P'),
            ('220020', 10, 110, 'Taufik Hidayat', 'Jl. Wijaya Kusuma No. 20', '2003-12-10', 'L');

            INSERT INTO ruang_kelas (id_kelas, nama_kelas, fasilitas) VALUES
            (1, 'Kelas A', 'Proyektor, AC, Whiteboard'),
            (2, 'Kelas B', 'Proyektor, Whiteboard'),
            (3, 'Kelas C', 'AC, Whiteboard'),
            (4, 'Kelas D', 'LCD, Whiteboard'),
            (5, 'Lab Komputer 1', 'Komputer, Proyektor, AC'),
            (6, 'Lab Komputer 2', 'Komputer, AC'),
            (7, 'Kelas E', 'Proyektor, Whiteboard'),
            (8, 'Kelas F', 'AC, Speaker'),
            (9, 'Ruang Seminar', 'Microphone, Proyektor, Whiteboard'),
            (10, 'Auditorium', 'Sound System, Proyektor, AC');

            INSERT INTO mata_kuliah (id_mk, nama_mk, jam, mahasiswaFK, kelasFK, dosenFK) VALUES
            (1, 'Pemrograman Web', '08:00-10:00', 220001, 1, 101),
            (2, 'Basis Data', '10:00-12:00', 220002, 1, 102),
            (3, 'Algoritma & Struktur Data', '13:00-15:00', 220003, 2, 103),
            (4, 'Jaringan Komputer', '15:00-17:00', 220004, 2, 104),
            (5, 'Sistem Operasi', '08:00-10:00', 220005, 3, 105),
            (6, 'Manajemen Proyek TI', '10:00-12:00', 220006, 3, 106),
            (7, 'Pemrograman Mobile', '13:00-15:00', 220007, 4, 107),
            (8, 'Interaksi Manusia & Komputer', '15:00-17:00', 220008, 4, 108),
            (9, 'Kecerdasan Buatan', '08:00-10:00', 220009, 5, 109),
            (10, 'Etika Profesi TI', '10:00-12:00', 220010, 5, 110);

            INSERT INTO dosen_has_mk (dosenFK, mkFK) VALUES
            (101, 1),
            (102, 2),
            (103, 3),
            (104, 4),
            (105, 5),
            (106, 6),
            (107, 7),
            (108, 8),
            (109, 9),
            (110, 10);

        ";
    }
}
