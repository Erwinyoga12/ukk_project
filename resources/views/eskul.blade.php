<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Penilaian Ekstrakurikuler</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
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
}

.sidebar-menu{
  flex:1;
  display:flex;
  flex-direction:column;
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
  transition:.2s;
  cursor:pointer;
}

.sidebar li:hover{
  background:rgba(255,255,255,.15);
}

.sidebar li.active{
  background:rgba(255,255,255,.3);
  font-weight:600;
  border-left:4px solid #fff;
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
  border-radius:14px;
  box-shadow:0 10px 28px rgba(0,0,0,.06);
}

/* ===== TABLE ===== */
.table thead{
  background:var(--primary-dark);
  color:#fff;
}
</style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<aside class="sidebar">
  <div class="sidebar-header" id="eskulTitle">ESKUL</div>

  <div class="sidebar-menu">
    <ul>
      <li class="active">
        <i class="bi bi-pencil-square"></i> Penilaian
      </li>
      <li onclick="location.href='/prmkrekap'">
        <i class="bi bi-bar-chart"></i> Rekap Penilaian
      </li>
    </ul>

    <ul>
      <!-- LOGOUT pakai MODAL -->
      <li class="logout" data-bs-toggle="modal" data-bs-target="#modalLogout">
        <i class="bi bi-box-arrow-right"></i> Logout
      </li>
    </ul>
  </div>
</aside>

<!-- ===== MAIN ===== -->
<main class="main">

  <!-- TOPBAR -->
  <div class="topbar">
    <div>
      <h4>Penilaian Ekstrakurikuler</h4>
      <small class="text-muted" id="subTitle">Silakan pilih kelas untuk mulai menilai</small>
    </div>
  </div>

  <!-- FILTER -->
  <div class="card p-4 mb-4">
    <div class="row g-3 align-items-end">
      <div class="col-md-5">
        <label class="form-label">Eskul</label>
        <select id="eskul" class="form-select" disabled></select>
      </div>
      <div class="col-md-5">
        <label class="form-label">Kelas</label>
        <select id="kelas" class="form-select">
          <option value="">Pilih Kelas</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
        </select>
      </div>
      <div class="col-md-2 d-grid">
        <button id="btnSimpan" class="btn btn-success">
          <i class="bi bi-save"></i> Simpan
        </button>
      </div>
    </div>
  </div>

  <!-- ALERT -->
  <div id="alertBox"></div>

  <!-- TABLE -->
  <div class="card p-4">
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Nama</th>
            <th>NIPD</th>
            <th>Jurusan</th>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Deskripsi</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <tr>
            <td colspan="7" class="text-center text-muted">
              Pilih kelas terlebih dahulu
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</main>

<!-- ===== MODAL LOGOUT ===== -->
<div class="modal fade" id="modalLogout" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="bi bi-exclamation-triangle text-warning"></i> Konfirmasi Logout
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

<script>
/* ==========================
   AUTH & INIT
========================== */
const eskulSelect = document.getElementById("eskul");
const kelasSelect = document.getElementById("kelas");
const tbody = document.getElementById("tbody");
const eskulTitle = document.getElementById("eskulTitle");
const btnSimpan = document.getElementById("btnSimpan");
const alertBox = document.getElementById("alertBox");
const subTitle = document.getElementById("subTitle");

const eskulLogin = localStorage.getItem("eskul_login");
if(!eskulLogin){
  location.href = "";
}

eskulSelect.innerHTML = `<option value="${eskulLogin}">${eskulLogin}</option>`;
eskulTitle.innerText = eskulLogin.toUpperCase();

/* ==========================
   DATA DUMMY
========================== */
const dataSiswa = {
  X: [
    {nama:"Andi", nipd:"12345", jurusan:"RPL"},
    {nama:"Budi", nipd:"12346", jurusan:"TKJ"}
  ],
  XI: [
    {nama:"Siti", nipd:"22345", jurusan:"RPL"},
    {nama:"Dina", nipd:"22346", jurusan:"DKV"}
  ]
};

function getStorageKey(){
  return `nilai_${eskulLogin}_${kelasSelect.value}`;
}

function getPredikat(nilai){
  if(nilai >= 90) return "A";
  if(nilai >= 80) return "B";
  if(nilai >= 70) return "C";
  return "D";
}

function showAlert(msg){
  alertBox.innerHTML = `
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      ${msg}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  `;
}

function renderTable(kelas){
  tbody.innerHTML = "";
  subTitle.innerText = `Sedang menilai kelas ${kelas}`;

  if(!dataSiswa[kelas]){
    tbody.innerHTML = `
      <tr>
        <td colspan="7" class="text-center text-muted">Data tidak tersedia</td>
      </tr>`;
    return;
  }

  const savedData = JSON.parse(localStorage.getItem(getStorageKey()) || "[]");

  dataSiswa[kelas].forEach((siswa, i)=>{
    const saved = savedData[i] || {};
    const nilai = saved.nilai || "";
    const deskripsi = saved.deskripsi || "";
    const pred = nilai ? getPredikat(nilai) : "-";

    tbody.innerHTML += `
      <tr>
        <td class="text-center">${i+1}</td>
        <td>${siswa.nama}</td>
        <td>${siswa.nipd}</td>
        <td>${siswa.jurusan}</td>
        <td><input type="number" class="form-control nilai" min="0" max="100" value="${nilai}"></td>
        <td class="predikat text-center">${pred}</td>
        <td><input type="text" class="form-control deskripsi" placeholder="Deskripsi" value="${deskripsi}"></td>
      </tr>
    `;
  });

  document.querySelectorAll(".nilai").forEach(input=>{
    input.addEventListener("input", e=>{
      const nilai = e.target.value;
      const predikat = e.target.closest("tr").querySelector(".predikat");
      predikat.innerText = nilai ? getPredikat(nilai) : "-";
    });
  });
}

function simpanData(){
  if(!kelasSelect.value){
    alert("Pilih kelas terlebih dahulu!");
    return;
  }

  const rows = document.querySelectorAll("#tbody tr");
  const hasil = [];

  rows.forEach(row=>{
    const nilai = row.querySelector(".nilai")?.value || "";
    const deskripsi = row.querySelector(".deskripsi")?.value || "";
    hasil.push({ nilai, deskripsi });
  });

  localStorage.setItem(getStorageKey(), JSON.stringify(hasil));
  showAlert("Data penilaian berhasil disimpan.");
}

/* ==========================
   EVENT
========================== */
kelasSelect.addEventListener("change", ()=>{
  if(kelasSelect.value){
    renderTable(kelasSelect.value);
  }
});

btnSimpan.addEventListener("click", simpanData);

/* ==========================
   LOGOUT CONFIRM
========================== */
function confirmLogout(){
  localStorage.removeItem("eskul_login");
  location.href = "home";
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
