<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat roles jika belum ada
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $dosenRole = Role::firstOrCreate(['name' => 'dosen']);
        $mahasiswaRole = Role::firstOrCreate(['name' => 'mahasiswa']);

        // Daftar user
        $users = [
            [
                'name' => 'Super Administrator',
                'email' => 'super@admin.com',
                'status' => 'aktif',
                'no_hp' => '081234567890',
                'password' => Hash::make('password'),
                'role' => $superAdminRole->id
            ],
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'status' => 'aktif',
                'no_hp' => '081234567890',
                'password' => Hash::make('password'),
                'role' => $adminRole->id
            ],
            [
                'name' => 'Dosen',
                'email' => 'dosen@dosen.com',
                'status' => 'aktif',
                'no_hp' => '081234567890',
                'password' => Hash::make('password'),
                'role' => $dosenRole->id
            ],
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@mahasiswa.com',
                'status' => 'aktif',
                'no_hp' => '081234567890',
                'password' => Hash::make('password'),
                'role' => $mahasiswaRole->id
            ]
        ];

        // Insert user satu per satu dan assign role
        foreach ($users as $userData) {
            $role = $userData['role'];
            unset($userData['role']); // buang field role sebelum insert

            $user = User::create($userData);
            $user->assignRole($role);
        }

        User::factory()
            ->afterCreating(function ($user) {
                $user->assignRole('dosen');
            })
            ->count(5)
            ->create();

        User::factory()
            ->afterCreating(function ($user) {
                $user->assignRole('mahasiswa');
            })
            ->count(20)
            ->create();
    }
}
