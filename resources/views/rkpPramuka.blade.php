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
  padding:32px;
}

.card{
  border:none;
  border-radius:14px;
  box-shadow:0 10px 28px rgba(0,0,0,.06);
}

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

<!-- SIDEBAR -->
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
    <li class="logout" onclick="logout()">
      <i class="bi bi-box-arrow-right"></i> Logout
    </li>
  </ul>
</aside>

<!-- MAIN -->
<div class="main">

<h4 class="fw-bold">Rekap Nilai Ekstrakurikuler</h4>
<p class="text-muted no-print">Laporan nilai peserta didik</p>

<!-- FILTER -->
<div class="card p-3 mb-3 no-print">
  <div class="row g-3">
    <div class="col-md-4">
      <label>Eskul</label>
      <select id="eskul" class="form-select" disabled></select>
    </div>
    <div class="col-md-4">
      <label>Kelas</label>
      <select id="kelas" class="form-select">
        <option value="">Pilih</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
      </select>
    </div>
    <div class="col-md-4">
      <label>Jurusan</label>
      <select id="jurusan" class="form-select">
        <option value="">Semua</option>
        <option>RPL</option>
        <option>TKJ</option>
        <option>DKV</option>
        <option>BIDI</option>
      </select>
    </div>
  </div>
</div>

<!-- INFO CETAK -->
<h5 id="infoCetak" class="fw-bold mb-3"></h5>

<!-- TABLE -->
<div class="card p-3">
<table class="table table-bordered">
<thead>
<tr>
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
    Pilih kelas dulu
  </td>
</tr>
</tbody>
</table>

<button onclick="cetak()" class="btn-cetak no-print">
  <i class="bi bi-printer"></i> Cetak
</button>
</div>

</div>

<script>
const eskulLogin = (localStorage.getItem("eskul_login") || "PRAMUKA").toUpperCase();
document.getElementById("eskulTitle").innerText = eskulLogin;
document.getElementById("eskul").innerHTML = `<option>${eskulLogin}</option>`;

const kelas = document.getElementById("kelas");
const jurusan = document.getElementById("jurusan");
const tbody = document.getElementById("tbody");
const infoCetak = document.getElementById("infoCetak");

const data = {
  PRAMUKA:{
    X:[
      {nama:"Raka",nipd:"001",jurusan:"RPL",nilai:"A",ket:"Aktif"},
      {nama:"Bima",nipd:"002",jurusan:"TKJ",nilai:"B",ket:"Baik"}
    ],
    XI:[
      {nama:"Dimas",nipd:"003",jurusan:"DKV",nilai:"A",ket:"Disiplin"}
    ]
  }
};

function render(){
  tbody.innerHTML="";
  const list = (data[eskulLogin]?.[kelas.value]) || [];
  const filterJurusan = jurusan.value;

  const hasil = filterJurusan
    ? list.filter(d=>d.jurusan===filterJurusan)
    : list;

  if(!kelas.value || hasil.length===0){
    tbody.innerHTML = `
      <tr>
        <td colspan="8" class="text-center text-muted">
          Data kosong
        </td>
      </tr>`;
    return;
  }

  infoCetak.innerText = `Rekap Nilai Eskul ${eskulLogin} - Kelas ${kelas.value} ${filterJurusan ? "- Jurusan "+filterJurusan : ""}`;

  hasil.forEach((s,i)=>{
    tbody.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td>${s.nama}</td>
        <td>${s.nipd}</td>
        <td>${kelas.value}</td>
        <td>${s.jurusan}</td>
        <td>${eskulLogin}</td>
        <td>${s.nilai}</td>
        <td>${s.ket}</td>
      </tr>`;
  });
}

kelas.onchange = render;
jurusan.onchange = render;

function cetak(){
  if(!kelas.value){
    alert("Pilih kelas dulu!");
    return;
  }
  window.print();
}

function logout(){
  localStorage.removeItem("eskul_login");
  location.href="login.html";
}
</script>

</body>
</html>
