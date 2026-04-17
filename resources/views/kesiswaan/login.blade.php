<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Portal Kesiswaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background: #042C53;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .blob1 { position: absolute; top: -90px; right: -90px; width: 280px; height: 280px; border-radius: 50%; background: #0C447C; opacity: .45; }
        .blob2 { position: absolute; bottom: -70px; left: -70px; width: 240px; height: 240px; border-radius: 50%; background: #0C447C; opacity: .35; }
        .blob3 { position: absolute; top: 50%; right: 30px; width: 90px; height: 90px; border-radius: 50%; background: #1D9E75; opacity: .12; transform: translateY(-50%); }

        .brand { position: relative; z-index: 2; display: flex; align-items: center; gap: 12px; }
        .brand-logo {
            width: 42px; height: 42px; background: #1D9E75;
            border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .brand-logo svg { width: 22px; height: 22px; fill: #fff; }
        .brand-name { color: #fff; font-size: 14px; font-weight: 600; line-height: 1.2; }
        .brand-sub { color: #85B7EB; font-size: 11px; margin-top: 2px; letter-spacing: .05em; text-transform: uppercase; }

        .left-hero { position: relative; z-index: 2; }
        .left-hero h2 { font-family: 'DM Serif Display', serif; font-size: 1.9rem; color: #fff; line-height: 1.25; }

        .left-footer { position: relative; z-index: 2; font-size: .72rem; color: #378ADD; }

        /* ── RIGHT PANEL ── */
        .right-panel {
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
        }

        .form-box { width: 100%; max-width: 340px; }

        .form-header { margin-bottom: 2rem; text-align: center; }
        .form-header h1 { font-family: 'DM Serif Display', serif; font-size: 1.9rem; color: #042C53; letter-spacing: -.01em; }
        .form-header p { color: #5F5E5A; font-size: .85rem; margin-top: .3rem; }

        /* Alert */
        .alert {
            border-radius: 8px; padding: .75rem 1rem;
            font-size: .85rem; font-weight: 500;
            margin-bottom: 1.5rem;
            display: flex; align-items: flex-start; gap: .6rem;
            border-left: 3px solid;
        }
        .alert-error   { background: #FCEBEB; color: #A32D2D; border-color: #A32D2D; }
        .alert-success { background: #EAF3DE; color: #3B6D11; border-color: #3B6D11; }
        .alert svg { flex-shrink: 0; margin-top: 1px; }

        /* Form groups */
        .form-group { margin-bottom: 1.15rem; }
        label {
            display: block; font-size: .75rem; font-weight: 600;
            color: #5F5E5A; margin-bottom: .45rem;
            letter-spacing: .05em; text-transform: uppercase;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: .8rem; top: 50%;
            transform: translateY(-50%);
            color: #888780; pointer-events: none; display: flex;
        }
        .input-icon svg { width: 15px; height: 15px; }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: .72rem 2.6rem .72rem 2.5rem;
            border: 1.5px solid #D3D1C7;
            border-radius: 10px;
            font-size: .88rem;
            font-family: 'Inter', sans-serif;
            color: #042C53;
            background: #F1EFE8;
            transition: border-color .15s, background .15s, box-shadow .15s;
            outline: none;
            text-align: center;
        }
        input:focus { border-color: #378ADD; background: #fff; box-shadow: 0 0 0 3px rgba(55,138,221,.12); }
        input.is-invalid { border-color: #A32D2D; background: #FCEBEB; }
        input.is-invalid:focus { box-shadow: 0 0 0 3px #F7C1C1; }
        input::placeholder { text-align: center; }

        .invalid-msg { font-size: .78rem; color: #A32D2D; margin-top: .35rem; display: flex; align-items: center; gap: .3rem; }

        .toggle-pw {
            position: absolute; right: .75rem; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: #888780; cursor: pointer;
            display: flex; padding: 2px; border-radius: 4px;
        }
        .toggle-pw:hover { color: #042C53; }
        .toggle-pw svg { width: 15px; height: 15px; }

        /* Submit button */
        .btn-submit {
            width: 100%; padding: .8rem; margin-top: .4rem;
            background: #1D9E75; color: #fff;
            border: none; border-radius: 10px;
            font-size: .9rem; font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background .2s, transform .1s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-submit:hover:not(:disabled) { background: #0F6E56; }
        .btn-submit:active:not(:disabled) { transform: scale(.98); }
        .btn-submit:disabled { opacity: .65; cursor: not-allowed; }

        .spinner {
            width: 15px; height: 15px;
            border: 2px solid rgba(255,255,255,.35);
            border-top-color: #fff; border-radius: 50%;
            animation: spin .6s linear infinite;
            display: none;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        .divider {
            display: flex; align-items: center; gap: 10px;
            font-size: .78rem; color: #A0A09C;
            margin: 1.3rem 0;
        }
        .divider::before, .divider::after { content: ''; flex: 1; height: 0.5px; background: #D3D1C7; }

        .back-home {
            display: flex; align-items: center; justify-content: center; gap: .4rem;
            font-size: .82rem; color: #5F5E5A;
            text-decoration: none; background: none; border: none; width: 100%;
            font-family: 'Inter', sans-serif;
            cursor: pointer; transition: color .2s; padding: 0;
        }
        .back-home:hover { color: #185FA5; }
        .back-home svg { width: 14px; height: 14px; }

        @media (max-width: 600px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
            .right-panel { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

{{-- LEFT PANEL --}}
<div class="left-panel">
    <div class="blob1"></div>
    <div class="blob2"></div>
    <div class="blob3"></div>

    <div class="brand">
        <div class="brand-logo">
            <svg viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
        </div>
        <div>
            <div class="brand-name">Portal Kesiswaan</div>
            <div class="brand-sub">Sistem Manajemen Sekolah</div>
        </div>
    </div>

    <div class="left-hero">
        <h2></h2>
    </div>

    <div class="left-footer">&copy; {{ date('Y') }} Portal Kesiswaan. All rights reserved.</div>
</div>

{{-- RIGHT PANEL --}}
<div class="right-panel">
    <div class="form-box">

        <div class="form-header">
            <h1>Selamat datang</h1>
            <p>Masuk ke akun kesiswaan Anda</p>
        </div>

        {{-- Error dari validasi --}}
        @if ($errors->any())
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        {{-- Flash success --}}
        @if (session('success'))
        <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        {{-- Flash error --}}
        @if (session('error'))
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('kesiswaan.login.process') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </span>
                    <input type="email" id="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@sekolah.sch.id"
                        autocomplete="email"
                        class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                        required autofocus>
                </div>
                @error('email')
                <div class="invalid-msg">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </span>
                    <input type="password" id="password" name="password"
                        placeholder="••••••••"
                        autocomplete="current-password"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                        required>
                    <button type="button" class="toggle-pw" onclick="togglePw()" title="Tampilkan password">
                        <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password')
                <div class="invalid-msg">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn-submit" id="btnLogin">
                <span id="btnText">Masuk</span>
                <div class="spinner" id="spinner"></div>
            </button>
        </form>

        <div class="divider">atau</div>

        <a href="{{ url('/') }}" class="back-home">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Beranda
        </a>

    </div>
</div>

<script>
    function togglePw() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        const show  = input.type === 'password';
        input.type  = show ? 'text' : 'password';
        icon.innerHTML = show
            ? `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`
            : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    }

    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn     = document.getElementById('btnLogin');
        const text    = document.getElementById('btnText');
        const spinner = document.getElementById('spinner');
        btn.disabled          = true;
        text.textContent      = 'Memproses...';
        spinner.style.display = 'block';
    });
</script>
</body>
</html>