<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Penilaian Pramuka</title>
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

.sidebar a{
  text-decoration:none;
}

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

.table thead{
  background:var(--primary-dark);
  color:#fff;
}

.table td{
  vertical-align:middle;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-header">PRAMUKA</div>

  <ul>
    <a href="#">
      <li class="active">
        <i class="bi bi-pencil-square"></i> Penilaian
      </li>
    </a>

    <a href="/prmkrekap">
      <li>
        <i class="bi bi-bar-chart"></i> Rekap Nilai
      </li>
    </a>

    <a href="/gotapramu">
      <li>
        <i class="bi bi-people"></i> Anggota
      </li>
    </a>
  </ul>

  <ul>
    <a href="#">
      <li class="logout">
        <i class="bi bi-box-arrow-right"></i> Logout
      </li>
    </a>
  </ul>
</aside>

<!-- MAIN -->
<main class="main">
  <div class="page-title">Penilaian Ekstrakurikuler Pramuka</div>

  <!-- FILTER -->
  <div class="card p-4 mb-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="fw-semibold">Kelas</label>
        <select id="kelas" class="form-select">
          <option value="">Pilih Kelas</option>
          <option>X</option>
          <option>XI</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="fw-semibold">Jurusan / Rombel</label>
        <select id="jurusan" class="form-select">
          <option value="">Pilih Jurusan</option>
          <option>RPL</option>
          <option>DKV</option>
        </select>
      </div>
    </div>
  </div>

  <!-- TABLE -->
  <div class="card p-4">
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th width="50">No</th>
          <th>Nama Siswa</th>
          <th width="80">Kelas</th>
          <th width="100">Jurusan</th>
          <th width="90">Nilai</th>
          <th width="90">Predikat</th>
          <th>Deskripsi Penilaian</th>
        </tr>
      </thead>

      <tbody id="tbody">
        <tr>
          <td colspan="7" class="text-center text-muted py-4">
            Pilih kelas dan jurusan terlebih dahulu
          </td>
        </tr>
      </tbody>
    </table>

    <div class="text-end mt-3">
      <button onclick="simpan()" class="btn btn-primary">
        <i class="bi bi-save"></i> Simpan Penilaian
      </button>
    </div>
  </div>
</main>

<script>
const dataSiswa = {
  X:{ RPL:["Raka Pradana","Kevin Saputra"] },
  XI:{ DKV:["Citra Lestari"] }
};

const kelas = document.getElementById("kelas");
const jurusan = document.getElementById("jurusan");
const tbody = document.getElementById("tbody");

function getPredikat(nilai){
  if(nilai >= 90) return "A";
  if(nilai >= 75) return "B";
  if(nilai >= 10) return "C";
  return "-";
}

function loadSiswa(){
  tbody.innerHTML = "";
  const siswa = dataSiswa[kelas.value]?.[jurusan.value];

  if(!siswa){
    tbody.innerHTML = `
      <tr>
        <td colspan="7" class="text-center text-muted py-4">
          Data siswa belum tersedia
        </td>
      </tr>`;
    return;
  }

  siswa.forEach((nama,i)=>{
    tbody.innerHTML += `
      <tr>
        <td class="text-center">${i+1}</td>
        <td>${nama}</td>
        <td class="text-center">${kelas.value}</td>
        <td class="text-center">${jurusan.value}</td>
        <td>
          <input type="number" min="10" max="100"
            class="form-control text-center"
            placeholder="0-100"
            oninput="updatePredikat(this)">
        </td>
        <td class="text-center predikat">-</td>
        <td>
          <textarea class="form-control"
            rows="2"
            placeholder="Tulis deskripsi penilaian..."></textarea>
        </td>
      </tr>`;
  });
}

function updatePredikat(input){
  const nilai = parseInt(input.value);
  const predikat = input.closest("tr").querySelector(".predikat");
  predikat.textContent = getPredikat(nilai);
}

function simpan(){
  alert("Penilaian berhasil disimpan ✅");
}

kelas.addEventListener("change", loadSiswa);
jurusan.addEventListener("change", loadSiswa);
</script>

</body>
</html>
