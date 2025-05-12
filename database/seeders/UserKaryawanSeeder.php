<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserKaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $users = [
            [
                'email' => 'putri@gmail.com',
                'password' => bcrypt('7117'),
                'level' => 'pemilik',
                'aktif' => true,
                'karyawan' => [
                    'nama_karyawan' => 'Putri Aulia Rahma',
                    'alamat' => 'Jl P Jayakarta 141 Bl C/14, Dki Jakarta, Dki Jakarta, Jakarta, 10730',
                    'no_hp' => '081234567890',
                    'jabatan' => 'pemilik',
                    'status' => 'aktif'
                ]
            ],
            [
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('7117'),
                'level' => 'admin',
                'aktif' => true,
                'karyawan' => [
                    'nama_karyawan' => 'Abang Admin ',
                    'alamat' => 'Jl Bukit Gading Raya Ruko Gading Bukit Indah Bl M/10,Kelapa Gading Barat, Ke, Jakarta',
                    'no_hp' => '081234567890',
                    'jabatan' => 'admin',
                    'status' => 'aktif'
                ]
            ],
            [
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('7117'),
                'level' => 'bendahara',
                'aktif' => true,
                'karyawan' => [
                    'nama_karyawan' => 'Abang Bendahara ',
                    'alamat' => 'Jl Wijaya II Wijaya Graha Puri Bl G/33, Dki Jakarta, Dki Jakarta, Jakarta, 12160',
                    'no_hp' => '081234567890',
                    'jabatan' => 'bendahara',
                    'status' => 'aktif'
                ]
            ],
            // Tambahkan data lainnya dengan format yang sama
        ];

        foreach($users as $userData) {
            // Buat user
            $user = User::create([
                'email' => $userData['email'],
                'password' => $userData['password'],
                'level' => $userData['level'],
                'aktif' => $userData['aktif']
            ]);

            // Buat karyawan terkait
            $karyawanData = $userData['karyawan'];
            $karyawanData['id_user'] = $user->id;
            Karyawan::create($karyawanData);
        }
    }
}
