<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman ringkasan dashboard admin.
     */
    public function index(): View
    {
        $totalInformasi = Informasi::count();
        $totalUser = User::where('role', 'user')->count();
        $totalKategori = 3; // Akademik, Kegiatan, Pengumuman

        $kategoriList = ['Akademik', 'Kegiatan', 'Pengumuman'];
        $kategoriCounts = [];
        foreach ($kategoriList as $kat) {
            $kategoriCounts[$kat] = Informasi::where('kategori', $kat)->count();
        }

        $informasiTerbaru = Informasi::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalInformasi' => $totalInformasi,
            'totalUser' => $totalUser,
            'totalKategori' => $totalKategori,
            'kategoriCounts' => $kategoriCounts,
            'informasiTerbaru' => $informasiTerbaru,
        ]);
    }
}
