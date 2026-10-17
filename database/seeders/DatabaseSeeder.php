<?php

namespace Database\Seeders;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'nama' => 'Siswa',
            'username' => 'siswa',
            'password' => Hash::make('siswa123'),
            'role' => 'user',
        ]);

        User::create([
            'nama' => 'Siswa Satu',
            'username' => 'siswa1',
            'password' => Hash::make('siswa123'),
            'role' => 'user',
        ]);

        User::create([
            'nama' => 'Siswa Dua',
            'username' => 'siswa2',
            'password' => Hash::make('siswa123'),
            'role' => 'user',
        ]);

        User::create([
            'nama' => 'Siswa Tiga',
            'username' => 'siswa3',
            'password' => Hash::make('siswa123'),
            'role' => 'user',
        ]);

        $daftarInfo = [
            [
                'judul' => 'Pengumuman Libur Sekolah',
                'isi' => 'Kegiatan belajar diliburkan sesuai kalender akademik. Masuk kembali sesuai jadwal resmi yang telah ditentukan oleh pihak sekolah.',
                'kategori' => 'Pengumuman',
            ],
            [
                'judul' => 'Pendaftaran Ekstrakurikuler Baru',
                'isi' => 'Pendaftaran kegiatan ekstrakurikuler tahun ajaran ini telah dibuka. Silakan pilih kegiatan yang sesuai dengan minat dan bakatmu melalui pembina masing-masing.',
                'kategori' => 'Kegiatan',
            ],
            [
                'judul' => 'Jadwal Penilaian Tengah Semester',
                'isi' => 'Cek jadwal tiap mata pelajaran pada papan pengumuman kelas dan pastikan membawa kartu pelajar serta perlengkapan ujian lengkap.',
                'kategori' => 'Akademik',
            ],
            [
                'judul' => 'Workshop Pemrograman Web RPL',
                'isi' => 'Seluruh siswa jurusan RPL diundang untuk mengikuti workshop pembuatan aplikasi web modern yang diadakan di Laboratorium Komputer 2.',
                'kategori' => 'Akademik',
            ],
            [
                'judul' => 'Lomba Olahraga Antar Kelas (Classmeeting)',
                'isi' => 'Persiapkan tim kelasmu untuk turnamen futsal dan basket antar kelas. Pendaftaran perwakilan ditutup hari Jumat ini.',
                'kategori' => 'Kegiatan',
            ],
            [
                'judul' => 'Pembaruan Tata Tertib Penggunaan Seragam',
                'isi' => 'Diberitahukan kepada seluruh siswa untuk mematuhi jadwal pemakaian seragam sekolah lengkap dengan atribut dan sepatu hitam polos.',
                'kategori' => 'Pengumuman',
            ],
        ];

        foreach ($daftarInfo as $info) {
            Informasi::create([
                'judul' => $info['judul'],
                'isi' => $info['isi'],
                'kategori' => $info['kategori'],
                'user_id' => $admin->id,
            ]);
        }
    }
}
