<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6f9;
}

/* HERO */
.contact-hero{
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
    url('{{ asset('image/mpls2024.jpg') }}') no-repeat;
    background-size: cover;
    background-position: center;
    padding: 100px 0;
    color: white;
    text-align: center;
}

.contact-hero h1{
    font-weight: 700;
    font-size: 42px;
}

.contact-hero p{
    opacity: 0.9;
}

/* SECTION */
.contact-section{
    margin-top: -60px;
    padding-bottom: 80px;
}

.contact-wrapper{
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* FORM */
.contact-form{
    padding: 50px;
}

.form-control{
    border-radius: 12px;
    padding: 12px;
    border: 1px solid #ddd;
}

.form-control:focus{
    box-shadow: none;
    border-color: #111827;
}

.btn-send{
    background: #111827;
    color: white;
    border-radius: 12px;
    padding: 12px 30px;
    font-weight: 500;
}

.btn-send:hover{
    background: #000;
}

/* INFO */
.contact-info{
    background: #111827;
    color: white;
    padding: 50px;
}

.contact-info h4{
    font-weight: 600;
    margin-bottom: 30px;
}

.info-item{
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.info-item i{
    font-size: 18px;
    margin-right: 15px;
}

.social-icons i{
    font-size: 18px;
    margin-right: 15px;
    cursor: pointer;
}
</style>
</head>
<body>

<!-- HERO -->
<section class="contact-hero">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p>Kami siap membantu dan menjawab pertanyaan Anda dengan cepat.</p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact-section">
<div class="container">
<div class="contact-wrapper row g-0">

    <!-- FORM -->
    <div class="col-lg-7">
    <div class="contact-form">
        <h3 class="mb-4 fw-semibold">Kirim Pesan</h3>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST"> {{-- ← tambah action & method --}}
            @csrf {{-- ← wajib ada! --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text"
                           name="nama_lengkap" {{-- ← tambah name --}}
                           class="form-control"
                           placeholder="Nama Lengkap"
                           value="{{ old('nama_lengkap') }}">
                </div>
                <div class="col-md-6">
                    <input type="email"
                           name="email" {{-- ← tambah name --}}
                           class="form-control"
                           placeholder="Email"
                           value="{{ old('email') }}">
                </div>
            </div>

            <div class="mb-4">
                <textarea name="pesan" {{-- ← tambah name --}}
                          rows="5"
                          class="form-control"
                          placeholder="Tulis pesan Anda...">{{ old('pesan') }}</textarea>
            </div>

            <button type="submit" class="btn btn-send">
                <i class="bi bi-send-fill"></i> Kirim Pesan
            </button>
        </form>
    </div>
</div>

    <!-- INFO -->
    <div class="col-lg-5">
        <div class="contact-info">
            <h4>Informasi Kontak</h4>

            <div class="info-item">
                <i class="bi bi-geo-alt-fill"></i>
                <span>Jl. Bina Putra Mandiri No. 1, </span>
            </div>

            <div class="info-item">
                <i class="bi bi-envelope-fill"></i>
                <span>binaputramandiri@gmail.com</span>
            </div>

            <div class="info-item">
                <i class="bi bi-telephone-fill"></i>
                <span>+62 812 3456 7890</span>
            </div>

            <hr class="bg-light my-4">

            <h6 class="mb-3">Jam Operasional</h6>
            <p class="mb-1">Senin - Jumat : 08.00 - 16.00</p>
            <p class="mb-1">Sabtu : 08.00 - 12.00</p>
            <p>Minggu : Libur</p>

            <div class="social-icons mt-4">
                <i class="bi bi-facebook"></i>
                <i class="bi bi-instagram"></i>
                <i class="bi bi-twitter"></i>
                <i class="bi bi-whatsapp"></i>
            </div>
        </div>
    </div>

</div>
</div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
