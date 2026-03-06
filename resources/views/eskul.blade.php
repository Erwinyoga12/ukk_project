<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Penilaian Ekstrakurikuler</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#eef1f4;
font-family:sans-serif;
}

.sidebar{
width:220px;
height:100vh;
background:linear-gradient(#19b39b,#0f9d8a);
position:fixed;
color:white;
}

.sidebar h4{
padding:20px;
font-weight:bold;
}

.sidebar a{
display:block;
padding:15px 20px;
color:white;
text-decoration:none;
}

.sidebar a:hover{
background:rgba(255,255,255,0.15);
}

.content{
margin-left:220px;
padding:30px;
}

.card-box{
background:white;
border-radius:10px;
padding:20px;
box-shadow:0 2px 5px rgba(0,0,0,0.05);
margin-bottom:20px;
}

</style>
</head>

<body>

<div class="sidebar">
<h4>PRAMUKA</h4>
<a href="#">Penilaian</a>
<a href="#">Rekap Penilaian</a>
<a href="#">Logout</a>
</div>


<div class="content">

<div class="card-box">
<h4>Penilaian Ekstrakurikuler</h4>
<p class="text-muted">Silakan pilih kelas untuk mulai menilai</p>
</div>


<div class="card-box">

<div class="row">

<div class="col-md-4">
<label>Eskul</label>
<input type="text" class="form-control" value="pramuka" readonly>
</div>

<div class="col-md-4">
<label>Kelas</label>
<select id="kelas" class="form-control">
<option value="">Pilih Kelas</option>
<option value="X">Kelas X</option>
<option value="XI">Kelas XI</option>
</select>
</div>

<div class="col-md-4 d-flex align-items-end gap-2">

<button onclick="loadData()" class="btn btn-primary">
Cari Data
</button>

<button onclick="simpanData()" class="btn btn-success">
Simpan Nilai
</button>

</div>

</div>

</div>


<div class="card-box">

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
<td colspan="7" class="text-center">
Pilih kelas terlebih dahulu
</td>
</tr>

</tbody>

</table>

</div>

</div>


<script>

function getPredikat(nilai){

nilai = parseInt(nilai)

if(isNaN(nilai)){
return ""
}

if(nilai >= 85){
return "A"
}

if(nilai >= 75){
return "B"
}

if(nilai >= 10){
return "C"
}

return ""

}



function updatePredikat(input){

let nilai = input.value
let row = input.closest("tr")
let predikat = row.querySelector(".predikat")

predikat.value = getPredikat(nilai)

}



function loadData(){

let kelas = document.getElementById("kelas").value
let eskul = "pramuka"

fetch(`/eskul/data?eskul=${eskul}&kelas=${kelas}`)
.then(res => res.json())
.then(data => {

let tabel = document.getElementById("tabel_siswa")
tabel.innerHTML = ""

data.forEach((siswa,index)=>{

tabel.innerHTML += `
<tr>

<td>${index+1}</td>

<td class="nama_siswa">${siswa.nama_siswa}</td>

<td class="nipd">${siswa.nipd}</td>

<td class="jurusan">${siswa.jurusan}</td>

<td>
<input type="number"
class="form-control nilai"
oninput="updatePredikat(this)">
</td>

<td>
<input type="text"
class="form-control predikat"
readonly>
</td>

<td>
<input type="text"
class="form-control deskripsi">
</td>

</tr>
`

})

})

}



function simpanData(){

let rows = document.querySelectorAll("#tabel_siswa tr")

let data = []

rows.forEach(row => {

let nama = row.querySelector(".nama_siswa")?.innerText
let nipd = row.querySelector(".nipd")?.innerText
let jurusan = row.querySelector(".jurusan")?.innerText
let nilai = row.querySelector(".nilai")?.value
let predikat = row.querySelector(".predikat")?.value
let deskripsi = row.querySelector(".deskripsi")?.value

if(nipd){

data.push({
nama_siswa:nama,
nipd:nipd,
jurusan:jurusan,
nilai:nilai,
predikat:predikat,
deskripsi:deskripsi
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
eskul:"pramuka",
kelas:document.getElementById("kelas").value,
data:data
})

})
.then(res=>res.json())
.then(res=>{
alert("Nilai berhasil disimpan")
})

}

</script>

</body>
</html>