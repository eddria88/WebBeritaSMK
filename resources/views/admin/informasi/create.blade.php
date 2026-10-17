@extends('layouts.admin')

@section('title', 'Tambah Informasi - SMK Negeri 1 Surabaya')
@section('page-title', 'Tambah Informasi')

@section('admin-content')
<div class="mockup-form-box">
    <form action="{{ route('admin.informasi.store') }}" method="POST">
        @csrf

        <div class="mockup-form-group">
            <label for="judul" class="mockup-label">Judul</label>
            <input 
                type="text" 
                id="judul" 
                name="judul" 
                class="mockup-input" 
                value="{{ old('judul') }}" 
                required
            >
            @error('judul')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mockup-form-group">
            <label for="kategori" class="mockup-label">Kategori</label>
            <select id="kategori" name="kategori" class="mockup-input" required>
                <option value="" disabled {{ old('kategori') ? '' : 'selected' }}>Pilih Kategori...</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat }}" {{ old('kategori') === $kat ? 'selected' : '' }}>
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
            >{{ old('isi') }}</textarea>
            @error('isi')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="mockup-form-actions">
            <button type="submit" class="btn-simpan-informasi">
                Simpan Informasi
            </button>
            <a href="{{ route('admin.informasi.index') }}" class="btn-batal-informasi">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
