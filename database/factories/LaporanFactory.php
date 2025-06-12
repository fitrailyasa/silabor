<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laporan>
 */
class LaporanFactory extends Factory
{
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeThisYear();
        $endDate = $this->faker->dateTimeBetween($startDate, '+7 days');

        $types = ['alat', 'ruangan'];
        $selected = $this->faker->randomElement($types);

        return [
            'user_id' => $this->faker->numberBetween(3, 12),
            'alat_id' => $selected === 'alat' ? $this->faker->numberBetween(1, 10) : null,
            'ruangan_id' => $selected === 'ruangan' ? $this->faker->numberBetween(1, 10) : null,
            'jenis_peminjaman' => $this->faker->randomElement(['Pribadi', 'Kelompok']),
            'tujuan_peminjaman' => $this->faker->sentence(3),
            'catatan' => $this->faker->sentence(5),
            'tgl_peminjaman' => $startDate->format('Y-m-d'),
            'tgl_pengembalian' => $endDate->format('Y-m-d'),
            'jam_peminjaman' => $this->faker->time('H:i'),
            'jam_pengembalian' => $this->faker->time('H:i'),
            'status_peminjaman' => $this->faker->randomElement(['Diterima', 'Menunggu', 'Ditolak']),
            'status_pengembalian' => $this->faker->randomElement(['Sudah Dikembalikan', 'Belum Dikembalikan']),
        ];
    }
}
