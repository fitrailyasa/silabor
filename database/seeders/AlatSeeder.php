<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Alat::create([
                'name' => 'Alat #' . $i,
                'serial_number' => 'A1-2023-123-' . $i,
                'auto_validate' => false,
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'date_received' => now()->format('Y-m-d'),
                'source' => $i === 1 ? 'Peminjaman' : 'Hibah',
                'category_id' => 1,
            ]);
        }
    }
}
