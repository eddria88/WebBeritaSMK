@extends('layouts.app')

@section('content')
<div class="admin-wrapper">
    <!-- Sidebar Kiri Sesuai Gambar 1, 2, 3 -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-top">
            <div class="admin-sidebar-school">
                SMK Negeri 1 Surabaya
            </div>

            <nav class="admin-sidebar-menu">
                <a href="{{ route('admin.dashboard') }}" 
                   class="admin-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('admin.informasi.index') }}" 
                   class="admin-menu-link {{ request()->routeIs('admin.informasi.*') ? 'active' : '' }}">
                    Kelola Informasi
                </a>
            </nav>
        </div>

        <div class="admin-sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="admin-sidebar-logout">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Area Konten Utama -->
    <main class="admin-main">
        <header class="admin-topbar">
            <div class="admin-topbar-left">
                <x-mascot :size="48" />
                <h1 class="admin-page-title">@yield('page-title', 'Beranda')</h1>
            </div>

            <div class="admin-topbar-right">
                @hasSection('topbar-actions')
                    @yield('topbar-actions')
                @else
                    <div class="admin-user-info">
                        <span class="admin-user-text">Halo, {{ auth()->user()->nama ?? 'Admin' }}</span>
                        <div class="admin-user-avatar">
                            {{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                @endif
            </div>
        </header>

        <section class="admin-content-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('admin-content')
        </section>
    </main>
</div>
@endsection
