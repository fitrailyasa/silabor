<?php

namespace Database\Factories;

use App\Models\User;
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

        $anggotaId = User::role('mahasiswa')->inRandomOrder()->value('id');

        $dosenId = User::role('dosen')->inRandomOrder()->value('id');

        return [
            'user_id' => $anggotaId,
            'dosen_id' => $dosenId,
            'alat_id' => $selected === 'alat' ? $this->faker->numberBetween(1, 10) : null,
            'ruangan_id' => $selected === 'ruangan' ? $this->faker->numberBetween(1, 10) : null,
            'jenis_peminjaman' => $this->faker->randomElement(['Pribadi', 'Kelompok']),
            'tujuan_peminjaman' => $this->faker->sentence(3),
            'catatan' => $this->faker->sentence(5),
            'tgl_peminjaman' => $startDate->format('Y-m-d'),
            'tgl_pengembalian' => $endDate->format('Y-m-d'),
            'waktu_mulai' => $this->faker->time('H:i'),
            'waktu_selesai' => $this->faker->time('H:i'),
            'status_peminjaman' => $this->faker->randomElement(['Diterima', 'Menunggu', 'Ditolak']),
            'status_pengembalian' => $this->faker->randomElement(['Sudah Dikembalikan', 'Belum Dikembalikan']),
        ];
    }
}
