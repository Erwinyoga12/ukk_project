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
body{ margin:0; font-family:Inter,Segoe UI,sans-serif; background:var(--bg); }

.sidebar{ width:260px;height:100vh;background:var(--primary);position:fixed;display:flex;flex-direction:column;}
.sidebar-header{ padding:22px;font-size:20px;font-weight:600;text-align:center;background:var(--primary-dark);color:#fff;}
.sidebar ul{ list-style:none;padding:0;margin:16px 0;}
.sidebar li{ padding:14px 26px;display:flex;gap:12px;align-items:center;color:#eaf2ff;cursor:pointer;}
.sidebar li:hover{ background:rgba(255,255,255,.15);}
.sidebar li.active{ background:rgba(255,255,255,.3);border-left:4px solid #fff;font-weight:600;}
.sidebar .logout{ margin-top:auto;background:rgba(0,0,0,.2);}

.main{ margin-left:260px;padding:28px;}

.topbar{ background:#fff;padding:16px 20px;border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);
display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;}

.card{ border:none;border-radius:16px;box-shadow:0 10px 28px rgba(0,0,0,.06);}
.table thead{ background:var(--primary-dark);color:#fff;}

.btn-cetak{ background:var(--primary);color:#fff;border:none;padding:10px 22px;border-radius:30px;font-weight:600;}
.btn-cetak:hover{ background:var(--primary-dark);}

@media print{
  .sidebar,.no-print,.btn-cetak{display:none!important;}
  .main{margin:0;padding:0;}
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-header">{{ strtoupper($eskul) }}</div>

  <ul>
    <li onclick="location.href='/eskul'">
      <i class="bi bi-pencil-square"></i> Penilaian
    </li>
    <li class="active">
      <i class="bi bi-bar-chart"></i> Data Nilai
    </li>
  </ul>

  <ul>
    <li class="logout" onclick="showLogoutModal()">
      <i class="bi bi-box-arrow-right"></i> Logout
    </li>
  </ul>
</aside>

<!-- MAIN -->
<div class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div>
      <h4>Data Penilaian</h4>
      <small class="text-muted">Laporan nilai peserta didik {{ strtoupper($eskul) }}</small>
    </div>
    <button onclick="cetak()" class="btn-cetak no-print">
      <i class="bi bi-printer"></i> Cetak
    </button>
  </div>

  <!-- FILTER -->
  <div class="card p-3 mb-3 no-print">
    <div class="row g-3">

      <!-- KELAS -->
      <div class="col-md-4">
        <label class="form-label">Kelas</label>
        <select id="kelasFilter" class="form-control">
          <option value="">-- Pilih Kelas --</option>
          @foreach($kelasOptions as $k)
            <option value="{{ $k }}">{{ $k }}</option>
          @endforeach
        </select>
      </div>

      <!-- JURUSAN -->
      <div class="col-md-4">
        <label class="form-label">Jurusan</label>
        <select id="jurusanFilter" class="form-control">
          <option value="">-- Pilih Jurusan --</option>
          @foreach($jurusanOptions as $j)
            <option value="{{ $j }}">{{ $j }}</option>
          @endforeach
        </select>
      </div>

      <!-- BUTTON -->
      <div class="col-md-4 d-flex align-items-end">
        <button onclick="loadRekap()" class="btn btn-primary w-100">
          <i class="bi bi-search"></i> Cari
        </button>
      </div>

    </div>
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
        <tbody id="tabel_rekap">
          <tr>
            <td colspan="8" class="text-center text-muted">
              Pilih kelas & jurusan lalu klik cari
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- MODAL -->
<div class="modal fade" id="logoutModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Logout</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Yakin ingin logout?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger" onclick="confirmLogout()">Logout</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function cetak(){ window.print(); }

function showLogoutModal(){
  new bootstrap.Modal(document.getElementById('logoutModal')).show();
}

async function confirmLogout(){
  await fetch("/logout-eskul", {
    method:"POST",
    headers:{ "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content }
  });
  location.href="/gin";
}

/* 🔥 FINAL LOAD (SUDAH SESUAI CONTROLLER JOIN) */
async function loadRekap(){
  const kelas   = document.getElementById('kelasFilter').value;
  const jurusan = document.getElementById('jurusanFilter').value;

  if(!kelas || !jurusan){
    alert("Pilih kelas & jurusan dulu!");
    return;
  }

  const tbody = document.getElementById('tabel_rekap');
  tbody.innerHTML = `<tr><td colspan="8" class="text-center">Loading...</td></tr>`;

  try{
    const res = await fetch(`/rekap/data?kelas=${kelas}&jurusan=${jurusan}`);
    const data = await res.json();

    tbody.innerHTML = '';

    if(!data.length){
      tbody.innerHTML = `<tr><td colspan="8" class="text-center text-muted">Data tidak ditemukan</td></tr>`;
      return;
    }

    data.forEach((d,i)=>{
      tbody.innerHTML += `
      <tr>
        <td class="text-center">${i+1}</td>
        <td>${d.nama_siswa ?? '-'}</td>
        <td>${d.nipd ?? '-'}</td>
        <td class="text-center">${d.kelas ?? '-'}</td>
        <td class="text-center">${d.jurusan ?? '-'}</td>
        <td class="text-center">${d.nilai ?? '-'}</td>
        <td class="text-center">${d.predikat ?? '-'}</td>
        <td>${d.deskripsi ?? '-'}</td>
      </tr>`;
    });

  }catch(e){
    console.error(e);
    alert("Gagal ambil data");
  }
}
</script>

</body>
</html>
