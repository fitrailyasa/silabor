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
                'name' => 'Alat #1',
                'serial_number' => 'A1-2023-123-1',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #2',
                'serial_number' => 'A1-2023-123-2',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #3',
                'serial_number' => 'A1-2023-123-3',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #4',
                'serial_number' => 'A1-2023-123-4',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #5',
                'serial_number' => 'A1-2023-123-5',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #6',
                'serial_number' => 'A1-2023-123-6',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #7',
                'serial_number' => 'A1-2023-123-7',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #8',
                'serial_number' => 'A1-2023-123-8',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #9',
                'serial_number' => 'A1-2023-123-9',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
            [
                'name' => 'Alat #10',
                'serial_number' => 'A1-2023-123-10',
                'desc' => 'Lorem ipsum dolor sit amet.',
                'location' => 1,
                'detail_location' => 'Room A101',
                'category_id' => 1,
            ],
        ];

        foreach ($data as $i) {
            Alat::create($i);
        }
    }
}
