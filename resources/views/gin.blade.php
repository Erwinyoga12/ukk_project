<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Eskul</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
        }

        /* ── Sisi kiri (gambar) ── */
        .left {
            width: 50%;
            background: url('image/prmuka.jpg') center / cover no-repeat;
            position: relative;
            overflow: hidden;
        }

        .left::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .25);
        }

        /* ── Sisi kanan (form) ── */
        .right {
            width: 50%;
            background: #fff;
            padding: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .brand {
            font-size: 28px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 13px;
            color: #999;
            margin-bottom: 40px;
            font-weight: 400;
        }

        /* ── Form group ── */
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #888;
            margin-bottom: 8px;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            border: none;
            border-bottom: 1.5px solid #e0e0e0;
            padding: 10px 0;
            font-size: 15px;
            color: #1a1a1a;
            outline: none;
            background: transparent;
            transition: border-color .25s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-bottom-color: #f4b41a;
        }

        /* Input merah saat error */
        input.input-error {
            border-bottom-color: #e24b4a !important;
        }

        /* ── Alert error ── */
        .alert-error {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: #FCEBEB;
            border: 0.5px solid #F09595;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 24px;
            animation: slideDown .25s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .alert-icon {
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-title {
            font-size: 13px;
            font-weight: 600;
            color: #791F1F;
            margin-bottom: 3px;
        }

        .alert-body {
            font-size: 12px;
            color: #A32D2D;
            line-height: 1.6;
        }

        /* ── Tombol login ── */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 160px;
            padding: 13px 0;
            background: #f4b41a;
            border: none;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: .02em;
            transition: background .2s, transform .1s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(244, 180, 26, .35);
            margin-top: 8px;
        }

        .btn:hover {
            background: #dca30f;
            box-shadow: 0 6px 18px rgba(244, 180, 26, .45);
        }

        .btn:active {
            transform: scale(.97);
        }

        /* ── Responsif ── */
        @media (max-width: 768px) {
            .left { display: none; }
            .right { width: 100%; padding: 40px 28px; }
        }
    </style>
</head>
<body>

<div class="left"></div>

<div class="right">
    <div class="brand">Sistem Penilaian Eskul</div>
    <div class="brand-sub">Masuk untuk melanjutkan</div>

    <form action="{{ route('login.process') }}" method="POST" id="loginForm">
        @csrf

        <div class="form-group">
            <label for="username">Username</label>
            <input
                type="text"
                name="username"
                id="username"
                placeholder="Masukkan Eskul"
                required
                autocomplete="off"
                value="{{ old('username') }}"
                class="{{ session('pesan') || $errors->any() ? 'input-error' : '' }}"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                placeholder="••••••"
                required
                class="{{ session('pesan') || $errors->any() ? 'input-error' : '' }}"
            >
        </div>

        {{-- Notifikasi error profesional --}}
        @if(session('pesan') || $errors->any())
            @php $msg = session('pesan') ?? $errors->first(); @endphp
            <div class="alert-error" role="alert">
                <svg class="alert-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="9" cy="9" r="8.25" stroke="#A32D2D" stroke-width="1.25"/>
                    <rect x="8.1875" y="4.5" width="1.625" height="5.5" rx="0.8125" fill="#A32D2D"/>
                    <circle cx="9" cy="13" r="0.875" fill="#A32D2D"/>
                </svg>
                <div>
                    <div class="alert-title">Login gagal</div>
                    <div class="alert-body">{{ $msg }}</div>
                </div>
            </div>
        @endif

        <button type="submit" class="btn">
            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.5 3H3C2.44772 3 2 3.44772 2 4V11C2 11.5523 2.44772 12 3 12H5.5M10 10L13 7.5M13 7.5L10 5M13 7.5H5.5" stroke="white" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Masuk
        </button>
    </form>
</div>

</body>
</html>