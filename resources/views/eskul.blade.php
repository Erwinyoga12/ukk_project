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

.sidebar ul{
  list-style:none;
  padding:0;
  margin:20px 0;
}

.sidebar a{
  text-decoration:none;
  color:inherit;
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
</style>
</head>

<body>

<!-- ===== SIDEBAR ===== -->
<aside class="sidebar">
  <div class="sidebar-header" id="eskulTitle">ESKUL</div>

  <ul>
    <li class="active">
      <i class="bi bi-pencil-square"></i> Penilaian
    </li>
    <li onclick="location.href='/prmkrekap'">
      <i class="bi bi-bar-chart"></i> Rekap Penilaian
    </li>
  </ul>

  <ul>
    <li class="logout" onclick="logout()">
      <i class="bi bi-box-arrow-right"></i> Logout
    </li>
  </ul>
</aside>

<!-- ===== MAIN ===== -->
<main class="main">

  <!-- FILTER -->
  <div class="card p-4 mb-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Eskul</label>
        <select id="eskul" class="form-select" disabled></select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Kelas</label>
        <select id="kelas" class="form-select">
          <option value="">Pilih Kelas</option>
          <option value="X">X</option>
          <option value="XI">XI</option>
        </select>
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

</main>

<script>
/* ==========================
   AUTH & INIT
========================== */
const eskulSelect = document.getElementById("eskul");
const kelasSelect = document.getElementById("kelas");
const tbody = document.getElementById("tbody");
const eskulTitle = document.getElementById("eskulTitle");

const eskulLogin = localStorage.getItem("eskul_login");
if(!eskulLogin){
  location.href = "login.html";
}

eskulSelect.innerHTML = `<option value="${eskulLogin}">${eskulLogin}</option>`;
eskulTitle.innerText = eskulLogin.toUpperCase();

/* ==========================
   DATA DUMMY (SIMULASI DB)
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

/* ==========================
   FUNCTION
========================== */
function getPredikat(nilai){
  if(nilai >= 90) return "A";
  if(nilai >= 80) return "B";
  if(nilai >= 70) return "C";
  return "D";
}

function renderTable(kelas){
  tbody.innerHTML = "";

  if(!dataSiswa[kelas]){
    tbody.innerHTML = `
      <tr>
        <td colspan="7" class="text-center text-muted">
          Data tidak tersedia
        </td>
      </tr>`;
    return;
  }

  dataSiswa[kelas].forEach((siswa, i)=>{
    tbody.innerHTML += `
      <tr>
        <td class="text-center">${i+1}</td>
        <td>${siswa.nama}</td>
        <td>${siswa.nipd}</td>
        <td>${siswa.jurusan}</td>
        <td>
          <input type="number" class="form-control nilai" min="0" max="100">
        </td>
        <td class="predikat text-center">-</td>
        <td>
          <input type="text" class="form-control" placeholder="Deskripsi">
        </td>
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

/* ==========================
   EVENT
========================== */
kelasSelect.addEventListener("change", ()=>{
  if(kelasSelect.value){
    renderTable(kelasSelect.value);
  }
});

function logout(){
  localStorage.removeItem("eskul_login");
  location.href = "login.html";
}
</script>

</body>
</html>
