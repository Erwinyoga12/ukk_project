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
:root { --primary: #0fb9a8; --primary-dark: #0aa193; --bg: #eef1f4; }
body { margin: 0; font-family: Inter, Segoe UI, sans-serif; background: var(--bg); }
.sidebar{width:260px;height:100vh;background:var(--primary);position:fixed;display:flex;flex-direction:column;}
.sidebar-header{padding:22px;font-size:20px;font-weight:600;text-align:center;background:var(--primary-dark);color:#fff;}
.sidebar ul{list-style:none;padding:0;margin:16px 0;}
.sidebar li{padding:14px 26px;display:flex;gap:12px;align-items:center;color:#eaf2ff;cursor:pointer;transition:.2s;}
.sidebar li:hover{background:rgba(255,255,255,.15);}
.sidebar li.active{background:rgba(255,255,255,.3);border-left:4px solid #fff;font-weight:600;}
.sidebar .logout{margin-top:auto;background:rgba(0,0,0,.2);}
.content { margin-left: 260px; padding: 30px; }
.card { padding: 20px; border-radius: 12px; margin-bottom: 20px; border: none; box-shadow: 0 8px 20px rgba(0,0,0,.05); }
</style>
@stack('styles')
</head>
<body>

<!-- ===== SIDEBAR ===== -->
<aside class="sidebar">
  <div class="sidebar-header" id="eskulTitle">{{ strtoupper($eskul) }}</div>
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
      <input type="text" id="eskulInput" class="form-control" value="{{ $eskul }}" readonly>
    </div>
    <div class="col-md-4">
      <label>Kelas</label>
      <select id="kelas" class="form-control">
        <option value="">Pilih</option>
        @foreach($kelasOptions as $k)
          <option value="{{ $k }}">{{ $k }}</option>
        @endforeach
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
        <th>No</th><th>Nama</th><th>NIPD</th><th>Jurusan</th>
        <th>Nilai</th><th>Predikat</th><th>Deskripsi</th>
      </tr>
    </thead>
    <tbody id="tabel_siswa">
      <tr><td colspan="7" class="text-center">Pilih kelas dahulu</td></tr>
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
          <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Konfirmasi Logout
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Apakah Anda yakin ingin keluar?</div>
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
// ===== CONFIG =====
const eskulLogin = @json($eskul);
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// ===== LOGOUT =====
function showLogoutModal(){
  new bootstrap.Modal(document.getElementById('logoutModal')).show();
}

async function confirmLogout(){
  try {
    await fetch("/logout-eskul", {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": csrfToken,
        "Accept": "application/json"
      }
    });
    window.location.href = "/gin";
  } catch (e) {
    alert("Gagal logout");
  }
}

// ===== LOGIC NILAI =====
function getPredikat(nilai){
  const n = parseInt(nilai);
  if(n >= 85) return "A";
  if(n >= 75) return "B";
  if(n >= 60) return "C";
  if(n >= 10) return "D";
  return "E";
}

function updatePredikat(input){
  const row = input.closest("tr");
  const pred = row?.querySelector(".predikat");
  if(pred) pred.value = getPredikat(input.value);
}

// ===== LOAD DATA =====
async function loadData(){
  const kelas = document.getElementById("kelas").value;
  if(!kelas) { alert("Pilih kelas terlebih dahulu!"); return; }

  const btn = event?.target;
  if(btn) btn.disabled = true;

  try {
    const res = await fetch(`/eskul/data?eskul=${encodeURIComponent(eskulLogin)}&kelas=${kelas}`, {
      headers: { "Accept": "application/json" }
    });
    const data = await res.json();

    const tabel = document.getElementById("tabel_siswa");
    tabel.innerHTML = "";

    if(data.length === 0){
      tabel.innerHTML = `<tr><td colspan="7" class="text-center">Tidak ada data siswa</td></tr>`;
      return;
    }

    data.forEach((s,i)=>{
      tabel.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td class="nama">${s.nama_siswa}</td>
        <td class="nipd">${s.nipd}</td>
        <td class="jurusan">${s.jurusan}</td>
        <td><input type="number" class="form-control nilai" value="${s.nilai_lama ?? ''}" oninput="updatePredikat(this)"></td>
        <td><input type="text" class="form-control predikat" value="${s.predikat_lama ?? ''}" readonly></td>
        <td><input type="text" class="form-control deskripsi" value="${s.deskripsi_lama ?? ''}"></td>
      </tr>`;
    });
  } catch(e){
    console.error(e);
    alert("Gagal memuat data");
  } finally {
    if(btn) btn.disabled = false;
  }
}

// ===== SIMPAN DATA =====
async function simpanData(){
  const rows = document.querySelectorAll("#tabel_siswa tr");
  const data = [];

  rows.forEach(r=>{
    const nipd = r.querySelector(".nipd")?.innerText;
    if(nipd){
      const nilai = r.querySelector(".nilai").value;
      if(nilai !== "") { // Hanya kirim yang diisi
        data.push({
          nama_siswa: r.querySelector(".nama").innerText,
          nipd: nipd,
          jurusan: r.querySelector(".jurusan").innerText,
          nilai: nilai,
          predikat: r.querySelector(".predikat").value,
          deskripsi: r.querySelector(".deskripsi").value
        });
      }
    }
  });

  if(data.length === 0){ alert("Tidak ada data untuk disimpan"); return; }

  try {
    const res = await fetch("/eskul/simpan", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken,
        "Accept": "application/json"
      },
      body: JSON.stringify({
        eskul: eskulLogin,
        kelas: document.getElementById("kelas").value,
        data: data
      })
    });
    const result = await res.json();
    alert(result.message || "Data berhasil disimpan");
  } catch(e){
    console.error(e);
    alert("Gagal menyimpan data");
  }
}
</script>
@stack('scripts')
</body>
</html>