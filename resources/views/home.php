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

        .navbar .nav-link:hover {
            color: var(--accent);
        }

        .login-btn {
            background: var(--primary);
            color: #fff;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: .3s;
        }

        .login-btn:hover {
            background: var(--accent);
            color: #fff;
        }

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
            margin: 12px auto 24px;
        }

        .btn-main {
            background: var(--primary);
            color: #fff;
            padding: 14px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all .3s ease;
        }

        .btn-main:hover {
            background: var(--accent);
            transform: translateY(-2px);
            color: #fff;
        }

        /* ================= SECTION ================= */
        .section {
            padding: 100px 0;
        }

        .section h2 {
            letter-spacing: -0.5px;
        }

        .section .text-muted {
            max-width: 700px;
            margin: 0 auto;
        }

        /* ================= CARD ESKUL ================= */
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

        .overlay {
            position: absolute;
            inset: 0 0 52px 0;
            background: var(--primary-dark);
            transform: translateY(-100%);
            transition: .6s;
        }

        .demo-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, 20px);
            background: #fff;
            color: var(--primary-dark);
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            opacity: 0;
            transition: .4s;
        }

        .demo-card.active .overlay { transform: translateY(0); }
        .demo-card.active .demo-btn {
            opacity: 1;
            transform: translate(-50%, -50%);
        }

        /* ================= PEMBINA SECTION ================= */
        .section-pembina {
            padding: 100px 0;
            background: #fff;
        }

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
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            margin: 0 auto 16px;
        }

        .eskul-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 14px;
            text-transform: uppercase;
        }

        .pembina-name {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .pembina-jabatan {
            font-size: 13px;
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .pembina-nip {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .pembina-divider {
            border: none;
            border-top: 1px solid #f0f2f5;
            margin-bottom: 16px;
        }

        .pembina-info-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            text-align: left;
            margin-bottom: 10px;
            font-size: 13px;
            color: #555;
        }

        .pembina-info-row:last-child {
            margin-bottom: 0;
        }

        .pembina-info-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 12px;
        }

        .pembina-info-row .info-label {
            font-size: 11px;
            color: #aaa;
            display: block;
            line-height: 1.2;
        }

        .pembina-info-row .info-value {
            font-size: 13px;
            color: var(--text-dark);
            display: block;
            font-weight: 500;
            line-height: 1.4;
            word-break: break-word;
        }

        /* ================= FOOTER ================= */
        .footer {
            background: #fbf8f3;
            padding: 80px 0 0;
            border-top: 1px solid #eee;
        }

        .footer h6 {
            font-weight: 600;
            margin-bottom: 18px;
            letter-spacing: .3px;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 10px;
        }

        .footer ul li a {
            text-decoration: none;
            color: #666;
            font-size: 14px;
        }

        .footer ul li a:hover { color: #000; }

        .social-icons a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-right: 8px;
            text-decoration: none;
        }

        .whatsapp { background: #25d366; }
        .instagram {
            background: radial-gradient(circle at 30% 107%,
                #fdf497 0%, #fdf497 5%,
                #fd5949 45%, #d6249f 60%, #285AEB 90%);
        }

        .footer-bottom {
            border-top: 1px solid #e5e1da;
            margin-top: 60px;
            padding: 20px 0;
            font-size: 14px;
            color: #777;
        }

        .footer-bottom a {
            color: #777;
            margin-left: 20px;
            text-decoration: none;
        }

        .footer-bottom a:hover { color: #000; }

        @media (max-width: 768px) {
            .hero h1 { font-size: 2.2rem; }
            .demo-card img { height: 300px; }
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
                    <li class="nav-item"><a href="/gin" class="login-btn">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Penilaian Ekstrakurikuler</h1>
            <p>Platform profesional untuk mengelola kegiatan dan penilaian ekstrakurikuler siswa.</p>
            <div style="display:flex;flex-direction:column;align-items:center;gap:12px;">
                <a href="gin" class="btn-main">Input Nilai</a>
                <a href="#eskul" style="color:#d0f5ee;text-decoration:none;">Lihat Kegiatan</a>
            </div>
        </div>
    </section>

    <!-- ESKUL -->
    <section class="section" id="eskul">
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

    <!-- ===================================================
         SEKSI PEMBINA EKSTRAKURIKULER
         Ganti nama, NIP, HP, email, dan alamat sesuai data asli
    =================================================== -->
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

                <!-- ===== PEMBINA 1 — PASKIBRA ===== -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <!-- Avatar inisial -->
                        <div class="pembina-avatar" style="background:#E1F5EE;color:#0F6E56;">AR</div>
                        <!-- Badge eskul -->
                        <span class="eskul-badge" style="background:#E1F5EE;color:#0F6E56;">PASKIBRA</span>
                        <!-- Nama & jabatan -->
                        <p class="pembina-name">Ahmad Ridwan, S.Pd</p>
                        <p class="pembina-jabatan">Pembina Paskibra</p>
                        <p class="pembina-nip">NIP: 198503142010011002</p>

                        <hr class="pembina-divider">

                        <!-- No. HP / WA -->
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;">
                                <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                            </div>
                            <div>
                                <span class="info-label">WhatsApp / HP</span>
                                <span class="info-value">0812-3456-7890</span>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;">
                                <i class="fas fa-envelope" style="color:#378ADD;"></i>
                            </div>
                            <div>
                                <span class="info-label">Email</span>
                                <span class="info-value">a.ridwan@sekolah.sch.id</span>
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;">
                                <i class="fas fa-map-marker-alt" style="color:#E8593C;"></i>
                            </div>
                            <div>
                                <span class="info-label">Alamat</span>
                                <span class="info-value">Jl. Merdeka No. 12, Kec. Menteng, Jakarta Pusat</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== PEMBINA 2 — PRAMUKA ===== -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#E6F1FB;color:#185FA5;">SW</div>
                        <span class="eskul-badge" style="background:#E6F1FB;color:#185FA5;">PRAMUKA</span>
                        <p class="pembina-name">Siti Wahyuni, M.Pd</p>
                        <p class="pembina-jabatan">Pembina Pramuka</p>
                        <p class="pembina-nip">NIP: 197912052005012005</p>

                        <hr class="pembina-divider">

                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;">
                                <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                            </div>
                            <div>
                                <span class="info-label">WhatsApp / HP</span>
                                <span class="info-value">0821-9876-5432</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;">
                                <i class="fas fa-envelope" style="color:#378ADD;"></i>
                            </div>
                            <div>
                                <span class="info-label">Email</span>
                                <span class="info-value">s.wahyuni@sekolah.sch.id</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;">
                                <i class="fas fa-map-marker-alt" style="color:#E8593C;"></i>
                            </div>
                            <div>
                                <span class="info-label">Alamat</span>
                                <span class="info-value">Jl. Sudirman No. 45, Kec. Tanah Abang, Jakarta Pusat</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== PEMBINA 3 — PMR ===== -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#FAECE7;color:#993C1D;">DN</div>
                        <span class="eskul-badge" style="background:#FAECE7;color:#993C1D;">PMR</span>
                        <p class="pembina-name">Deni Nugroho, S.Kep</p>
                        <p class="pembina-jabatan">Pembina PMR</p>
                        <p class="pembina-nip">NIP: 199001102015031003</p>

                        <hr class="pembina-divider">

                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;">
                                <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                            </div>
                            <div>
                                <span class="info-label">WhatsApp / HP</span>
                                <span class="info-value">0857-1122-3344</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;">
                                <i class="fas fa-envelope" style="color:#378ADD;"></i>
                            </div>
                            <div>
                                <span class="info-label">Email</span>
                                <span class="info-value">d.nugroho@sekolah.sch.id</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;">
                                <i class="fas fa-map-marker-alt" style="color:#E8593C;"></i>
                            </div>
                            <div>
                                <span class="info-label">Alamat</span>
                                <span class="info-value">Jl. Kebon Jeruk No. 8, Kec. Palmerah, Jakarta Barat</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== PEMBINA 4 — DRUMBAND ===== -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#EEEDFE;color:#534AB7;">RL</div>
                        <span class="eskul-badge" style="background:#EEEDFE;color:#534AB7;">DRUMBAND</span>
                        <p class="pembina-name">Rina Lestari, S.Sn</p>
                        <p class="pembina-jabatan">Pembina Drumband</p>
                        <p class="pembina-nip">NIP: 198807232012012007</p>

                        <hr class="pembina-divider">

                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;">
                                <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                            </div>
                            <div>
                                <span class="info-label">WhatsApp / HP</span>
                                <span class="info-value">0813-5566-7788</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;">
                                <i class="fas fa-envelope" style="color:#378ADD;"></i>
                            </div>
                            <div>
                                <span class="info-label">Email</span>
                                <span class="info-value">r.lestari@sekolah.sch.id</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;">
                                <i class="fas fa-map-marker-alt" style="color:#E8593C;"></i>
                            </div>
                            <div>
                                <span class="info-label">Alamat</span>
                                <span class="info-value">Jl. Raya Bogor No. 77, Kec. Ciracas, Jakarta Timur</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== PEMBINA 5 — NATBINARI ===== -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#FAEEDA;color:#854F0B;">BH</div>
                        <span class="eskul-badge" style="background:#FAEEDA;color:#854F0B;">NATBINARI</span>
                        <p class="pembina-name">Budi Hartono, S.Kom</p>
                        <p class="pembina-jabatan">Pembina Natbinari</p>
                        <p class="pembina-nip">NIP: 198204172008011009</p>

                        <hr class="pembina-divider">

                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;">
                                <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                            </div>
                            <div>
                                <span class="info-label">WhatsApp / HP</span>
                                <span class="info-value">0878-4455-6677</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;">
                                <i class="fas fa-envelope" style="color:#378ADD;"></i>
                            </div>
                            <div>
                                <span class="info-label">Email</span>
                                <span class="info-value">b.hartono@sekolah.sch.id</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;">
                                <i class="fas fa-map-marker-alt" style="color:#E8593C;"></i>
                            </div>
                            <div>
                                <span class="info-label">Alamat</span>
                                <span class="info-value">Jl. Fatmawati No. 33, Kec. Cilandak, Jakarta Selatan</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== PEMBINA 6 — JURNALISTIK ===== -->
                <div class="col-lg-4 col-md-6">
                    <div class="pembina-card">
                        <div class="pembina-avatar" style="background:#FBEAF0;color:#993556;">FA</div>
                        <span class="eskul-badge" style="background:#FBEAF0;color:#993556;">JURNALISTIK</span>
                        <p class="pembina-name">Fitri Andriani, S.I.Kom</p>
                        <p class="pembina-jabatan">Pembina Jurnalistik</p>
                        <p class="pembina-nip">NIP: 199305282017012004</p>

                        <hr class="pembina-divider">

                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e6f9f1;">
                                <i class="fab fa-whatsapp" style="color:#25d366;"></i>
                            </div>
                            <div>
                                <span class="info-label">WhatsApp / HP</span>
                                <span class="info-value">0895-2233-4455</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#e8f1fc;">
                                <i class="fas fa-envelope" style="color:#378ADD;"></i>
                            </div>
                            <div>
                                <span class="info-label">Email</span>
                                <span class="info-value">f.andriani@sekolah.sch.id</span>
                            </div>
                        </div>
                        <div class="pembina-info-row">
                            <div class="pembina-info-icon" style="background:#fff0e8;">
                                <i class="fas fa-map-marker-alt" style="color:#E8593C;"></i>
                            </div>
                            <div>
                                <span class="info-label">Alamat</span>
                                <span class="info-value">Jl. Pemuda No. 19, Kec. Pulo Gadung, Jakarta Timur</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /row -->
        </div><!-- /container -->
    </section>
    <!-- ===== END SEKSI PEMBINA ===== -->

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
                        <li><a href="/gin">Login</a></li>
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