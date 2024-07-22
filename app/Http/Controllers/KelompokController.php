<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;

class KelompokController extends Controller
{
    public function index()
    {
        $kelompokData = Kelompok::all();
        return view('welcome', ['kelompokData' => $kelompokData]);
    }

    public function create()
    {
        return view('input');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'alamat' => 'required|string',
            'koordinat_lokasi' => 'required|string',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // Buat data baru di database
        Kelompok::create([
            'nama_kelompok' => $request->nama_kelompok,
            'alamat' => $request->alamat,
            'jumlah_anggota' => $request->jumlah_anggota,
            'nama_ketua_kelompok' => $request->nama_ketua_kelompok,
            'nomor_hp' => $request->nomor_hp,
            'koordinat_lokasi' => $request->koordinat_lokasi,
            'jenis_budidaya' => $request->jenis_budidaya,
            'jenis_komoditas' => $request->jenis_komoditas,
            'tanggal_sk' => $request->tanggal_sk,
            'luas_lahan' => $request->luas_lahan,
            'produksi_siklus' => $request->produksi_siklus,
            'siklus_tahun' => $request->siklus_tahun,
            'bantuan' => $request->bantuan,
        ]);

        // Redirect ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Data berhasil disimpan!');
    } 
    
    public function edit($id)
    {
        $kelompok = Kelompok::findOrFail($id);
        return view('edit', ['kelompok' => $kelompok]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama_kelompok' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jumlah_anggota' => 'nullable|integer',
            'nama_ketua_kelompok' => 'nullable|string|max:255',
            'nomor_hp' => 'nullable|string|max:15',
            'koordinat_lokasi' => 'required|string|max:255',
            'jenis_budidaya' => 'nullable|string|max:255',
            'jenis_komoditas' => 'nullable|string|max:255',
            'tanggal_sk' => 'nullable|date',
            'luas_lahan' => 'nullable|string|max:255',
            'produksi_siklus' => 'nullable|string|max:255',
            'siklus_tahun' => 'nullable|string|max:255',
            'bantuan' => 'nullable|string|max:255',
        ]);

        // Temukan data berdasarkan ID
        $kelompok = Kelompok::findOrFail($id);

        // Update data
        $kelompok->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kelompok.index')->with('success', 'Data Kelompok berhasil diperbarui.');
    }
}
