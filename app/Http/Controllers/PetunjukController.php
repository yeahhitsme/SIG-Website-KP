<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetunjukController extends Controller
{
    // Menampilkan halaman Petunjuk
    public function showPetunjuk()
    {
        $filePath = storage_path('app/petunjuk.json');  // Menggunakan petunjuk.json
        $contentData = json_decode(file_get_contents($filePath), true);
        $petunjukContent = $contentData['petunjuk'] ?? 'Konten petunjuk belum tersedia.';
        
        // Mengirimkan variabel petunjukContent ke tampilan
        return view('petunjuk', compact('petunjukContent'));
    }

    // Memperbarui konten Petunjuk
    public function updateContent(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $filePath = storage_path('app/petunjuk.json');  // Menggunakan petunjuk.json
        $contentData = json_decode(file_get_contents($filePath), true);
        $contentData['petunjuk'] = $request->input('content');
        file_put_contents($filePath, json_encode($contentData, JSON_PRETTY_PRINT));

        return response()->json(['success' => true, 'message' => 'Konten berhasil diperbarui']);
    }
}
