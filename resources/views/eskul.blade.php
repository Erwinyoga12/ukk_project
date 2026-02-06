<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Penilaian Ekstrakurikuler</title>
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

.sidebar li{
  padding:14px 26px;
  display:flex;
  gap:12px;
  align-items:center;
  color:#eaf2ff;
}

.sidebar li.active{
  background:rgba(255,255,255,.3);
  font-weight:600;
  border-left:4px solid #fff;
}

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
</style>
</head>

<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-header">Eskul</div>
  <ul>
    <li class="active"><i class="bi bi-pencil-square"></i> Penilaian</li>
    <li><i class="bi bi-bar-chart"></i> Rekap Nilai</li>
    <li><i class="bi bi-people"></i> Anggota</li>
  </ul>
</aside>

<!-- MAIN -->
<main class="main">
  <div class="page-title">Penilaian Ekstrakurikuler</div>

  <!-- FILTER -->
  <div class="card p-4 mb-4">
    <div class="row g-3">
      <div class="col-md-6">
        <label class="fw-semibold">Eskul</label>
        <select id="eskul" class="form-select">
          <option value="">Pilih Eskul</option>
          <option value="pramuka">Pramuka</option>
          <option value="paskibra">Paskibra</option>
          <option value="pmr">PMR</option>
          <option value="natbinari">Natbinari</option>
          <option value="jurnal">Jurnal</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="fw-semibold">Kelas</label>
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
    <table class="table table-bordered">
      <thead>
        <tr class="text-center">
          <th width="50">No</th>
          <th>Nama Siswa</th>
          <th width="120">NIPD</th>
          <th width="120">Jurusan</th>
          <th width="100">Nilai</th>
          <th width="90">Predikat</th>
          <th>Deskripsi Penilaian</th>
        </tr>
      </thead>
      <tbody id="tbody">
        <tr>
          <td colspan="7" class="text-center text-muted py-4">
            Pilih eskul dan kelas terlebih dahulu
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
const dataSiswa = {
  pramuka:{
    X:[
      {nipd:"231001", nama:"Raka Pradana", jurusan:"RPL"},
      {nipd:"231002", nama:"Alya Putri", jurusan:"DKV"}
    ],
    XI:[
      {nipd:"221001", nama:"Kevin Saputra", jurusan:"RPL"},
      {nipd:"221002", nama:"Nadia Putri", jurusan:"DKV"}
    ]
  },
  paskibra:{
    X:[
      {nipd:"231010", nama:"Bima Aditya", jurusan:"TKJ"},
      {nipd:"231011", nama:"Salsa Anindya", jurusan:"RPL"}
    ],
    XI:[
      {nipd:"221010", nama:"Dimas Prakoso", jurusan:"TKJ"},
      {nipd:"221011", nama:"Putri Lestari", jurusan:"DKV"}
    ]
  },
  pmr:{
    X:[
      {nipd:"231020", nama:"Farhan Akbar", jurusan:"RPL"},
      {nipd:"231021", nama:"Nisa Rahma", jurusan:"DKV"}
    ],
    XI:[
      {nipd:"221020", nama:"Citra Lestari", jurusan:"RPL"},
      {nipd:"221021", nama:"Ilham Fauzi", jurusan:"TKJ"}
    ]
  },
  natbinari:{
    X:[
      {nipd:"231030", nama:"Yoga Pratama", jurusan:"TKJ"},
      {nipd:"231031", nama:"Rani Oktavia", jurusan:"DKV"}
    ],
    XI:[
      {nipd:"221030", nama:"Alif Ramadhan", jurusan:"RPL"},
      {nipd:"221031", nama:"Siti Aminah", jurusan:"DKV"}
    ]
  },
  jurnal:{
    X:[
      {nipd:"231040", nama:"Bagas Setiawan", jurusan:"RPL"},
      {nipd:"231041", nama:"Dewi Sartika", jurusan:"DKV"}
    ],
    XI:[
      {nipd:"221040", nama:"Fajar Nugroho", jurusan:"TKJ"},
      {nipd:"221041", nama:"Maya Salsabila", jurusan:"RPL"}
    ]
  }
};

const eskul = document.getElementById("eskul");
const kelas = document.getElementById("kelas");
const tbody = document.getElementById("tbody");

function getPredikat(nilai){
  if(nilai >= 90) return "A";
  if(nilai >= 75) return "B";
  if(nilai >= 10) return "C";
  return "-";
}

function loadSiswa(){
  tbody.innerHTML = "";
  const siswa = dataSiswa[eskul.value]?.[kelas.value];

  if(!siswa){
    tbody.innerHTML = `
      <tr>
        <td colspan="7" class="text-center text-muted py-4">
          Data siswa belum tersedia
        </td>
      </tr>`;
    return;
  }

  siswa.forEach((s,i)=>{
    tbody.innerHTML += `
      <tr>
        <td class="text-center">${i+1}</td>
        <td>${s.nama}</td>
        <td class="text-center">${s.nipd}</td>
        <td class="text-center">${s.jurusan}</td>
        <td>
          <input type="number" min="10" max="100"
            class="form-control text-center"
            oninput="this.parentElement.nextElementSibling.textContent=getPredikat(this.value)">
        </td>
        <td class="text-center">-</td>
        <td>
          <textarea class="form-control" rows="2"
            placeholder="Tulis deskripsi penilaian..."></textarea>
        </td>
      </tr>`;
  });
}

eskul.addEventListener("change", loadSiswa);
kelas.addEventListener("change", loadSiswa);
</script>

</body>
</html>
