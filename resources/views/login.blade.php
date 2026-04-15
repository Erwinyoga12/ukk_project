<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kesiswaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:   #1e40af;
            --primary-dark: #1e3a8a;
            --accent:    #f59e0b;
            --accent-light: #fef3c7;
            --surface:   #ffffff;
            --bg:        #eff6ff;
            --text:      #1e293b;
            --muted:     #64748b;
            --border:    #cbd5e1;
            --error:     #ef4444;
            --success:   #22c55e;
            --shadow:    0 20px 60px rgba(30,64,175,.15);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            position: relative;
            overflow: hidden;
        }

        /* Dekoratif background */
        body::before {
            content: '';
            position: fixed;
            top: -120px; left: -120px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(30,64,175,.18) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -100px; right: -100px;
            width: 420px; height: 420px;
            background: radial-gradient(circle, rgba(245,158,11,.14) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .card {
            background: var(--surface);
            border-radius: 24px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 440px;
            padding: 2.5rem 2.5rem 2rem;
            animation: slideUp .5s cubic-bezier(.16,1,.3,1) both;
            position: relative;
            z-index: 1;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-wrap {
            width: 72px; height: 72px;
            background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.2rem;
            box-shadow: 0 8px 24px rgba(30,64,175,.3);
        }
        .logo-wrap svg { width: 36px; height: 36px; fill: white; }
        .badge {
            display: inline-block;
            background: var(--accent-light);
            color: #92400e;
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .25rem .75rem;
            border-radius: 999px;
            margin-bottom: .6rem;
        }
        .header h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text);
            line-height: 1.2;
        }
        .header p {
            color: var(--muted);
            font-size: .88rem;
            margin-top: .4rem;
        }

        /* Alert */
        .alert {
            border-radius: 10px;
            padding: .8rem 1rem;
            font-size: .85rem;
            font-weight: 500;
            margin-bottom: 1.4rem;
            display: flex;
            align-items: flex-start;
            gap: .6rem;
        }
        .alert-error   { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
        .alert-success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .alert svg { flex-shrink: 0; margin-top: 1px; }

        /* Form */
        .form-group { margin-bottom: 1.2rem; }
        label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: .45rem;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap .icon {
            position: absolute;
            left: .95rem; top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            pointer-events: none;
            display: flex;
        }
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            padding: .75rem 1rem .75rem 2.75rem;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: .92rem;
            font-family: inherit;
            color: var(--text);
            background: #f8fafc;
            transition: border-color .2s, box-shadow .2s, background .2s;
            outline: none;
        }
        input:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 3px rgba(30,64,175,.12);
        }
        input.is-invalid {
            border-color: var(--error);
            background: #fff5f5;
        }
        .invalid-feedback {
            font-size: .78rem;
            color: var(--error);
            margin-top: .35rem;
            display: flex;
            align-items: center;
            gap: .3rem;
        }

        /* Toggle password */
        .toggle-pw {
            position: absolute;
            right: .9rem; top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--muted);
            background: none; border: none;
            padding: 0; display: flex;
            transition: color .2s;
        }
        .toggle-pw:hover { color: var(--primary); }

        /* Remember + forgot */
        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .remember {
            display: flex; align-items: center; gap: .45rem;
            font-size: .83rem; color: var(--muted); cursor: pointer;
        }
        .remember input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--primary);
            padding: 0; border-radius: 4px;
            cursor: pointer;
        }

        /* Submit button */
        .btn-login {
            width: 100%;
            padding: .85rem;
            background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
            color: white;
            font-size: .97rem;
            font-weight: 700;
            font-family: inherit;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: transform .15s, box-shadow .15s, opacity .15s;
            box-shadow: 0 6px 20px rgba(30,64,175,.3);
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .btn-login:hover  { transform: translateY(-1px); box-shadow: 0 10px 28px rgba(30,64,175,.38); }
        .btn-login:active { transform: translateY(0); opacity: .9; }
        .btn-login:disabled { opacity: .65; cursor: not-allowed; transform: none; }

        /* Spinner */
        .spinner {
            display: none;
            width: 18px; height: 18px;
            border: 2.5px solid rgba(255,255,255,.4);
            border-top-color: white;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Divider */
        .divider {
            text-align: center;
            margin: 1.4rem 0 .8rem;
            font-size: .78rem;
            color: var(--muted);
        }

        /* Info link */
        .back-link {
            display: block;
            text-align: center;
            font-size: .82rem;
            color: var(--muted);
            text-decoration: none;
            margin-top: 1rem;
            transition: color .2s;
        }
        .back-link:hover { color: var(--primary); }
        .back-link strong { color: var(--primary); }
    </style>
</head>
<body>

<div class="card">
    {{-- Header --}}
    <div class="header">
        <div class="logo-wrap">
            <!-- Icon: mortar board / graduation cap -->
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zM5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
            </svg>
        </div>
        <span class="badge">Portal Kesiswaan</span>
        <h1>Selamat Datang</h1>
        <p>Masuk ke sistem manajemen kesiswaan</p>
    </div>

    {{-- Alert Error --}}
    @if ($errors->any())
    <div class="alert alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <span>{{ $errors->first() }}</span>
    </div>
    @endif

    {{-- Alert Success --}}
    @if (session('success'))
    <div class="alert alert-success">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Alert Error Session --}}
    @if (session('error'))
    <div class="alert alert-error">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Form Login --}}
    <form method="POST" action="{{ route('kesiswaan.login.post') }}" id="loginForm">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </span>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@sekolah.sch.id"
                    autocomplete="email"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                    required
                >
            </div>
            @error('email')
            <div class="invalid-feedback">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-wrap">
                <span class="icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="current-password"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                    required
                >
                <button type="button" class="toggle-pw" onclick="togglePassword()" title="Tampilkan/sembunyikan password">
                    <svg id="eyeIcon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            @error('password')
            <div class="invalid-feedback">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="form-footer">
            <label class="remember">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
            </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login" id="btnLogin">
            <span id="btnText">Masuk</span>
            <div class="spinner" id="spinner"></div>
        </button>
    </form>

    <div class="divider">— atau —</div>
    <a href="{{ route('pembina.login') }}" class="back-link">
        Login sebagai <strong>Pembina</strong>
    </a>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
        }
    }

    // Loading state saat submit
    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn     = document.getElementById('btnLogin');
        const text    = document.getElementById('btnText');
        const spinner = document.getElementById('spinner');
        btn.disabled     = true;
        text.textContent = 'Memproses...';
        spinner.style.display = 'block';
    });
</script>
</body>
</html>