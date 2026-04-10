<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Eskul Professional</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS LIBRARIES -->
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
            background: linear-gradient(135deg, rgba(4, 30, 35, .88), rgba(4, 30, 35, .65));
        }

        .hero .container {
            position: relative;
        }

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

        /* ================= CARD ================= */
        .demo-card {
            position: relative;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
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

        .demo-card.active .overlay {
            transform: translateY(0);
        }

        .demo-card.active .demo-btn {
            opacity: 1;
            transform: translate(-50%, -50%);
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

        .footer ul li a:hover {
            color: #000;
        }

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

        .footer-bottom a:hover {
            color: #000;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
            }

            .demo-card img {
                height: 300px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Navbar content (sesuai versi kamu) -->
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Penilaian Ekstrakurikuler</h1>
<p>Platform profesional untuk mengelola kegiatan dan penilaian ekstrakurikuler siswa.</p>

            <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                <a href="gin" class="btn-main">Input Nilai</a>
                <a href="#eskul" style="color:#d0f5ee; text-decoration:none;">Lihat Kegiatan</a>
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

                <!-- CARD ITEMS (tetap sama) -->
                <!-- Copy punyamu, tidak diubah struktur -->

                <!-- Contoh satu -->
               <div class="col-lg-4">
            <div class="demo-card">
                <img src="image/kib.jpg">
                <div class="label">ESKUL PASKIBRA</div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="demo-card">
                <img src="image/prmuka.jpg">
                <div class="label">ESKUL PRAMUKA</div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="demo-card">
                <img src="image/pmr.jpg">
                <div class="label">ESKUL PMR</div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="demo-card">
                <img src="image/drm.jpg">
                <div class="label">ESKUL DRUMBAND</div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="demo-card">
                <img src="image/nat.jpg">
                <div class="label">ESKUL NATBINARI</div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="demo-card">
                <img src="image/jrnl.jpg">
                <div class="label">ESKUL JURNALISTIK</div>
            </div>
        </div>

                <!-- (lanjutkan semua card punyamu, tetap sama persis) -->

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

            <div class="footer-bottom d-flex justify-content-between">
                <span>© 2026 Eskul Professional</span>
                <div>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('.demo-card').forEach(card => {
            card.addEventListener('mouseenter', () => card.classList.add('active'));
            card.addEventListener('mouseleave', () => card.classList.remove('active'));
        });
    </script>

</body>
</html>
