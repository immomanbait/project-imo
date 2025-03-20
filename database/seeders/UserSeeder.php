<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin1234'), // Pastikan password di-hash
        ]);

        // Membuat pengguna biasa
        User::create([
           
            'name' => 'User ',
            'email' => 'user@example.com',
            'password' => Hash::make('1234qwer'), // Pastikan password di-hash
        ]);
    }
}