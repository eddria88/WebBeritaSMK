@extends('layouts.app')

@section('title', $informasi->judul . ' - SMK Negeri 1 Surabaya')

@section('content')
<!-- Navbar Siswa Persis Gambar 3 -->
<nav class="mockup-navbar">
    <div class="mockup-navbar-inner">
        <a href="{{ route('informasi.index') }}" class="mockup-navbar-brand">
            SMK Negeri 1 Surabaya
        </a>

        <div class="mockup-navbar-right">
            <span class="mockup-navbar-user">Halo, {{ auth()->user()->nama ?? 'User' }}</span>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="mockup-navbar-logout">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Konten Halaman Detail Informasi (Persis Gambar 3) -->
<main class="detail-page-container">
    <!-- Link Kembali Ke Daftar di Kiri Atas -->
    <div class="detail-back-container">
        <a href="{{ route('informasi.index') }}" class="detail-back-link">
            Kembali Ke Daftar
        </a>
    </div>

    <!-- Tata Letak 2 Kolom: Kartu Utama (Kiri) & Info Lainnya (Kanan) -->
    <div class="detail-two-cols">
        <!-- Kolom Kiri: Kartu Informasi Utama -->
        @php
            $mainCardTheme = match($informasi->kategori) {
                'Akademik' => 'card-theme-akademik',
                'Kegiatan' => 'card-theme-kegiatan',
                'Pengumuman' => 'card-theme-pengumuman',
                default => 'card-theme-pengumuman',
            };
            $mainBadgeTheme = match($informasi->kategori) {
                'Akademik' => 'badge-akademik',
                'Kegiatan' => 'badge-kegiatan',
                'Pengumuman' => 'badge-pengumuman',
                default => 'badge-pengumuman',
            };
        @endphp
        <div class="detail-main-card {{ $mainCardTheme }}">
            <div>
                <!-- Baris Lencana & Tanggal -->
                <div class="detail-meta-row">
                    <span class="mockup-card-badge {{ $mainBadgeTheme }}">
                        {{ $informasi->kategori }}
                    </span>
                    <span class="detail-meta-date">
                        {{ $informasi->created_at->format('j F Y') }}
                    </span>
                </div>

                <!-- Judul Besar -->
                <h1 class="detail-main-title">{{ $informasi->judul }}</h1>

                <!-- Isi Informasi Lengkap -->
                <div class="detail-main-text">
                    {{ $informasi->isi }}
                </div>
            </div>

            <!-- Tombol Kuning "Kembali Ke daftar" di Bawah Kiri -->
            <div style="margin-top: 2.5rem;">
                <a href="{{ route('informasi.index') }}" class="btn-kembali-daftar">
                    Kembali Ke daftar
                </a>
            </div>
        </div>

        <!-- Kolom Kanan: Info Lainnya -->
        <aside class="detail-sidebar-col">
            <!-- Header Info Lainnya dengan Maskot -->
            <div class="info-lainnya-header">
                <x-mascot :size="48" />
                <h2 class="info-lainnya-title">Info Lainnya</h2>
            </div>

            <!-- Daftar Kartu Samping -->
            <div class="info-lainnya-list">
                @forelse($infoLainnya as $other)
                    @php
                        $sideCardTheme = match($other->kategori) {
                            'Akademik' => 'card-theme-akademik',
                            'Kegiatan' => 'card-theme-kegiatan',
                            'Pengumuman' => 'card-theme-pengumuman',
                            default => 'card-theme-pengumuman',
                        };
                        $sideBadgeTheme = match($other->kategori) {
                            'Akademik' => 'badge-akademik',
                            'Kegiatan' => 'badge-kegiatan',
                            'Pengumuman' => 'badge-pengumuman',
                            default => 'badge-pengumuman',
                        };
                    @endphp
                    <div class="mockup-card {{ $sideCardTheme }}" style="min-height: 200px;">
                        <div>
                            <span class="mockup-card-badge {{ $sideBadgeTheme }}">
                                {{ $other->kategori }}
                            </span>
                            <h3 class="mockup-card-title" style="font-size: 1.15rem;">{{ $other->judul }}</h3>
                            <p class="mockup-card-text">{{ $other->isi }}</p>
                        </div>
                        <div style="margin-top: 1rem;">
                            <a href="{{ route('informasi.show', $other) }}" class="mockup-card-link">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--text-muted); font-size: 0.95rem;">Tidak ada informasi lainnya.</p>
                @endforelse
            </div>
        </aside>
    </div>
</main>
@endsection
