<?php

namespace Database\Seeders;

use App\Models\Category;
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
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 2',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 3',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 4',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 5',
                'kapasitas' => 5,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 6',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 7',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 8',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 9',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 10',
                'kapasitas' => 10,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'category_id' => $this->Category('Ruangan'),
            ],
        ];

        foreach ($data as $i) {
            Ruangan::create($i);
        }
    }

    private function Category(string $name): string
    {
        $category = Category::where('name', $name)->first();
        if (!$category) {
            $category = Category::create([
                'name' => $name,
            ]);
        }
        return $category->id;
    }
}
