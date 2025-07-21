<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Role
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'mahasiswa']);

        // Buat User Admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($adminRole);

        // (Opsional) Buat 1 user mahasiswa
        $user = User::factory()->create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@user.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($userRole);
    }
}
