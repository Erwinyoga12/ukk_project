<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Penilaian Eskul</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root {
  --primary: #0fb9a8;
  --primary-dark: #0aa193;
  --bg: #eef1f4;
}

body {
  margin: 0;
  font-family: Inter, Segoe UI, sans-serif;
  background: var(--bg);
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

/* ===== CONTENT ===== */
.content {
  margin-left: 260px;
  padding: 30px;
}

.card {
  padding: 20px;
  border-radius: 12px;
  margin-bottom: 20px;
  border: none;
  box-shadow: 0 8px 20px rgba(0,0,0,.05);
}
</style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<aside class="sidebar">
  <div class="sidebar-header" id="eskulTitle"></div>

  <ul>
    <li class="active" onclick="location.href='/eskul'">
      <i class="bi bi-pencil-square"></i> Penilaian
    </li>
    <li onclick="location.href='/rekap'">
      <i class="bi bi-bar-chart"></i> Rekap Penilaian
    </li>
  </ul>

  <ul>
    <li class="logout" onclick="showLogoutModal()">
      <i class="bi bi-box-arrow-right"></i> Logout
    </li>
  </ul>
</aside>

<!-- ===== CONTENT ===== -->
<div class="content">

<div class="card bg-white">
<h4>Penilaian Ekskul</h4>
<p class="text-muted">Pilih kelas untuk mulai penilaian</p>
</div>

<div class="card bg-white">

<div class="row">

<div class="col-md-4">
<label>Eskul</label>
<input type="text" id="eskulInput" class="form-control" readonly>
</div>

<div class="col-md-4">
<label>Kelas</label>
<select id="kelas" class="form-control">
<option value="">Pilih</option>
<option value="X">X</option>
<option value="XI">XI</option>
</select>
</div>

<div class="col-md-4 d-flex align-items-end gap-2">
<button onclick="loadData()" class="btn btn-primary">Cari</button>
<button onclick="simpanData()" class="btn btn-success">Simpan</button>
</div>

</div>

</div>

<div class="card bg-white">

<table class="table table-bordered">

<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>NIPD</th>
<th>Jurusan</th>
<th>Nilai</th>
<th>Predikat</th>
<th>Deskripsi</th>
</tr>
</thead>

<tbody id="tabel_siswa">
<tr>
<td colspan="7" class="text-center">Pilih kelas dahulu</td>
</tr>
</tbody>

</table>

</div>

</div>

<!-- ===== MODAL LOGOUT ===== -->
<div class="modal fade" id="logoutModal" tabindex="-1">
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
        Apakah Anda yakin ingin keluar?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger" onclick="confirmLogout()">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

// ===== CEK LOGIN =====
const eskulLogin = localStorage.getItem("eskul_login")

if(!eskulLogin){
  location.href="/"
}

document.getElementById("eskulTitle").innerText = eskulLogin.toUpperCase()
document.getElementById("eskulInput").value = eskulLogin

// ===== LOGOUT (VERSI BARU) =====
function showLogoutModal(){
  const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
  modal.show();
}

async function confirmLogout(){
  localStorage.removeItem("eskul_login");

  await fetch("/logout-eskul", {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
    }
  });

  location.href = "/gin";
}

// ===== LOGIC NILAI =====
function getPredikat(nilai){
  nilai = parseInt(nilai)
  if(nilai >= 85) return "A"
  if(nilai >= 75) return "B"
  if(nilai >= 10) return "C"
  return ""
}

function updatePredikat(input){
  let row = input.closest("tr")
  let pred = row.querySelector(".predikat")
  pred.value = getPredikat(input.value)
}

function loadData(){
  let kelas = document.getElementById("kelas").value

  fetch(`/eskul/data?eskul=${eskulLogin}&kelas=${kelas}`)
  .then(res => res.json())
  .then(data => {

    let tabel = document.getElementById("tabel_siswa")
    tabel.innerHTML = ""

    data.forEach((s,i)=>{
      tabel.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td class="nama">${s.nama_siswa}</td>
        <td class="nipd">${s.nipd}</td>
        <td class="jurusan">${s.jurusan}</td>

        <td>
          <input type="number" class="form-control nilai" oninput="updatePredikat(this)">
        </td>

        <td>
          <input type="text" class="form-control predikat" readonly>
        </td>

        <td>
          <input type="text" class="form-control deskripsi">
        </td>
      </tr>
      `
    })

  })
}

function simpanData(){

  let rows = document.querySelectorAll("#tabel_siswa tr")
  let data = []

  rows.forEach(r=>{
    let nipd = r.querySelector(".nipd")?.innerText

    if(nipd){
      data.push({
        nama_siswa: r.querySelector(".nama").innerText,
        nipd: nipd,
        jurusan: r.querySelector(".jurusan").innerText,
        nilai: r.querySelector(".nilai").value,
        predikat: r.querySelector(".predikat").value,
        deskripsi: r.querySelector(".deskripsi").value
      })
    }
  })

  fetch("/eskul/simpan",{
    method:"POST",
    headers:{
      "Content-Type":"application/json",
      "X-CSRF-TOKEN":"{{ csrf_token() }}"
    },
    body:JSON.stringify({
      eskul:eskulLogin,
      kelas:document.getElementById("kelas").value,
      data:data
    })
  })
  .then(res=>res.json())
  .then(()=>alert("Nilai berhasil disimpan"))

}

</script>

</body>
</html>