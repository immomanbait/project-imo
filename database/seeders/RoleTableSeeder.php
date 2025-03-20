<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menghapus cache permission yang ada
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Membuat role jika belum ada
        Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);
    }
}