@extends('layouts.app')

@section('title', 'Info seru hari ini! - SMK Negeri 1 Surabaya')

@section('content')
<!-- Navbar Siswa Persis Mockup Image 4 -->
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

<!-- Konten Halaman Siswa -->
<main class="mockup-user-main">
    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom: 2rem;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Header Tengah Persis Gambar 4 (Tanpa Maskot) -->
    <header class="mockup-page-header">
        <h1 class="mockup-main-title">Info seru hari ini!</h1>
        <p class="mockup-subtitle">Pengumuman dan kabar terbaru dari sekolah.</p>
    </header>

    <!-- Tombol Filter Kategori (Rata Kiri Sesuai Gambar 4) -->
    <div class="mockup-filter-row">
        <a href="{{ route('informasi.index') }}" 
           class="mockup-filter-pill pill-semua {{ $kategoriAktif === 'Semua' ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('informasi.index', ['kategori' => 'Pengumuman']) }}" 
           class="mockup-filter-pill pill-pengumuman {{ $kategoriAktif === 'Pengumuman' ? 'active' : '' }}">
            Pengumuman
        </a>
        <a href="{{ route('informasi.index', ['kategori' => 'Akademik']) }}" 
           class="mockup-filter-pill pill-akademik {{ $kategoriAktif === 'Akademik' ? 'active' : '' }}">
            Akademik
        </a>
        <a href="{{ route('informasi.index', ['kategori' => 'Kegiatan']) }}" 
           class="mockup-filter-pill pill-kegiatan {{ $kategoriAktif === 'Kegiatan' ? 'active' : '' }}">
            Kegiatan
        </a>
    </div>

    <!-- Grid Kartu Informasi (3 Kolom Persis Gambar 4) -->
    @if($daftarInformasi->isEmpty())
        <div style="text-align: center; padding: 4rem 1rem; color: var(--text-muted); background: #FFFFFF; border-radius: 20px; border: 2px dashed #CBD5E1;">
            <p style="font-size: 1.2rem; font-weight: 700; color: var(--navy);">Belum ada informasi pada kategori ini.</p>
            <p style="margin-top: 0.5rem;">Silakan pilih kategori lain atau kembali ke tombol "Semua".</p>
        </div>
    @else
        <div class="mockup-cards-grid">
            @foreach($daftarInformasi as $info)
                @php
                    $cardTheme = match($info->kategori) {
                        'Akademik' => 'card-theme-akademik',
                        'Kegiatan' => 'card-theme-kegiatan',
                        'Pengumuman' => 'card-theme-pengumuman',
                        default => 'card-theme-pengumuman',
                    };
                    $badgeTheme = match($info->kategori) {
                        'Akademik' => 'badge-akademik',
                        'Kegiatan' => 'badge-kegiatan',
                        'Pengumuman' => 'badge-pengumuman',
                        default => 'badge-pengumuman',
                    };
                @endphp
                <div class="mockup-card {{ $cardTheme }}">
                    <div>
                        <span class="mockup-card-badge {{ $badgeTheme }}">
                            {{ $info->kategori }}
                        </span>
                        <h2 class="mockup-card-title">{{ $info->judul }}</h2>
                        <p class="mockup-card-text">{{ $info->isi }}</p>
                    </div>

                    <div style="margin-top: 1.25rem;">
                        <a href="{{ route('informasi.show', $info) }}" class="mockup-card-link">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>

<!-- Modal Detail Informasi -->
<div id="detailModal" class="modal-overlay" onclick="handleOverlayClick(event)">
    <div class="modal-box">
        <div class="modal-header">
            <div>
                <span id="modalBadge" class="mockup-card-badge" style="margin-bottom: 0.5rem; display: inline-block;"></span>
                <h3 id="modalTitle" class="modal-title"></h3>
                <span id="modalDate" style="display: block; font-size: 0.85rem; color: var(--text-muted); margin-top: 0.25rem;"></span>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeDetailModal()">&times;</button>
        </div>
        <div id="modalContent" class="modal-body"></div>
        <div style="text-align: right;">
            <button type="button" class="btn-batal-informasi" onclick="closeDetailModal()">Tutup</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openDetailModal(title, category, badgeClass, date, content) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDate').textContent = 'Dipublikasikan pada: ' + date;
        document.getElementById('modalContent').textContent = content;
        
        const badgeElem = document.getElementById('modalBadge');
        badgeElem.textContent = category;
        badgeElem.className = 'mockup-card-badge ' + badgeClass;

        document.getElementById('detailModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    function handleOverlayClick(event) {
        if (event.target === document.getElementById('detailModal')) {
            closeDetailModal();
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeDetailModal();
        }
    });
</script>
@endpush
