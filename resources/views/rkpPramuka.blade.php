<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Rekap Nilai Pramuka</title>
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

.sidebar ul{list-style:none;padding:0;margin:20px 0}

.sidebar li{
  position:relative;
  padding:14px 26px;
  color:#eafffd;
  transition:.25s;
}

.sidebar li::before{
  content:"";
  position:absolute;
  left:0;top:0;
  width:4px;height:100%;
  background:#fff;
  opacity:0;
}

.sidebar li:hover{
  background:rgba(255,255,255,.22);
  padding-left:32px;
}

.sidebar li.active{
  background:rgba(255,255,255,.28);
  font-weight:600;
}

.sidebar li.active::before{opacity:1}

.menu-link{
  text-decoration:none;
  color:inherit;
  display:flex;
  align-items:center;
  gap:12px;
  width:100%;
}

.sidebar .logout{
  margin-top:auto;
  background:rgba(0,0,0,.1);
}

/* ===== MAIN ===== */
.main{
  margin-left:260px;
  padding:32px;
}

.page-title{
  font-size:22px;
  font-weight:600;
  margin-bottom:22px;
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

/* ===== PRINT MODE ===== */
@media print{
  .sidebar,
  .no-print,
  .btn{
    display:none !important;
  }

  body{
    background:#fff;
  }

  .main{
    margin:0;
    padding:20px;
  }

  .card{
    box-shadow:none;
    border:none;
    padding:0;
  }

  #infoKelas{
    font-size:16px;
    font-weight:600;
    margin-bottom:12px;
    color:#000;
  }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-header">PRAMUKA</div>

  <ul>
    <li>
      <a href="/pramuka" class="menu-link">
        <i class="bi bi-pencil-square"></i> Penilaian
      </a>
    </li>

    <li class="active">
      <a href="/prmkrekap" class="menu-link">
        <i class="bi bi-bar-chart"></i> Rekap Nilai
      </a>
    </li>

    <li>
      <a href="/gotapramu" class="menu-link">
        <i class="bi bi-people"></i> Anggota
      </a>
    </li>
  </ul>

  <ul>
    <li class="logout">
      <a href="#" class="menu-link">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </li>
  </ul>
</aside>

<!-- MAIN -->
<main class="main">

<div class="page-title">Rekap Nilai Ekstrakurikuler Pramuka</div>

<!-- FILTER (HILANG SAAT PRINT) -->
<div class="card p-4 mb-4 no-print">
  <div class="row g-3">
    <div class="col-md-6">
      <label>Kelas</label>
      <select id="kelas" class="form-select">
        <option value="">Pilih Kelas</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
      </select>
    </div>
    <div class="col-md-6">
      <label>Jurusan / Rombel</label>
      <select id="rombel" class="form-select">
        <option value="">Pilih Jurusan</option>
        <option>BIDI 1</option>
        <option>BIDI 2</option>
        <option>BIDI 3</option>
        <option>RPL</option>
        <option>TKJ 1</option>
        <option>TKJ 2</option>
        <option>DKV</option>
      </select>
    </div>
  </div>
</div>

<!-- INFO KELAS (MUNCUL DI PRINT) -->
<div id="infoKelas" class="mb-3 fw-semibold text-muted"></div>

<!-- TABLE -->
<div class="card p-4">
<table class="table table-bordered">
<thead>
<tr>
  <th>No</th>
  <th>Nama Siswa</th>
  <th>NIPD</th>
  <th>Eskul</th>
  <th>Nilai</th>
  <th>Keterangan</th>
</tr>
</thead>
<tbody id="tbody">
<tr>
  <td colspan="6" class="text-center text-muted py-4">
    Pilih kelas dan jurusan
  </td>
</tr>
</tbody>
</table>

<div class="text-end mt-3 no-print">
  <button onclick="window.print()" class="btn btn-outline-secondary">
    <i class="bi bi-printer"></i> Print Rekap
  </button>
</div>
</div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const dataRekap={
X:{
  "RPL":[
    {nama:"Raka Pradana",nipd:"X001",nilai:"A",ket:"Sangat aktif"},
    {nama:"Kevin Saputra",nipd:"X002",nilai:"B",ket:"Aktif"}
  ],
  "BIDI 1":[
    {nama:"Ahmad Fauzi",nipd:"X003",nilai:"A",ket:"Disiplin"}
  ]
},
XI:{
  "DKV":[
    {nama:"Citra Lestari",nipd:"XI001",nilai:"A",ket:"Kreatif"}
  ]
}
};

const kelas=document.getElementById("kelas");
const rombel=document.getElementById("rombel");
const tbody=document.getElementById("tbody");
const info=document.getElementById("infoKelas");

function loadRekap(){
  tbody.innerHTML="";
  info.innerHTML="";

  const list=dataRekap[kelas.value]?.[rombel.value];
  if(!list){
    tbody.innerHTML=`<tr><td colspan="6" class="text-center text-muted py-4">Data belum tersedia</td></tr>`;
    return;
  }

  info.innerHTML=`Kelas ${kelas.value} – ${rombel.value}`;

  list.forEach((s,i)=>{
    tbody.innerHTML+=`
      <tr>
        <td>${i+1}</td>
        <td>${s.nama}</td>
        <td>${s.nipd}</td>
        <td>PRAMUKA</td>
        <td><b>${s.nilai}</b></td>
        <td>${s.ket}</td>
      </tr>`;
  });
}

kelas.addEventListener("change",loadRekap);
rombel.addEventListener("change",loadRekap);
</script>

</body>
</html>
