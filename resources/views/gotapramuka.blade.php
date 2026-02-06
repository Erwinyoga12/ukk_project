<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Anggota Pramuka</title>
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
  margin:20px 0;
}

.sidebar a{ text-decoration:none }

.sidebar li{
  padding:14px 26px;
  display:flex;
  gap:12px;
  align-items:center;
  color:#eaf2ff;
  transition:.2s;
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
  padding:32px;
}

.page-title{
  font-size:22px;
  font-weight:600;
  margin-bottom:24px;
}

.card{
  border:none;
  border-radius:14px;
  box-shadow:0 10px 28px rgba(0,0,0,.06);
}

.stat-icon{
  font-size:28px;
  opacity:.8;
}

.table thead{
  background:var(--primary-dark);
  color:#fff;
}

.badge-aktif{ background:#198754 }
.badge-nonaktif{ background:#dc3545 }
</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-header">PRAMUKA</div>

  <ul>
    <a href="/pramuka">
      <li>
        <i class="bi bi-pencil-square"></i> Penilaian
      </li>
    </a>
    <a href="/prmkrekap">
      <li>
        <i class="bi bi-bar-chart"></i> Rekap Nilai
      </li>
    </a>
    <a href="/gotapramu">
      <li class="active">
        <i class="bi bi-people"></i> Anggota
      </li>
    </a>
  </ul>

  <ul>
    <a href="#" onclick="showLogoutModal(event)">
      <li class="logout">
        <i class="bi bi-box-arrow-right"></i> Logout
      </li>
    </a>
  </ul>
</aside>

<!-- MAIN -->
<main class="main">
  <div class="page-title">Dashboard Anggota Eskul Pramuka</div>

  <!-- STAT CARDS -->
  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card p-4">
        <div class="d-flex justify-content-between">
          <div>
            <div class="text-muted">eskul</div>
            <h3 id="total">0</h3>
          </div>
          <i class="bi bi-people stat-icon text-primary"></i>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card p-4">
        <div class="d-flex justify-content-between">
          <div>
            <div class="text-muted">Anggota Aktif</div>
            <h3 id="aktif">0</h3>
          </div>
          <i class="bi bi-check-circle stat-icon text-success"></i>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card p-4">
        <div class="d-flex justify-content-between">
          <div>
            <div class="text-muted">Tidak Aktif</div>
            <h3 id="nonaktif">0</h3>
          </div>
          <i class="bi bi-x-circle stat-icon text-danger"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="card p-4">
    <table class="table table-bordered align-middle">
      <thead>
        <tr class="text-center">
          <th>No</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Jurusan</th>
          <th>JK</th>
          <th>Status</th>
          <th width="120">Aksi</th>
        </tr>
      </thead>
      <tbody id="tbody"></tbody>
    </table>
  </div>
</main>

<!-- MODAL LOGOUT -->
<div class="modal fade" id="logoutModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="bi bi-exclamation-triangle text-warning"></i>
          Konfirmasi Logout
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin logout?
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">
          Batal
        </button>
        <a href="/home" class="btn btn-danger">
          Ya, Logout
        </a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const anggota = [
  {nama:"Raka Pradana",kelas:"X",jurusan:"RPL",jk:"L",status:"Aktif"},
  {nama:"Kevin Saputra",kelas:"X",jurusan:"RPL",jk:"L",status:"Aktif"},
  {nama:"Citra Lestari",kelas:"XI",jurusan:"DKV",jk:"P",status:"Tidak Aktif"}
];

const tbody = document.getElementById("tbody");

function loadData(){
  tbody.innerHTML = "";

  let aktif = 0;
  let nonaktif = 0;

  anggota.forEach((a,i)=>{
    if(a.status === "Aktif") aktif++;
    else nonaktif++;

    tbody.innerHTML += `
      <tr class="text-center">
        <td>${i+1}</td>
        <td class="text-start">${a.nama}</td>
        <td>${a.kelas}</td>
        <td>${a.jurusan}</td>
        <td>${a.jk}</td>
        <td>
          <span class="badge ${a.status === "Aktif" ? "badge-aktif" : "badge-nonaktif"}">
            ${a.status}
          </span>
        </td>
        <td>
          <button class="btn btn-sm btn-outline-primary">Edit</button>
          <button class="btn btn-sm btn-outline-danger">Hapus</button>
        </td>
      </tr>`;
  });

  document.getElementById("total").textContent = anggota.length;
  document.getElementById("aktif").textContent = aktif;
  document.getElementById("nonaktif").textContent = nonaktif;
}

function showLogoutModal(e){
  e.preventDefault();
  const modal = new bootstrap.Modal(document.getElementById("logoutModal"));
  modal.show();
}

loadData();
</script>

</body>
</html>
