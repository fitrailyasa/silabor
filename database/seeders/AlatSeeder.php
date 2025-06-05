<?php

namespace Database\Seeders;

use App\Models\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Alat 1',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat 2',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat 3',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 2,
            ],
            [
                'name' => 'Alat 4',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 2,
            ],
            [
                'name' => 'Alat 5',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 3,
            ],
            [
                'name' => 'Alat 6',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 3,
            ],
            [
                'name' => 'Alat 7',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 4,
            ],
            [
                'name' => 'Alat 8',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 4,
            ],
            [
                'name' => 'Alat 9',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 5,
            ],
            [
                'name' => 'Alat 10',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 'Room A101',
                'category_id' => 5,
            ],
        ];

        foreach ($data as $i) {
            Alat::create($i);
        }
    }
}
