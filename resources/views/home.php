<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Eskul Professional</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #00c2a8;
            --primary-dark: #00a99d;
            --accent: #00e6c3;
            --text-dark: #1f2933;
            --text-muted: #6b7280;
            --bg-soft: #f5f7fa;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-soft);
            color: var(--text-dark);
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: transparent;
            position: absolute;
            width: 100%;
            z-index: 10;
        }

        .navbar .nav-link {
            color: #fff;
            font-weight: 500;
        }

        .navbar .nav-link:hover { color: var(--accent); }

        /* Dropdown login di navbar */
        .login-dropdown .dropdown-toggle {
            background: var(--primary);
            color: #fff;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            transition: .3s;
            cursor: pointer;
        }

        .login-dropdown .dropdown-toggle:hover { background: var(--accent); }
        .login-dropdown .dropdown-toggle::after { margin-left: 6px; }

        .login-dropdown .dropdown-menu {
            border: none;
            border-radius: 14px;
            box-shadow: 0 16px 40px rgba(0,0,0,.15);
            padding: 8px;
            min-width: 220px;
            margin-top: 8px !important;
        }

        .login-dropdown .dropdown-item {
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: background .2s;
        }

        .login-dropdown .dropdown-item .di-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .login-dropdown .dropdown-item .di-text small {
            display: block;
            font-size: 11px;
            font-weight: 400;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .login-dropdown .dropdown-item:hover { background: #f0fdf9; }

        /* ================= HERO ================= */
        .hero {
            min-height: 100vh;
            background: url("image/pramuka garuda.jpg") center/cover no-repeat;
            position: relative;
            color: #fff;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(4,30,35,.88), rgba(4,30,35,.65));
        }

        .hero .container { position: relative; }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .hero p {
            color: #d0f5ee;
            max-width: 600px;
            margin: 12px auto 32px;
        }

        /* ====== 2 TOMBOL LOGIN HERO ====== */
        .hero-login-group {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .btn-hero-login {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 28px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: all .3s ease;
            border: 2px solid transparent;
        }

        /* Tombol Pembina — solid teal */
        .btn-pembina {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .btn-pembina:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(0,194,168,.35);
        }

        /* Tombol Kesiswaan — outline putih */
        .btn-kesiswaan {
            background: rgba(255,255,255,.12);
            color: #fff;
            border-color: rgba(255,255,255,.5);
            backdrop-filter: blur(6px);
        }

        .btn-kesiswaan:hover {
            background: rgba(255,255,255,.22);
            border-color: #fff;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-hero-login .btn-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .btn-pembina .btn-icon { background: rgba(255,255,255,.2); }
        .btn-kesiswaan .btn-icon { background: rgba(255,255,255,.15); }

        .btn-hero-login .btn-text { text-align: left; }
        .btn-hero-login .btn-text small {
            display: block;
            font-size: 11px;
            font-weight: 400;
            opacity: .8;
            margin-top: 2px;
        }

        .hero-scroll-link {
            color: #d0f5ee;
            text-decoration: none;
            font-size: 14px;
        }

        /* ====== LABEL PEMISAH ====== */
        .hero-or {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .hero-or span {
            color: rgba(255,255,255,.4);
            font-size: 13px;
        }

        .hero-or::before,
        .hero-or::after {
            content: '';
            width: 60px;
            height: 1px;
            background: rgba(255,255,255,.2);
        }

        /* ====== SECTION AKSES CEPAT ====== */
        .section-akses {
            padding: 80px 0 60px;
        }

        .akses-card {
            background: #fff;
            border-radius: 20px;
            border: 1.5px solid #e9ecef;
            padding: 36px 32px;
            text-align: center;
            transition: all .3s ease;
            height: 100%;
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .akses-card:hover {
            border-color: var(--primary);
            box-shadow: 0 20px 50px rgba(0,194,168,.12);
            transform: translateY(-5px);
            color: inherit;
        }

        .akses-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
        }

        .akses-card h5 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .akses-card p {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
            line-height: 1.7;
        }

        .akses-fitur {
            list-style: none;
            padding: 0;
            margin: 0 0 24px;
            text-align: left;
        }

        .akses-fitur li {
            font-size: 13px;
            color: #555;
            padding: 6px 0;
            border-bottom: 1px solid #f5f5f5;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .akses-fitur li:last-child { border-bottom: none; }

        .akses-fitur li i {
            font-size: 11px;
            color: var(--primary);
        }

        .akses-btn {
            display: inline-block;
            padding: 11px 28px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all .25s;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .akses-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        /* ================= SECTION ESKUL ================= */
        .section { padding: 100px 0; }
        .section h2 { letter-spacing: -0.5px; }
        .section .text-muted { max-width: 700px; margin: 0 auto; }

        .demo-card {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,.15);
            transition: transform .3s ease, box-shadow .3s ease;
            background: #fff;
        }

        .demo-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px rgba(0,0,0,.18);
        }

        .demo-card img {
            width: 100%;
            height: 420px;
            object-fit: cover;
        }

        .label {
            background: var(--primary-dark);
            color: #fff;
            text-align: center;
            padding: 14px;
            font-weight: 600;
            letter-spacing: .3px;
        }

        /* ================= PEMBINA ================= */
        .section-pembina { padding: 100px 0; background: #fff; }

        .pembina-card {
            background: #fff;
            border: 1px solid #eef0f3;
            border-radius: 20px;
            padding: 32px 24px 28px;
            text-align: center;
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
            height: 100%;
        }

        .pembina-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,.09);
            border-color: var(--primary);
        }

        .pembina-avatar {
            width: 72px; height: 72px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; font-weight: 700;
            margin: 0 auto 16px;
        }

        .eskul-badge {
            display: inline-block;
            font-size: 11px; font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
            text-transform: uppercase;
        }

        .pembina-name { font-size: 16px; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .pembina-jabatan { font-size: 13px; color: var(--primary-dark); font-weight: 600; margin-bottom: 4px; }
        .pembina-divider { border: none; border-top: 1px solid #f0f2f5; margin-bottom: 16px; }

        .pembina-info-row {
            display: flex; align-items: flex-start; gap: 10px;
            text-align: left; margin-bottom: 10px; font-size: 13px; color: #555;
        }
        .pembina-info-row:last-child { margin-bottom: 0; }

        .pembina-info-icon {
            width: 28px; height: 28px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 12px;
        }

        .info-label { font-size: 11px; color: #aaa; display: block; line-height: 1.2; }
        .info-value { font-size: 13px; color: var(--text-dark); display: block; font-weight: 500; line-height: 1.4; word-break: break-word; }

        /* ================= FOOTER ================= */
        .footer { background: #fbf8f3; padding: 80px 0 0; border-top: 1px solid #eee; }
        .footer h6 { font-weight: 600; margin-bottom: 18px; letter-spacing: .3px; }
        .footer ul { list-style: none; padding: 0; }
        .footer ul li { margin-bottom: 10px; }
        .footer ul li a { text-decoration: none; color: #666; font-size: 14px; }
        .footer ul li a:hover { color: #000; }

        .social-icons a {
            width: 36px; height: 36px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            color: #fff; margin-right: 8px; text-decoration: none;
        }

        .whatsapp { background: #25d366; }
        .instagram {
            background: radial-gradient(circle at 30% 107%,
                #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        }

        .footer-bottom {
            border-top: 1px solid #e5e1da; margin-top: 60px;
            padding: 20px 0; font-size: 14px; color: #777;
        }

        .footer-bottom a { color: #777; margin-left: 20px; text-decoration: none; }
        .footer-bottom a:hover { color: #000; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.2rem; }
            .demo-card img { height: 300px; }
            .btn-hero-login { width: 100%; justify-content: center; }
            .hero-login-group { flex-direction: column; align-items: center; }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="/">Eskul Professional</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="#eskul">Kegiatan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pembina">Pembina</a></li>

                    <!-- Dropdown Login -->
                    <li class="nav-item dropdown login-dropdown">
                        <button class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="/gin?role=pembina">
                                    <div class="di-icon" style="background:#E6F1FB;color:#185FA5;">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="di-text">
                                        Login Pembina
                                        <small>Input nilai eskul</small>
                                    </div>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider mx-2 my-1"></li>
                            <li>
                                <a class="dropdown-item" href="/kesiswaan/login">
                                    <div class="di-icon" style="background:#E1F5EE;color:#0F6E56;">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <div class="di-text">
                                        Login Kesiswaan
                                        <small>Rekap & laporan semua eskul</small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Penilaian Ekstrakurikuler</h1>
            <p>Platform profesional untuk mengelola kegiatan dan penilaian ekstrakurikuler siswa.</p>
        </div>
    </section>

    <!-- ESKUL -->
    <section class="section" id="eskul" style="background:#fff;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Kegiatan Ekstrakurikuler</h2>
                <p class="text-muted mt-2">
                    Berbagai pilihan kegiatan ekstrakurikuler untuk mengembangkan bakat,
                    minat, dan karakter siswa secara terarah dan profesional.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="demo-card">
                        <img src="image/kib.jpg" alt="Paskibra">
                        <div class="label">ESKUL PASKIBRA</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="demo-card">
                        <img src="image/prmuka.jpg" alt="Pramuka">
                        <div class="label">ESKUL PRAMUKA</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="demo-card">
                        <img src="image/pmr.jpg" alt="PMR">
                        <div class="label">ESKUL PMR</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="demo-card">
                        <img src="image/drm.jpg" alt="Drumband">
                        <div class="label">ESKUL DRUMBAND</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="demo-card">
                        <img src="image/nat.jpg" alt="Natbinari">
                        <div class="label">ESKUL NATBINARI</div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="demo-card">
                        <img src="image/jrnl.jpg" alt="Jurnalistik">
                        <div class="label">ESKUL JURNALISTIK</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PEMBINA -->
    <section class="section-pembina" id="pembina">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Pembina Ekstrakurikuler</h2>
                <p class="text-muted mt-2">
                    Tenaga pembina berpengalaman yang mendampingi setiap kegiatan
                    ekstrakurikuler siswa secara profesional dan bertanggung jawab.
                </p>
            </div>

            <div class="row g-4">

                <!-- PEMBINA 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#E1F5EE;color:#0F6E56;">KA</div>
                        <span class="eskul-badge" style="background:#E1F5EE;color:#0F6E56;">PASKIBRA</span>
                        <p class="pembina-name">Kang Acang</p>
                        <p class="pembina-jabatan">Pembina Paskibra</p>
                        <hr class="pembina-divider">
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;"><i class="fab fa-whatsapp" style="color:#25d366;"></i></div>
                            <div><span class="info-label">WhatsApp / HP</span><span class="info-value">0812-3456-7890</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;"><i class="fas fa-envelope" style="color:#378ADD;"></i></div>
                            <div><span class="info-label">Email</span><span class="info-value">acang@gmail.com</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;"><i class="fas fa-map-marker-alt" style="color:#E8593C;"></i></div>
                            <div><span class="info-label">Alamat</span><span class="info-value">Jl. Lumpang No. 12, Kec. Parung Panjang</span></div>
                        </div>
                    </div>
                </div>

                <!-- PEMBINA 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#E6F1FB;color:#185FA5;">H</div>
                        <span class="eskul-badge" style="background:#E6F1FB;color:#185FA5;">PRAMUKA</span>
                        <p class="pembina-name">Haerudin</p>
                        <p class="pembina-jabatan">Pembina Pramuka</p>
                        <hr class="pembina-divider">
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;"><i class="fab fa-whatsapp" style="color:#25d366;"></i></div>
                            <div><span class="info-label">WhatsApp / HP</span><span class="info-value">0821-9876-5432</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;"><i class="fas fa-envelope" style="color:#378ADD;"></i></div>
                            <div><span class="info-label">Email</span><span class="info-value">haerudin@gmail.com</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;"><i class="fas fa-map-marker-alt" style="color:#E8593C;"></i></div>
                            <div><span class="info-label">Alamat</span><span class="info-value">Jl. Kebasiran No. 45, Kec. Parung Panjang</span></div>
                        </div>
                    </div>
                </div>

                <!-- PEMBINA 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#FAECE7;color:#993C1D;">CM</div>
                        <span class="eskul-badge" style="background:#FAECE7;color:#993C1D;">PMR</span>
                        <p class="pembina-name">Ade Cucu Mulyana</p>
                        <p class="pembina-jabatan">Pembina PMR</p>
                        <hr class="pembina-divider">
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;"><i class="fab fa-whatsapp" style="color:#25d366;"></i></div>
                            <div><span class="info-label">WhatsApp / HP</span><span class="info-value">0857-1122-3344</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;"><i class="fas fa-envelope" style="color:#378ADD;"></i></div>
                            <div><span class="info-label">Email</span><span class="info-value">adecucumulyana@gmail.com</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;"><i class="fas fa-map-marker-alt" style="color:#E8593C;"></i></div>
                            <div><span class="info-label">Alamat</span><span class="info-value">Griya Parung Panjang Blok A No. 8</span></div>
                        </div>
                    </div>
                </div>

                <!-- PEMBINA 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#EEEDFE;color:#534AB7;">RN</div>
                        <span class="eskul-badge" style="background:#EEEDFE;color:#534AB7;">DRUMBAND</span>
                        <p class="pembina-name">Reza Nugraha</p>
                        <p class="pembina-jabatan">Pembina Drumband</p>
                        <hr class="pembina-divider">
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;"><i class="fab fa-whatsapp" style="color:#25d366;"></i></div>
                            <div><span class="info-label">WhatsApp / HP</span><span class="info-value">0813-5566-7788</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;"><i class="fas fa-envelope" style="color:#378ADD;"></i></div>
                            <div><span class="info-label">Email</span><span class="info-value">Reza@gmail.com</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;"><i class="fas fa-map-marker-alt" style="color:#E8593C;"></i></div>
                            <div><span class="info-label">Alamat</span><span class="info-value">Perum 2 Jl. Semangka No. 77, Kec. Parung Panjang</span></div>
                        </div>
                    </div>
                </div>

                <!-- PEMBINA 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#FAEEDA;color:#854F0B;">KD</div>
                        <span class="eskul-badge" style="background:#FAEEDA;color:#854F0B;">NATBINARI</span>
                        <p class="pembina-name">Kang Dono</p>
                        <p class="pembina-jabatan">Pembina Natbinari</p>
                        <hr class="pembina-divider">
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;"><i class="fab fa-whatsapp" style="color:#25d366;"></i></div>
                            <div><span class="info-label">WhatsApp / HP</span><span class="info-value">0878-4455-6677</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;"><i class="fas fa-envelope" style="color:#378ADD;"></i></div>
                            <div><span class="info-label">Email</span><span class="info-value">dono@gmail.com</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;"><i class="fas fa-map-marker-alt" style="color:#E8593C;"></i></div>
                            <div><span class="info-label">Alamat</span><span class="info-value">Griya Parung Panjang Blok L No. 33</span></div>
                        </div>
                    </div>
                </div>

                <!-- PEMBINA 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#FBEAF0;color:#993556;">K</div>
                        <span class="eskul-badge" style="background:#FBEAF0;color:#993556;">JURNALISTIK</span>
                        <p class="pembina-name">Komar S.Kom</p>
                        <p class="pembina-jabatan">Pembina Jurnalistik</p>
                        <hr class="pembina-divider">
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;"><i class="fab fa-whatsapp" style="color:#25d366;"></i></div>
                            <div><span class="info-label">WhatsApp / HP</span><span class="info-value">0895-2233-4455</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;"><i class="fas fa-envelope" style="color:#378ADD;"></i></div>
                            <div><span class="info-label">Email</span><span class="info-value">komar@gmail.com</span></div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;"><i class="fas fa-map-marker-alt" style="color:#E8593C;"></i></div>
                            <div><span class="info-label">Alamat</span><span class="info-value">Jl. Pemuda No. 19, Kec. Pulo Gadung, Jakarta Timur</span></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h6>Company</h6>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="#eskul">Kegiatan</a></li>
                        <li><a href="#pembina">Pembina</a></li>
                        <li><a href="/contak">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Account</h6>
                    <ul>
                        <li><a href="/gin?role=pembina">Login Pembina</a></li>
                        <li><a href="/gin?role=kesiswaan">Login Kesiswaan</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Follow Us</h6>
                    <div class="social-icons">
                        <a href="https://wa.me/6282124235878" target="_blank" class="whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://instagram.com/ataratahillah_" target="_blank" class="instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom d-flex justify-content-between flex-wrap gap-2">
                <span>© 2026 Eskul Professional</span>
                <div>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.demo-card').forEach(card => {
            card.addEventListener('mouseenter', () => card.classList.add('active'));
            card.addEventListener('mouseleave', () => card.classList.remove('active'));
        });
    </script>

</body>
</html>
