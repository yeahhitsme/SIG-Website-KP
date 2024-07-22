<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelompokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');
            $table->text('alamat');
            $table->integer('jumlah_anggota')->nullable();
            $table->string('nama_ketua_kelompok')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('koordinat_lokasi');
            $table->string('jenis_budidaya')->nullable();
            $table->string('jenis_komoditas')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('luas_lahan')->nullable();
            $table->string('produksi_siklus')->nullable();
            $table->string('siklus_tahun')->nullable();
            $table->string('bantuan')->nullable();
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
        Schema::dropIfExists('kelompok');
    }
}
