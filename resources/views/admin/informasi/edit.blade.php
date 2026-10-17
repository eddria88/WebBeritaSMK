@extends('layouts.admin')

@section('title', 'Ubah Informasi - SMK Negeri 1 Surabaya')
@section('page-title', 'Ubah Informasi')

@section('admin-content')
<div class="mockup-form-box">
    <form action="{{ route('admin.informasi.update', $informasi) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mockup-form-group">
            <label for="judul" class="mockup-label">Judul</label>
            <input 
                type="text" 
                id="judul" 
                name="judul" 
                class="mockup-input" 
                value="{{ old('judul', $informasi->judul) }}" 
                required
            >
            @error('judul')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mockup-form-group">
            <label for="kategori" class="mockup-label">Kategori</label>
            <select id="kategori" name="kategori" class="mockup-input" required>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ old('kategori', $informasi->kategori) === $kat ? 'selected' : '' }}>
                        {{ $kat }}
                    </option>
                @endforeach
            </select>
            @error('kategori')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mockup-form-group">
            <label for="isi" class="mockup-label">Isi Informasi</label>
            <textarea 
                id="isi" 
                name="isi" 
                class="mockup-textarea" 
                rows="7" 
                required
            >{{ old('isi', $informasi->isi) }}</textarea>
            @error('isi')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mockup-form-actions">
            <button type="submit" class="btn-simpan-informasi">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.informasi.index') }}" class="btn-batal-informasi">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
