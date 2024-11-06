<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    // Menampilkan halaman Tentang
    public function showTentang()
    {
        $filePath = storage_path('app/content.json');
        $contentData = json_decode(file_get_contents($filePath), true);
        $tentangContent = $contentData['tentang'] ?? 'Konten belum tersedia.';
        
        return view('tentang', compact('tentangContent'));
    }

    // Memperbarui konten Tentang dari input
    public function updateContent(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $filePath = storage_path('app/content.json');
        $contentData = json_decode(file_get_contents($filePath), true);
        $contentData['tentang'] = $request->input('content');
        file_put_contents($filePath, json_encode($contentData, JSON_PRETTY_PRINT));

        return response()->json(['success' => true, 'message' => 'Konten berhasil diperbarui']);
    }
}
