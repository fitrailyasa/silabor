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
                'kapasitas' => 50,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 2',
                'kapasitas' => 50,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 3',
                'kapasitas' => 50,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 4',
                'kapasitas' => 50,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 5',
                'kapasitas' => 50,
                'gedung' => 'GKU 1',
                'lantai' => 'Lantai 1',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 6',
                'kapasitas' => 100,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 7',
                'kapasitas' => 100,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 8',
                'kapasitas' => 100,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 9',
                'kapasitas' => 100,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
                'category_id' => $this->Category('Ruangan'),
            ],
            [
                'name' => 'Ruangan 10',
                'kapasitas' => 100,
                'gedung' => 'GKU 2',
                'lantai' => 'Lantai 2',
                'keterangan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, quia.',
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
                'type' => 'ruangan',
            ]);
        }
        return $category->id;
    }
}
