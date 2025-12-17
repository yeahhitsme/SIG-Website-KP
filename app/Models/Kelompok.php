<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompok';

    protected $fillable = [
        'nama_kelompok',
        'alamat',
        'jumlah_anggota',
        'nama_ketua_kelompok',
        'nomor_hp',
        'koordinat_lokasi',
        'jenis_budidaya',
        'jenis_komoditas',
        'tanggal_sk',
        'luas_lahan',
        'produksi_siklus',
        'siklus_tahun',
        'bantuan',
    ];
}
