<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Rekap Nilai Eskul</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

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
  <div class="sidebar-header" id="eskulTitle">ESKUL</div>

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
      <small class="text-muted" id="subTitle">Laporan nilai peserta didik</small>
    </div>
    <button onclick="cetak()" class="btn-cetak no-print">
      <i class="bi bi-printer"></i> Cetak
    </button>
  </div>

  <!-- INFO -->
  <div class="mb-3">
    <h6 id="infoCetak" class="fw-bold mb-1"></h6>
    <small id="infoTanggal" class="text-muted"></small>
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
            <th>Eskul</th>
            <th>Nilai</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <tr>
            <td colspan="8" class="text-center text-muted">
              Data belum tersedia
            </td>
          </tr>
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
/* ==========================
   INIT
========================== */
const eskulLogin = (localStorage.getItem("eskul_login") || "PRAMUKA").toUpperCase();
document.getElementById("eskulTitle").innerText = eskulLogin;

const tbody = document.getElementById("tbody");
const infoCetak = document.getElementById("infoCetak");
const infoTanggal = document.getElementById("infoTanggal");

/* ==========================
   AMBIL DATA
========================== */
function ambilSemuaData(){
  const hasil = [];

  ["X","XI"].forEach(kelas=>{
    const key = `nilai_${eskulLogin}_${kelas}`;
    const dataNilai = JSON.parse(localStorage.getItem(key) || "[]");

    if(dataNilai.length){
      dataNilai.forEach((d, i)=>{
        hasil.push({
          nama: `Siswa ${i+1}`,
          nipd: `${kelas}-${i+1}`,
          kelas: kelas,
          jurusan: "-",
          eskul: eskulLogin,
          nilai: d.nilai || "-",
          ket: d.deskripsi || "-"
        });
      });
    }
  });

  return hasil;
}

/* ==========================
   RENDER TABLE
========================== */
function render(){
  tbody.innerHTML = "";

  const list = ambilSemuaData();

  if(list.length === 0){
    tbody.innerHTML = `
      <tr>
        <td colspan="8" class="text-center text-muted">
          Data kosong / belum ada penilaian yang disimpan
        </td>
      </tr>`;
    return;
  }

  infoCetak.innerText = `Rekap Nilai Eskul ${eskulLogin}`;

  const today = new Date();
  infoTanggal.innerText = `Dicetak pada: ${today.toLocaleDateString("id-ID")}`;

  list.forEach((s,i)=>{
    tbody.innerHTML += `
      <tr>
        <td class="text-center">${i+1}</td>
        <td>${s.nama}</td>
        <td>${s.nipd}</td>
        <td class="text-center">${s.kelas}</td>
        <td class="text-center">${s.jurusan}</td>
        <td class="text-center">${s.eskul}</td>
        <td class="text-center">${s.nilai}</td>
        <td>${s.ket}</td>
      </tr>
    `;
  });
}

render();

/* ==========================
   ACTION
========================== */
function cetak(){
  window.print();
}

function showLogoutModal(){
  const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
  modal.show();
}

function confirmLogout(){
  localStorage.removeItem("eskul_login");
  location.href = "home";
}
</script>

</body>
</html>
      