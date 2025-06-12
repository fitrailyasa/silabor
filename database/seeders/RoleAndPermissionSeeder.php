<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        $entities = [
            'dashboard' => ['admin', 'client'],
            'user' => ['view', 'create', 'edit', 'delete'],
            'role' => ['view', 'create', 'edit', 'delete'],
            'category' => ['view', 'create', 'edit', 'delete'],
            'alat' => ['view', 'create', 'edit', 'delete'],
            'bahan' => ['view', 'create', 'edit', 'delete'],
            'ruangan' => ['view', 'create', 'edit', 'delete'],
            'transaksi' => ['view'],
            'laporan' => ['view'],
            'client' => ['check', 'pengajuan-peminjaman', 'penggunaan-alat', 'penggunaan-ruangan', 'history'],
        ];

        foreach ($entities as $entity => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "{$action}-{$entity}"]);
            }
        }

        $roles = [
            'super-admin' => Permission::where('name', 'not like', '%-client')->pluck('name')->toArray(),
            'admin' => Permission::where('name', 'not like', '%-role')->where('name', 'not like', '%-client')->pluck('name')->toArray(),
            'dosen' => [],
            'mahasiswa' => [
                'check-client',
                'pengajuan-peminjaman-client',
                'penggunaan-alat-client',
                'penggunaan-ruangan-client',
                'history-client',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($permissions);
        }
    }
}
