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
body { margin: 0; font-family: Inter, 'Segoe UI', sans-serif; background: var(--bg); }
.sidebar { width: 260px; height: 100vh; background: var(--primary); position: fixed; display: flex; flex-direction: column; }
.sidebar-header { padding: 22px; font-size: 20px; font-weight: 600; text-align: center; background: var(--primary-dark); color: #fff; }
.sidebar ul { list-style: none; padding: 0; margin: 16px 0; }
.sidebar li { padding: 14px 26px; display: flex; gap: 12px; align-items: center; color: #eaf2ff; cursor: pointer; transition: .2s; }
.sidebar li:hover { background: rgba(255,255,255,.15); }
.sidebar li.active { background: rgba(255,255,255,.3); border-left: 4px solid #fff; font-weight: 600; }
.sidebar .logout { margin-top: auto; background: rgba(0,0,0,.2); }
.content { margin-left: 260px; padding: 30px; }
.card { padding: 20px; border-radius: 12px; margin-bottom: 20px; border: none; box-shadow: 0 8px 20px rgba(0,0,0,.05); }

/* ========== TOAST NOTIFICATION ========== */
#toast-container {
    position: fixed;
    top: 24px;
    right: 24px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    pointer-events: none;
}
.toast-notif {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 10px;
    border: 0.5px solid;
    width: 320px;
    pointer-events: all;
    animation: toastIn .3s cubic-bezier(.21,1.02,.73,1) forwards;
    box-shadow: 0 4px 16px rgba(0,0,0,.08);
}
.toast-notif.hiding {
    animation: toastOut .25s ease forwards;
}
@keyframes toastIn {
    from { opacity: 0; transform: translateX(20px); }
    to   { opacity: 1; transform: translateX(0); }
}
@keyframes toastOut {
    from { opacity: 1; transform: translateX(0); }
    to   { opacity: 0; transform: translateX(20px); }
}
.toast-success { background: #EAF3DE; border-color: #97C459; }
.toast-success .toast-title { color: #27500A; }
.toast-success .toast-body  { color: #3B6D11; }
.toast-success .toast-bar   { background: #639922; }
.toast-error { background: #FCEBEB; border-color: #F09595; }
.toast-error .toast-title { color: #791F1F; }
.toast-error .toast-body  { color: #A32D2D; }
.toast-loading { background: #E6F1FB; border-color: #85B7EB; }
.toast-loading .toast-title { color: #0C447C; }
.toast-loading .toast-body  { color: #185FA5; }
.toast-notif .t-icon { flex-shrink: 0; margin-top: 1px; }
.toast-notif .t-content { flex: 1; min-width: 0; }
.toast-title { font-size: 13px; font-weight: 600; margin-bottom: 3px; }
.toast-body  { font-size: 12px; line-height: 1.6; }
.toast-bar-wrap { height: 3px; background: rgba(0,0,0,.08); border-radius: 2px; margin-top: 8px; overflow: hidden; }
.toast-bar { height: 100%; border-radius: 2px; animation: shrinkBar 3s linear forwards; }
@keyframes shrinkBar { from { width: 100%; } to { width: 0%; } }
.spin { animation: spin .8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
/* ========================================= */
</style>
@stack('styles')
</head>
<body>

<!-- ===== TOAST CONTAINER ===== -->
<div id="toast-container"></div>

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
const eskulLogin  = @json($eskul);
const csrfToken   = document.querySelector('meta[name="csrf-token"]').content;
const toastContainer = document.getElementById('toast-container');

// ============================================================
// TOAST SYSTEM
// ============================================================
function showToast(type, title, message, duration = 3500) {
    const toast = document.createElement('div');
    toast.className = `toast-notif toast-${type}`;

    const icons = {
        success: `<svg class="t-icon" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <circle cx="9" cy="9" r="7.5" stroke="#3B6D11" stroke-width="1.25"/>
                    <path d="M5.5 9l2.5 2.5 4.5-4.5" stroke="#3B6D11" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>`,
        error:   `<svg class="t-icon" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <circle cx="9" cy="9" r="7.5" stroke="#A32D2D" stroke-width="1.25"/>
                    <rect x="8.1875" y="4.5" width="1.625" height="5.5" rx=".8" fill="#A32D2D"/>
                    <circle cx="9" cy="13" r=".875" fill="#A32D2D"/>
                  </svg>`,
        loading: `<svg class="t-icon spin" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <circle cx="9" cy="9" r="7.5" stroke="#85B7EB" stroke-width="1.25"/>
                    <path d="M9 1.5A7.5 7.5 0 0 1 16.5 9" stroke="#185FA5" stroke-width="1.5" stroke-linecap="round"/>
                  </svg>`
    };

    const barHTML = type === 'success'
        ? `<div class="toast-bar-wrap"><div class="toast-bar"></div></div>`
        : '';

    toast.innerHTML = `
        ${icons[type]}
        <div class="t-content">
            <div class="toast-title">${title}</div>
            <div class="toast-body">${message}</div>
            ${barHTML}
        </div>
    `;

    toastContainer.appendChild(toast);

    if (type !== 'loading') {
        setTimeout(() => dismissToast(toast), duration);
    }

    return toast;
}

function dismissToast(toast) {
    if (!toast || !toast.parentNode) return;
    toast.classList.add('hiding');
    setTimeout(() => toast.remove(), 260);
}
// ============================================================

// ===== LOGOUT =====
function showLogoutModal() {
    new bootstrap.Modal(document.getElementById('logoutModal')).show();
}

async function confirmLogout() {
    try {
        await fetch("/logout-eskul", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": csrfToken, "Accept": "application/json" }
        });

        // Reset tabel dan pilihan kelas
        document.getElementById("tabel_siswa").innerHTML =
            `<tr><td colspan="7" class="text-center">Pilih kelas dahulu</td></tr>`;
        document.getElementById("kelas").value = "";

        window.location.href = "/gin";
    } catch (e) {
        alert("Gagal logout");
    }
}

// ===== LOGIC NILAI =====
function getPredikat(nilai) {
    const n = parseInt(nilai);
    if (n >= 85) return "A";
    if (n >= 75) return "B";
    if (n >= 60) return "C";
    if (n >= 10) return "D";
    return "E";
}

function updatePredikat(input) {
    const row = input.closest("tr");
    const pred = row?.querySelector(".predikat");
    if (pred) pred.value = getPredikat(input.value);
}

// ===== LOAD DATA =====
async function loadData() {
    const kelas = document.getElementById("kelas").value;
    if (!kelas) {
        showToast('error', 'Kelas belum dipilih', 'Silakan pilih kelas terlebih dahulu sebelum mencari data.');
        return;
    }

    const btn = event?.target;
    if (btn) btn.disabled = true;

    const loadingToast = showToast('loading', 'Memuat data...', `Mengambil data siswa kelas ${kelas}.`);

    try {
        const res  = await fetch(`/eskul/data?eskul=${encodeURIComponent(eskulLogin)}&kelas=${kelas}`, {
            headers: { "Accept": "application/json" }
        });
        const data = await res.json();

        dismissToast(loadingToast);

        const tabel = document.getElementById("tabel_siswa");
        tabel.innerHTML = "";

        if (data.length === 0) {
            tabel.innerHTML = `<tr><td colspan="7" class="text-center">Tidak ada data siswa</td></tr>`;
            showToast('error', 'Data tidak ditemukan', `Tidak ada siswa terdaftar di kelas ${kelas}.`);
            return;
        }

        data.forEach((s, i) => {
            tabel.innerHTML += `
            <tr>
                <td>${i + 1}</td>
                <td class="nama">${s.nama_siswa}</td>
                <td class="nipd">${s.nipd}</td>
                <td class="jurusan">${s.jurusan}</td>
                <td><input type="number" class="form-control nilai" value="${s.nilai_lama ?? ''}" oninput="updatePredikat(this)"></td>
                <td><input type="text" class="form-control predikat" value="${s.predikat_lama ?? ''}" readonly></td>
                <td><input type="text" class="form-control deskripsi" value="${s.deskripsi_lama ?? ''}"></td>
            </tr>`;
        });

        showToast('success', 'Data berhasil dimuat', `${data.length} siswa kelas ${kelas} ditemukan.`);

    } catch (e) {
        console.error(e);
        dismissToast(loadingToast);
        showToast('error', 'Gagal memuat data', 'Tidak dapat terhubung ke server. Periksa koneksi dan coba lagi.');
    } finally {
        if (btn) btn.disabled = false;
    }
}

// ===== SIMPAN DATA =====
async function simpanData() {
    const rows = document.querySelectorAll("#tabel_siswa tr");
    const kelas = document.getElementById("kelas").value;
    const data  = [];

    rows.forEach(r => {
        const nipd = r.querySelector(".nipd")?.innerText;
        if (nipd) {
            const nilai = r.querySelector(".nilai").value;
            if (nilai !== "") {
                data.push({
                    nama_siswa: r.querySelector(".nama").innerText,
                    nipd:       nipd,
                    jurusan:    r.querySelector(".jurusan").innerText,
                    nilai:      nilai,
                    predikat:   r.querySelector(".predikat").value,
                    deskripsi:  r.querySelector(".deskripsi").value
                });
            }
        }
    });

    if (data.length === 0) {
        showToast('error', 'Tidak ada data', 'Isi minimal satu nilai siswa sebelum menyimpan.');
        return;
    }

    try {
        const res    = await fetch("/eskul/simpan", {
            method: "POST",
            headers: {
                "Content-Type":  "application/json",
                "X-CSRF-TOKEN":  csrfToken,
                "Accept":        "application/json"
            },
            body: JSON.stringify({ eskul: eskulLogin, kelas, data })
        });
        const result = await res.json();

        if (res.ok) {
            showToast('success', 'Data berhasil disimpan', `${data.length} nilai siswa kelas ${kelas} tersimpan ke database.`);
        } else {
            showToast('error', 'Gagal menyimpan', result.message || 'Terjadi kesalahan pada server.');
        }

    } catch (e) {
        console.error(e);
        showToast('error', 'Gagal menyimpan', 'Tidak dapat terhubung ke server. Periksa koneksi dan coba lagi.');
    }
}
</script>
@stack('scripts')
</body>
</html>