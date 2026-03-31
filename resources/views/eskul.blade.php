<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Penilaian Eskul</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#eef1f4;font-family:sans-serif}
.sidebar{width:220px;height:100vh;background:#0fb9a8;position:fixed;color:#fff}
.sidebar h4{padding:20px}
.sidebar a{display:block;color:white;padding:12px 20px;text-decoration:none}
.sidebar a:hover{background:rgba(255,255,255,.2)}
.content{margin-left:220px;padding:30px}
.card{padding:20px;border-radius:10px;margin-bottom:20px}
</style>

</head>

<body>

<div class="sidebar">
<h4 id="eskulTitle"></h4>
<a href="#">Penilaian</a>
<a href="/prmkrekap">Rekap</a>
<a href="#" onclick="logout()">Logout</a>
</div>

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

<script>

const eskulLogin=localStorage.getItem("eskul_login")

if(!eskulLogin){
location.href="/"
}

document.getElementById("eskulTitle").innerText=eskulLogin.toUpperCase()
document.getElementById("eskulInput").value=eskulLogin

function getPredikat(nilai){

nilai=parseInt(nilai)

if(nilai>=85)return "A"
if(nilai>=75)return "B"
if(nilai>=10)return "C"

return ""

}

function updatePredikat(input){

let row=input.closest("tr")
let pred=row.querySelector(".predikat")
pred.value=getPredikat(input.value)

}

function loadData(){

let kelas=document.getElementById("kelas").value

fetch(`/eskul/data?eskul=${eskulLogin}&kelas=${kelas}`)
.then(res=>res.json())
.then(data=>{

let tabel=document.getElementById("tabel_siswa")
tabel.innerHTML=""

data.forEach((s,i)=>{

tabel.innerHTML+=`

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

let rows=document.querySelectorAll("#tabel_siswa tr")
let data=[]

rows.forEach(r=>{

let nipd=r.querySelector(".nipd")?.innerText

if(nipd){

data.push({

nama_siswa:r.querySelector(".nama").innerText,
nipd:nipd,
jurusan:r.querySelector(".jurusan").innerText,
nilai:r.querySelector(".nilai").value,
predikat:r.querySelector(".predikat").value,
deskripsi:r.querySelector(".deskripsi").value

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

function logout(){

localStorage.removeItem("eskul_login")
location.href="/"

}

</script>

</body>
</html>
