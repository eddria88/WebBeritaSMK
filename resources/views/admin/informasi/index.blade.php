@extends('layouts.admin')

@section('title', 'Kelola Informasi - SMK Negeri 1 Surabaya')
@section('page-title', 'Kelola Informasi')

@section('topbar-actions')
<a href="{{ route('admin.informasi.create') }}" class="btn-tambah-informasi">
    Tambah Informasi
</a>
@endsection

@section('admin-content')
<div class="mockup-big-box">
    @if($informasi->isEmpty())
        <div style="text-align: center; padding: 4rem 1rem; color: var(--text-muted);">
            <p style="font-size: 1.15rem; font-weight: 700; color: var(--navy);">Belum ada informasi sekolah.</p>
            <p style="margin-top: 0.5rem;">Klik tombol "Tambah Informasi" di kanan atas untuk membuat informasi baru.</p>
        </div>
    @else
        <table class="mockup-table">
            <thead>
                <tr>
                    <th style="width: 45%;">Judul</th>
                    <th style="width: 22%;">Kategori</th>
                    <th style="width: 18%;">Dibuat</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($informasi as $item)
                    <tr>
                        <td class="table-judul">{{ $item->judul }}</td>
                        <td>
                            <span class="badge {{ match($item->kategori) {
                                'Akademik' => 'badge-akademik',
                                'Kegiatan' => 'badge-kegiatan',
                                'Pengumuman' => 'badge-pengumuman',
                                default => 'badge-pengumuman'
                            } }}">
                                {{ $item->kategori }}
                            </span>
                        </td>
                        <td class="table-date">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td style="text-align: center;">
                            <div style="display: inline-flex; gap: 0.6rem;">
                                <a href="{{ route('admin.informasi.edit', $item) }}" class="btn-action-edit">
                                    Ubah
                                </a>

                                <form action="{{ route('admin.informasi.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-delete">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
