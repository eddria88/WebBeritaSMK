<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SMK Negeri 1 Surabaya</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .login-btn-submit {
            width: 100%;
            background-color: var(--yellow-primary);
            color: var(--navy-dark);
            font-family: var(--font-heading);
            font-size: 1.2rem;
            font-weight: 800;
            padding: 14px 24px;
            border: 2px solid var(--navy-dark);
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 4px 4px 0px var(--navy-dark);
            transition: all 0.15s ease;
            margin-top: 10px;
        }
        .login-btn-submit:hover {
            background-color: var(--yellow-hover);
            transform: translate(-1px, -1px);
            box-shadow: 5px 5px 0px var(--navy-dark);
        }
        .login-btn-submit:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px var(--navy-dark);
        }

        .quick-role-badge {
            cursor: pointer;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
            border: 1.5px solid #0a1945;
            background-color: #ffffff;
            transition: all 0.15s ease;
        }
        .quick-role-badge:hover {
            background-color: #fef08a;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side: Dark Navy with Playful Shapes & Mascot (Matching Image 4) -->
        <div class="login-left">
            <!-- Floating Geometric Circles matching Screenshot 4 -->
            <div class="circle-deco-green-top"></div>
            <div class="circle-deco-yellow-mid"></div>
            <div class="circle-deco-pink-bottom-left"></div>
            <div class="circle-deco-pink-mid-right"></div>
            <div class="circle-deco-green-bottom"></div>
            
            <!-- Cute Smiley Face at bottom right -->
            <div class="smiley-deco-bottom">
                <x-smiley-icon size="130" />
            </div>

            <!-- School Brand -->
            <div class="login-brand">
                SMK Negeri 1 Surabaya
            </div>

            <!-- Big Catchy Text -->
            <div class="login-hero-text">
                <h1>Yuk, lihat info sekolah terbaru!</h1>
                <p>Pengumuman, kegiatan, dan jadwal seru semuanya ada di sini.</p>
            </div>

            <div style="z-index: 2; font-size: 0.85rem; color: rgba(255,255,255,0.6);">
                &copy; {{ date('Y') }} SMK Negeri 1 Surabaya
            </div>
        </div>

        <!-- Right Side: White Login Form (Matching Image 4) -->
        <div class="login-right">
            <div class="login-form-box">
                <h2 class="login-form-title">Halo, Selamat Datang</h2>
                <p class="login-form-subtitle">Gunakan akun yang diberikan sekolah untuk masuk</p>

                <!-- Alert error -->
                @if($errors->any())
                    <div style="background-color: #fef2f2; border: 2px solid #ef4444; color: #991b1b; border-radius: 12px; padding: 12px 16px; margin-bottom: 24px; font-size: 0.9rem; font-weight: 600;">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('info'))
                    <div style="background-color: #eff6ff; border: 2px solid #3b82f6; color: #1e40af; border-radius: 12px; padding: 12px 16px; margin-bottom: 24px; font-size: 0.9rem; font-weight: 600;">
                        {{ session('info') }}
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" 
                               id="username" 
                               name="username" 
                               value="{{ old('username') }}" 
                               class="form-input {{ $errors->has('username') ? 'form-input-error' : '' }}" 
                               placeholder="" 
                               required 
                               autofocus>
                    </div>

                    <div class="form-group" style="margin-bottom: 28px;">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input {{ $errors->has('password') ? 'form-input-error' : '' }}" 
                               placeholder="" 
                               required>
                    </div>

                    <button type="submit" class="login-btn-submit">
                        Yuk, Masuk
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script>
        function fillCredentials(user, pass) {
            document.getElementById('username').value = user;
            document.getElementById('password').value = pass;
        }
    </script>
</body>
</html>
