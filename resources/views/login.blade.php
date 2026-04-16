    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login — Portal Kesiswaan</title>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            body {
                font-family: 'DM Sans', sans-serif;
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
                padding: 3rem;
                position: relative;
                overflow: hidden;
            }
            .left-panel::before {
                content: '';
                position: absolute;
                top: -80px; right: -80px;
                width: 320px; height: 320px;
                border-radius: 50%;
                background: #0C447C;
                opacity: .5;
            }
            .left-panel::after {
                content: '';
                position: absolute;
                bottom: -60px; left: -60px;
                width: 260px; height: 260px;
                border-radius: 50%;
                background: #0C447C;
                opacity: .4;
            }

            .brand { position: relative; z-index: 1; }
            .brand-logo {
                width: 48px; height: 48px;
                background: #1D9E75;
                border-radius: 14px;
                display: flex; align-items: center; justify-content: center;
                margin-bottom: 1.5rem;
            }
            .brand-logo svg { width: 26px; height: 26px; fill: #fff; }
            .brand-name {
                font-family: 'DM Serif Display', serif;
                font-size: 1.4rem;
                color: #fff;
            }
            .brand-sub {
                font-size: .78rem;
                color: #85B7EB;
                margin-top: .2rem;
                letter-spacing: .06em;
                text-transform: uppercase;
            }

            .left-content { position: relative; z-index: 1; }
            .left-content h2 {
                font-family: 'DM Serif Display', serif;
                font-size: 2.2rem;
                color: #fff;
                line-height: 1.25;
                margin-bottom: 1rem;
            }
            .left-content p {
                font-size: .92rem;
                color: #B5D4F4;
                line-height: 1.75;
                max-width: 340px;
            }
            .feature-list { margin-top: 2rem; display: flex; flex-direction: column; gap: .7rem; }
            .feature-item { display: flex; align-items: center; gap: .75rem; font-size: .87rem; color: #B5D4F4; }
            .feature-dot { width: 7px; height: 7px; border-radius: 50%; background: #1D9E75; flex-shrink: 0; }

            .left-footer { position: relative; z-index: 1; font-size: .76rem; color: #85B7EB; }

            /* ── RIGHT PANEL ── */
            .right-panel {
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                background: #fff;
            }

            .form-box {
                width: 100%;
                max-width: 400px;
                animation: fadeUp .45s cubic-bezier(.16,1,.3,1) both;
            }
            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(20px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            .form-header { margin-bottom: 2.5rem; }
            .form-header h1 {
                font-family: 'DM Serif Display', serif;
                font-size: 2rem;
                color: #042C53;
                letter-spacing: -.01em;
            }
            .form-header p { color: #5F5E5A; font-size: .9rem; margin-top: .4rem; }

            /* Alert */
            .alert {
                border-radius: 8px;
                padding: .75rem 1rem;
                font-size: .85rem;
                font-weight: 500;
                margin-bottom: 1.5rem;
                display: flex;
                align-items: flex-start;
                gap: .6rem;
                border-left: 3px solid;
            }
            .alert-error  { background: #FCEBEB; color: #A32D2D; border-color: #A32D2D; }
            .alert-success{ background: #EAF3DE; color: #3B6D11; border-color: #3B6D11; }
            .alert svg { flex-shrink: 0; margin-top: 1px; }

            /* Form */
            .form-group { margin-bottom: 1.25rem; }
            label {
                display: block;
                font-size: .82rem;
                font-weight: 600;
                color: #444441;
                margin-bottom: .5rem;
                letter-spacing: .01em;
            }
            .input-wrap { position: relative; }
            .input-icon {
                position: absolute;
                left: .9rem; top: 50%;
                transform: translateY(-50%);
                color: #888780;
                pointer-events: none;
                display: flex;
            }
            input[type="email"],
            input[type="password"],
            input[type="text"] {
                width: 100%;
                padding: .78rem 1rem .78rem 2.6rem;
                border: 1.5px solid #D3D1C7;
                border-radius: 10px;
                font-size: .92rem;
                font-family: 'DM Sans', sans-serif;
                color: #042C53;
                background: #F1EFE8;
                transition: border-color .2s, background .2s, box-shadow .2s;
                outline: none;
            }
            input:focus {
                border-color: #378ADD;
                background: #fff;
                box-shadow: 0 0 0 3px #E6F1FB;
            }
            input.is-invalid { border-color: #A32D2D; background: #FCEBEB; }
            input.is-invalid:focus { box-shadow: 0 0 0 3px #F7C1C1; }

            .invalid-msg {
                font-size: .78rem;
                color: #A32D2D;
                margin-top: .35rem;
                display: flex;
                align-items: center;
                gap: .3rem;
            }

            .toggle-pw {
                position: absolute;
                right: .85rem; top: 50%;
                transform: translateY(-50%);
                background: none; border: none;
                color: #888780;
                cursor: pointer;
                display: flex;
                padding: 0;
                transition: color .2s;
            }
            .toggle-pw:hover { color: #185FA5; }

            .row-between {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 1.75rem;
            }
            .check-label {
                display: flex;
                align-items: center;
                gap: .5rem;
                font-size: .84rem;
                color: #5F5E5A;
                cursor: pointer;
            }
            .check-label input[type="checkbox"] {
                width: 16px; height: 16px;
                accent-color: #185FA5;
                padding: 0;
                cursor: pointer;
            }

            .btn-submit {
                width: 100%;
                padding: .85rem;
                background: #042C53;
                color: #fff;
                font-size: .95rem;
                font-weight: 600;
                font-family: 'DM Sans', sans-serif;
                letter-spacing: .01em;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: .5rem;
                transition: background .2s, transform .15s;
            }
            .btn-submit:hover  { background: #0C447C; transform: translateY(-1px); }
            .btn-submit:active { transform: translateY(0); }
            .btn-submit:disabled { opacity: .6; cursor: not-allowed; transform: none; }

            .spinner {
                display: none;
                width: 17px; height: 17px;
                border: 2px solid rgba(255,255,255,.35);
                border-top-color: #fff;
                border-radius: 50%;
                animation: spin .65s linear infinite;
            }
            @keyframes spin { to { transform: rotate(360deg); } }

            .divider {
                display: flex;
                align-items: center;
                gap: .75rem;
                margin: 1.5rem 0;
                color: #B4B2A9;
                font-size: .8rem;
            }
            .divider::before, .divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: #D3D1C7;
            }

            .back-home {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: .4rem;
                font-size: .84rem;
                color: #5F5E5A;
                text-decoration: none;
                transition: color .2s;
            }
            .back-home:hover { color: #185FA5; }
            .back-home svg { width: 15px; height: 15px; }

            @media (max-width: 768px) {
                body { grid-template-columns: 1fr; }
                .left-panel { display: none; }
                .right-panel { padding: 2rem 1.5rem; }
            }
        </style>
    </head>
    <body>

    {{-- LEFT PANEL --}}
    <div class="left-panel">
        <div class="brand">
            <div class="brand-logo">
                <svg viewBox="0 0 24 24"><path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/></svg>
            </div>
            <div class="brand-name">Portal Kesiswaan</div>
            <div class="brand-sub">Sistem Manajemen Sekolah</div>
        </div>

        <div class="left-content">
            <h2>Kelola Data Siswa dengan Mudah</h2>
            <p>Platform terpadu untuk staf kesiswaan dalam mengelola data, kegiatan, dan laporan siswa secara efisien.</p>
            <div class="feature-list">
                <div class="feature-item"><div class="feature-dot"></div>Manajemen data siswa terpusat</div>
                <div class="feature-item"><div class="feature-dot"></div>Laporan kegiatan & prestasi</div>
                <div class="feature-item"><div class="feature-dot"></div>Monitoring ekstrakulikuler</div>
                <div class="feature-item"><div class="feature-dot"></div>Akses aman & terproteksi</div>
            </div>
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

            @if ($errors->any())
            <div class="alert alert-error">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            @endif

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
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="nama@sekolah.sch.id" autocomplete="email"
                            class="{{ $errors->has('email') ? 'is-invalid' : '' }}" required autofocus>
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
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                            autocomplete="current-password"
                            class="{{ $errors->has('password') ? 'is-invalid' : '' }}" required>
                        <button type="button" class="toggle-pw" onclick="togglePw()" title="Tampilkan password">
                            <svg id="eyeIcon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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

                <div class="row-between">
                    <label class="check-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Ingat saya
                    </label>
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
