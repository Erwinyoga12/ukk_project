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
font-family: sans-serif;
}

/* SIDEBAR */

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

/* CONTENT */

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

<!-- SIDEBAR -->
<div class="sidebar">

<h4>PRAMUKA</h4>

<a href="#">Penilaian</a>
<a href="#">Rekap Penilaian</a>
<a href="#">Logout</a>

</div>


<!-- CONTENT -->
<div class="content">

<div class="card-box">
<h4>Penilaian Ekstrakurikuler</h4>
<p class="text-muted">Silakan pilih kelas untuk mulai menilai</p>
</div>


<div class="card-box">

<div class="row">

<div class="col-md-4">
<label>Eskul</label>
<select id="eskul" class="form-control">
<option value="pramuka">Pramuka</option>
</select>
</div>

<div class="col-md-4">
<label>Kelas</label>
<select id="kelas" class="form-control">
<option value="">Pilih Kelas</option>
<option value="X">Kelas X</option>
<option value="XI">Kelas XI</option>
<option value="XII">Kelas XII</option>
</select>
</div>

<div class="col-md-4 d-flex align-items-end">
<button onclick="loadData()" class="btn btn-success">
Simpan
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

function loadData(){

let eskul = document.getElementById("eskul").value
let kelas = document.getElementById("kelas").value

fetch(`/eskul/data?eskul=${eskul}&kelas=${kelas}`)
.then(res => res.json())
.then(data => {

let tabel = document.getElementById("tabel_siswa")
tabel.innerHTML = ""

data.forEach((siswa,index)=>{

tabel.innerHTML += `
<tr>
<td>${index+1}</td>
<td>${siswa.nama_siswa}</td>
<td>${siswa.nipd}</td>
<td>${siswa.jurusan}</td>

<td>
<input type="number" class="form-control" name="nilai[]">
</td>

<td>
<select class="form-control" name="predikat[]">
<option>A</option>
<option>B</option>
<option>C</option>
<option>D</option>
</select>
</td>

<td>
<input type="text" class="form-control" name="deskripsi[]">
</td>

</tr>
`

})

})

}

</script>


</body>
</html>