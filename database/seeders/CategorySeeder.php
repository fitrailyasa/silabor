<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kategori Alat 1',
                'type' => 'alat',
            ],
            [
                'name' => 'Kategori Alat 2',
                'type' => 'alat',
            ],
            [
                'name' => 'Kategori Alat 3',
                'type' => 'alat',
            ],
            [
                'name' => 'Kategori Alat 4',
                'type' => 'alat',
            ],
            [
                'name' => 'Kategori Alat 5',
                'type' => 'alat',
            ],
            [
                'name' => 'Kategori bahan 1',
                'type' => 'bahan',
            ],
            [
                'name' => 'Kategori bahan 2',
                'type' => 'bahan',
            ],
            [
                'name' => 'Kategori bahan 3',
                'type' => 'bahan',
            ],
            [
                'name' => 'Kategori bahan 4',
                'type' => 'bahan',
            ],
            [
                'name' => 'Kategori bahan 5',
                'type' => 'bahan',
            ],
        ];

        foreach ($data as $i) {
            Category::create($i);
        }
    }
}
