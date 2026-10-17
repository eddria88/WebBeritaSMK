<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformasiController extends Controller
{
    /**
     * Tampilkan halaman utama informasi untuk siswa.
     */
    public function index(Request $request): View
    {
        $kategori = $request->query('kategori');

        $query = Informasi::with('user')->latest();

        if ($kategori && in_array($kategori, ['Pengumuman', 'Akademik', 'Kegiatan'], true)) {
            $query->where('kategori', $kategori);
        }

        $daftarInformasi = $query->get();

        return view('informasi.index', [
            'daftarInformasi' => $daftarInformasi,
            'kategoriAktif' => $kategori ?? 'Semua',
        ]);
    }

    /**
     * Tampilkan detail informasi sekolah.
     */
    public function show(Informasi $informasi): View
    {
        $informasi->load('user');

        $infoLainnya = Informasi::where('id', '!=', $informasi->id)
            ->latest()
            ->take(4)
            ->get();

        return view('informasi.show', [
            'informasi' => $informasi,
            'infoLainnya' => $infoLainnya,
        ]);
    }
}
