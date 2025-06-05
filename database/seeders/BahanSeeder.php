<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Seeder;

class BahanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Bahan 1',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 1,
            ],
            [
                'name' => 'Bahan 2',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 1,
            ],
            [
                'name' => 'Bahan 3',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 2,
            ],
            [
                'name' => 'Bahan 4',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 2,
            ],
            [
                'name' => 'Bahan 5',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 3,
            ],
            [
                'name' => 'Bahan 6',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 3,
            ],
            [
                'name' => 'Bahan 7',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 4,
            ],
            [
                'name' => 'Bahan 8',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 4,
            ],
            [
                'name' => 'Bahan 9',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 5,
            ],
            [
                'name' => 'Bahan 10',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room B101',
                'category_id' => 5,
            ],
        ];

        foreach ($data as $i) {
            Bahan::create($i);
        }
    }
}
