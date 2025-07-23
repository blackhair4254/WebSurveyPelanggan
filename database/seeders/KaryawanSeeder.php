<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    
    public function run()
    {
        Karyawan::updateOrCreate([
            'email' => 'staff@gmail.com',
        ], [
            'nama' => 'staff A',
            'password' => Hash::make('staff123'),
            'role' => 'karyawan',
        ]);
    }
}
