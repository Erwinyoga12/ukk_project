<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Rekap Nilai Eskul</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root{
  --primary:#0fb9a8;
  --primary-dark:#0aa193;
  --bg:#f4f6fa;
}

body{
  margin:0;
  font-family:Inter,Segoe UI,sans-serif;
  background:var(--bg);
}

/* ===== SIDEBAR ===== */
.sidebar{
  width:260px;
  height:100vh;
  background:var(--primary);
  position:fixed;
  display:flex;
  flex-direction:column;
}

.sidebar-header{
  padding:22px;
  font-size:20px;
  font-weight:600;
  text-align:center;
  background:var(--primary-dark);
  color:#fff;
  letter-spacing:.5px;
}

.sidebar ul{
  list-style:none;
  padding:0;
  margin:16px 0;
}

.sidebar li{
  padding:14px 26px;
  display:flex;
  gap:12px;
  align-items:center;
  color:#eaf2ff;
  cursor:pointer;
  transition:.2s;
}

.sidebar li:hover{
  background:rgba(255,255,255,.15);
}

.sidebar li.active{
  background:rgba(255,255,255,.3);
  border-left:4px solid #fff;
  font-weight:600;
}

.sidebar .logout{
  margin-top:auto;
  background:rgba(0,0,0,.2);
}

/* ===== MAIN ===== */
.main{
  margin-left:260px;
  padding:28px;
}

/* ===== TOPBAR ===== */
.topbar{
  background:#fff;
  padding:16px 20px;
  border-radius:14px;
  box-shadow:0 8px 24px rgba(0,0,0,.06);
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin-bottom:24px;
}

.topbar h4{
  margin:0;
  font-weight:600;
}

/* ===== CARD ===== */
.card{
  border:none;
  border-radius:16px;
  box-shadow:0 10px 28px rgba(0,0,0,.06);
}

/* ===== TABLE ===== */
.table thead{
  background:var(--primary-dark);
  color:#fff;
}

/* ===== BUTTON ===== */
.btn-cetak{
  background:var(--primary);
  color:#fff;
  border:none;
  padding:10px 22px;
  border-radius:30px;
  font-weight:600;
  display:inline-flex;
  gap:8px;
  align-items:center;
}

.btn-cetak:hover{
  background:var(--primary-dark);
}

/* ===== PRINT MODE ===== */
@media print{
  body{
    background:#fff;
  }
  .sidebar,
  .no-print,
  .btn-cetak{
    display:none !important;
  }
  .main{
    margin:0;
    padding:0;
  }
}
</style>
</head>

<body>
<!-- ===== SIDEBAR ===== -->
<aside class="sidebar">
  {{-- Nama eskul dari server, bukan localStorage --}}
  <div class="sidebar-header">{{ strtoupper($eskul) }}</div>

  <ul>
    <li onclick="location.href='/eskul'">
      <i class="bi bi-pencil-square"></i> Penilaian
    </li>
    <li class="active">
      <i class="bi bi-bar-chart"></i> Rekap Penilaian
    </li>
  </ul>

  <ul>
    <li class="logout" onclick="showLogoutModal()">
      <i class="bi bi-box-arrow-right"></i> Logout
    </li>
  </ul>
</aside>

<!-- ===== MAIN ===== -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div>
      <h4>Rekap Nilai Ekstrakurikuler</h4>
      <small class="text-muted" id="subTitle">Laporan nilai peserta didik {{ strtoupper($eskul) }}</small>
    </div>
    <button onclick="cetak()" class="btn-cetak no-print">
      <i class="bi bi-printer"></i> Cetak
    </button>
  </div>

  <!-- INFO -->
  <div class="mb-3">
    <h6 class="fw-bold mb-1">Rekap Nilai Eskul {{ strtoupper($eskul) }}</h6>
    <small class="text-muted">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</small>
  </div>

  <!-- TABLE -->
  <div class="card p-4">
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>NIPD</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Deskripsi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($data as $i => $d)
          <tr>
            <td class="text-center">{{ $i + 1 }}</td>
            <td>{{ $d->nama_siswa ?? '-' }}</td>
            <td>{{ $d->nipd ?? '-' }}</td>
            <td class="text-center">{{ $d->kelas ?? '-' }}</td>
            <td class="text-center">{{ $d->jurusan ?? '-' }}</td>
            <td class="text-center">{{ $d->nilai ?? '-' }}</td>
            <td class="text-center">{{ $d->predikat ?? '-' }}</td>
            <td>{{ $d->deskripsi ?? '-' }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center text-muted">
              Data kosong / belum ada penilaian yang disimpan
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- ===== MODAL KONFIRMASI LOGOUT ===== -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">
          <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
          Konfirmasi Logout
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Apakah Anda yakin ingin keluar dari sistem penilaian?
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Batal
        </button>
        <button type="button" class="btn btn-danger" onclick="confirmLogout()">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function cetak(){
  window.print();
}

function showLogoutModal(){
  const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
  modal.show();
}

async function confirmLogout(){
  localStorage.removeItem("eskul_login");

  // Hapus session Laravel juga
  await fetch("/logout-eskul", {
    method: "POST",
    headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content }
  });

  location.href = "/gin";
}
</script>

</body>
</html>