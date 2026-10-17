@extends('layouts.admin')

@section('title', 'Beranda Admin - SMK Negeri 1 Surabaya')
@section('page-title', 'Beranda')

@section('admin-content')
<!-- 3 Kartu Ringkasan -->
<div class="stats-grid">
    <div class="stat-card stat-card-pink">
        <span class="stat-card-label">Total Informasi</span>
        <div class="stat-card-value">{{ $totalInformasi }}</div>
    </div>

    <div class="stat-card stat-card-blue">
        <span class="stat-card-label">Total User</span>
        <div class="stat-card-value">{{ $totalUser }}</div>
    </div>

    <div class="stat-card stat-card-green">
        <span class="stat-card-label">Kategori</span>
        <div class="stat-card-value">{{ $totalKategori }}</div>
    </div>
</div>

<!-- 2 Kotak Detail di Bawah -->
<div class="dashboard-grid">
    <!-- Kotak Kiri: Informasi per Kategori -->
    <div class="dashboard-box">
        <h3 class="dashboard-box-title">Informasi per Kategori</h3>
        
        <div class="category-bar-list">
            @foreach($kategoriCounts as $kategori => $count)
                @php
                    $pct = $totalInformasi > 0 ? round(($count / $totalInformasi) * 100) : 0;
                    $fillColor = match($kategori) {
                        'Akademik' => 'var(--green)',
                        'Kegiatan' => 'var(--pink)',
                        'Pengumuman' => 'var(--blue)',
                        default => 'var(--yellow)',
                    };
                @endphp
                <div class="category-bar-item">
                    <div class="category-bar-header" style="align-items: center;">
                        <span class="badge {{ match($kategori) {
                            'Akademik' => 'badge-akademik',
                            'Kegiatan' => 'badge-kegiatan',
                            'Pengumuman' => 'badge-pengumuman',
                            default => 'badge-pengumuman'
                        } }}">
                            {{ $kategori }}
                        </span>
                        <span style="font-weight: 700; color: var(--navy); font-size: 0.95rem;">{{ $count }} Informasi ({{ $pct }}%)</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $pct }}%; background-color: {{ $fillColor }};"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Kotak Kanan: Informasi Terbaru -->
    <div class="dashboard-box">
        <h3 class="dashboard-box-title">Informasi Terbaru</h3>

        @if($informasiTerbaru->isEmpty())
            <p style="color: var(--text-muted); font-size: 0.95rem;">Belum ada informasi yang ditambahkan.</p>
        @else
            <ul class="recent-list">
                @foreach($informasiTerbaru as $info)
                    <li class="recent-item">
                        <div class="recent-item-header">
                            <span class="badge {{ match($info->kategori) {
                                'Akademik' => 'badge-akademik',
                                'Kegiatan' => 'badge-kegiatan',
                                'Pengumuman' => 'badge-pengumuman',
                                default => 'badge-pengumuman'
                            } }}">
                                {{ $info->kategori }}
                            </span>
                            <span class="recent-item-date">{{ $info->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="recent-item-title">{{ $info->judul }}</div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
