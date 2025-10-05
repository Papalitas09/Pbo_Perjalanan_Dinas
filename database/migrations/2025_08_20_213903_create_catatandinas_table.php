<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatandinas', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi');
            $table->date('tanggal_berangkat');
            $table->date('tanggal_pulang');
            $table->integer('no_induk');
            $table->foreign('no_induk')->references('no_induk')->on('pegawai')->onDelete('cascade');
            $table->enum('status', ['Belum Berlangsung','Berlangsung', 'Selesai'])->default('Belum Berlangsung');
            $table->enum('status_tampil', ['Tertunda','Disetujui', 'Ditolak'])->default('Tertunda');
            $table->text('catatan_lainnya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatandinas');
    }
};
