<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('dosen_id')->nullable();
            $table->foreignId('alat_id')->nullable();
            $table->foreignId('ruangan_id')->nullable();
            $table->string('jenis_peminjaman')->nullable();
            $table->string('tujuan_peminjaman')->nullable();
            $table->string('catatan')->nullable();
            $table->date('tgl_peminjaman')->nullable();
            $table->date('tgl_penggunaan')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->string('waktu_mulai')->nullable();
            $table->string('waktu_selesai')->nullable();
            $table->string('status_peminjaman')->nullable();
            $table->string('status_penggunaan')->nullable();
            $table->string('status_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporans');
    }
};
