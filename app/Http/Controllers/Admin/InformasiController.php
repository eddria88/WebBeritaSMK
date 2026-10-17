<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformasiController extends Controller
{
    /**
     * Tampilkan daftar informasi untuk admin.
     */
    public function index(): View
    {
        $informasi = Informasi::with('user')->latest()->get();

        return view('admin.informasi.index', [
            'informasi' => $informasi,
        ]);
    }

    /**
     * Tampilkan formulir penambahan informasi baru.
     */
    public function create(): View
    {
        $kategoriList = ['Akademik', 'Kegiatan', 'Pengumuman'];

        return view('admin.informasi.create', [
            'kategoriList' => $kategoriList,
        ]);
    }

    /**
     * Simpan data informasi baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'kategori' => ['required', 'string', 'in:Akademik,Kegiatan,Pengumuman'],
            'isi' => ['required', 'string'],
        ], [
            'judul.required' => 'Judul informasi wajib diisi.',
            'judul.max' => 'Judul informasi maksimal 150 karakter.',
            'kategori.required' => 'Pilih kategori informasi.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',
            'isi.required' => 'Isi informasi wajib diisi.',
        ]);

        $request->user()->informasi()->create($validated);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan formulir pengubahan informasi.
     */
    public function edit(Informasi $informasi): View
    {
        $kategoriList = ['Akademik', 'Kegiatan', 'Pengumuman'];

        return view('admin.informasi.edit', [
            'informasi' => $informasi,
            'kategoriList' => $kategoriList,
        ]);
    }

    /**
     * Perbarui data informasi di database.
     */
    public function update(Request $request, Informasi $informasi): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:150'],
            'kategori' => ['required', 'string', 'in:Akademik,Kegiatan,Pengumuman'],
            'isi' => ['required', 'string'],
        ], [
            'judul.required' => 'Judul informasi wajib diisi.',
            'judul.max' => 'Judul informasi maksimal 150 karakter.',
            'kategori.required' => 'Pilih kategori informasi.',
            'kategori.in' => 'Kategori yang dipilih tidak valid.',
            'isi.required' => 'Isi informasi wajib diisi.',
        ]);

        $informasi->update($validated);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Hapus informasi dari database.
     */
    public function destroy(Informasi $informasi): RedirectResponse
    {
        $informasi->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi telah berhasil dihapus.');
    }
}
