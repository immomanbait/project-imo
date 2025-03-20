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
       // Membuat Admin
       $admin = User::create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('admin1234'),
    ]);
    $admin->assignRole('admin'); // Assign role admin
        // Membuat pengguna biasa
      // Membuat User biasa
      $user = User::create([
        'name' => 'User',
        'email' => 'user@example.com',
        'password' => Hash::make('1234qwer'),
    ]);
    $user->assignRole('user'); // Assign role user
    }
}