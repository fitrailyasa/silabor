<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Ruangan 1',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
            ],
            [
                'name' => 'Ruangan 2',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
            ],
            [
                'name' => 'Ruangan 3',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
            ],
            [
                'name' => 'Ruangan 4',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
            ],
            [
                'name' => 'Ruangan 5',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
            ],
            [
                'name' => 'Ruangan 6',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
            ],
            [
                'name' => 'Ruangan 7',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
            ],
            [
                'name' => 'Ruangan 8',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
            ],
            [
                'name' => 'Ruangan 9',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
            ],
            [
                'name' => 'Ruangan 10',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
            ],
        ];

        foreach ($data as $i) {
            Ruangan::create($i);
        }
    }
}
