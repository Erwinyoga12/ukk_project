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
    --locked-bg: rgba(59,109,17,.07);
    --editing-bg: rgba(24,95,165,.06);
}

/* ── Layout ── */
body { margin: 0; font-family: 'Segoe UI', Inter, sans-serif; background: var(--bg); }
.sidebar {
    width: 260px; height: 100vh; background: var(--primary);
    position: fixed; display: flex; flex-direction: column; z-index: 100;
}
.sidebar-header {
    padding: 22px; font-size: 20px; font-weight: 700; text-align: center;
    background: var(--primary-dark); color: #fff; letter-spacing: .5px;
}
.sidebar ul { list-style: none; padding: 0; margin: 16px 0; }
.sidebar li {
    padding: 14px 26px; display: flex; gap: 12px; align-items: center;
    color: #eaf2ff; cursor: pointer; transition: .2s; font-size: 15px;
}
.sidebar li:hover { background: rgba(255,255,255,.15); }
.sidebar li.active { background: rgba(255,255,255,.3); border-left: 4px solid #fff; font-weight: 600; }
.sidebar .logout { margin-top: auto; background: rgba(0,0,0,.18); }
.content { margin-left: 260px; padding: 28px 32px; }

/* ── Cards ── */
.card {
    padding: 22px 24px; border-radius: 14px; margin-bottom: 20px;
    border: none; box-shadow: 0 4px 18px rgba(0,0,0,.06); background: #fff;
}
.card h4 { font-weight: 700; color: #1a1a2e; margin-bottom: 4px; }
.card .text-muted { font-size: 14px; }

/* ── Form controls ── */
.form-control, .form-select { border-radius: 8px; border: 1px solid #d8dde6; font-size: 14px; }
.form-control:focus, .form-select:focus {
    border-color: var(--primary); box-shadow: 0 0 0 3px rgba(15,185,168,.15);
}
.btn { border-radius: 8px; font-size: 14px; font-weight: 500; }
.btn-primary { background: var(--primary); border-color: var(--primary); }
.btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }

/* ── Table ── */
.table-wrap { overflow-x: auto; }
.tbl { width: 100%; border-collapse: collapse; font-size: 13.5px; }
.tbl thead th {
    padding: 11px 12px; text-align: left; font-weight: 600; font-size: 12px;
    color: #6b7280; background: #f9fafb; border-bottom: 2px solid #e5e7eb;
    white-space: nowrap;
}
.tbl tbody td { padding: 8px 10px; border-bottom: 1px solid #f0f2f5; vertical-align: middle; }
.tbl tbody tr:last-child td { border-bottom: none; }

/* ── Row states ── */
.tbl tbody tr { transition: background .25s; }
.row-empty   { background: #fff; }
.row-locked  { background: var(--locked-bg); }
.row-editing { background: var(--editing-bg); }

/* ── Inline inputs ── */
.inp-tbl {
    border: 1px solid #d8dde6; border-radius: 7px; padding: 5px 8px;
    font-size: 13px; width: 100%; background: #fff; color: #111;
    transition: border-color .2s, background .2s;
}
.inp-tbl:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 2px rgba(15,185,168,.18); }
.inp-tbl:disabled {
    background: transparent; border-color: transparent; color: #111;
    -webkit-text-fill-color: #111; opacity: 1; cursor: default;
    font-weight: 500;
}
.inp-tbl.inp-pred { width: 56px; text-align: center; font-weight: 600; }
.inp-tbl.inp-desk { min-width: 140px; }
.inp-tbl.inp-nilai { width: 72px; }
.inp-tbl:disabled.inp-pred { color: #27500a; -webkit-text-fill-color: #27500a; }

/* ── Status badges ── */
.badge-status {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 10px; border-radius: 20px; font-size: 11px;
    font-weight: 600; white-space: nowrap; border: 1px solid;
}
.bs-empty   { background: #f3f4f6; color: #6b7280; border-color: #d1d5db; }
.bs-locked  { background: #eaf3de; color: #27500a; border-color: #97c459; }
.bs-editing { background: #e6f1fb; color: #0c447c; border-color: #85b7eb; }

/* ── Action buttons ── */
.btn-act {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 11px; border-radius: 7px; font-size: 12px;
    font-weight: 500; cursor: pointer; border: 1px solid;
    transition: filter .15s, transform .1s; white-space: nowrap;
}
.btn-act:active { transform: scale(.96); }
.btn-edit   { background: #fffbeb; border-color: #f59e0b; color: #92400e; }
.btn-edit:hover { filter: brightness(.94); }
.btn-save   { background: #ecfdf5; border-color: #34d399; color: #065f46; }
.btn-save:hover { filter: brightness(.94); }
.btn-cancel { background: #f9fafb; border-color: #d1d5db; color: #6b7280; }
.btn-cancel:hover { filter: brightness(.94); }
.act-wrap { display: flex; gap: 6px; align-items: center; }

/* ── Counter bar ── */
.counter-bar {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 14px; gap: 12px; flex-wrap: wrap;
}
.counter-text { font-size: 13px; color: #6b7280; }
.counter-pill {
    font-size: 12px; font-weight: 600; padding: 4px 12px;
    border-radius: 20px; background: #eaf3de; color: #27500a;
    border: 1px solid #97c459;
}
.progress-bar-wrap {
    height: 5px; background: #e5e7eb; border-radius: 4px;
    margin-bottom: 18px; overflow: hidden;
}
.progress-bar-fill {
    height: 100%; background: linear-gradient(90deg, var(--primary) 0%, #34d399 100%);
    border-radius: 4px; transition: width .4s ease;
}

/* ── NIPD cell ── */
.nipd-cell { font-family: 'Courier New', monospace; font-size: 12px; color: #9ca3af; }
.no-cell   { color: #d1d5db; font-size: 12px; width: 28px; }

/* ── Empty state ── */
.empty-state {
    padding: 48px 20px; text-align: center; color: #9ca3af;
}
.empty-state i { font-size: 40px; display: block; margin-bottom: 10px; }

/* ── Toast ── */
#toast-container {
    position: fixed; top: 24px; right: 24px; z-index: 9999;
    display: flex; flex-direction: column; gap: 10px; pointer-events: none;
}
.toast-notif {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 14px 16px; border-radius: 12px; border: 1px solid;
    width: 320px; pointer-events: all;
    animation: toastIn .3s cubic-bezier(.21,1.02,.73,1) forwards;
    box-shadow: 0 8px 24px rgba(0,0,0,.09);
}
.toast-notif.hiding { animation: toastOut .25s ease forwards; }
@keyframes toastIn  { from{opacity:0;transform:translateX(20px)} to{opacity:1;transform:none} }
@keyframes toastOut { from{opacity:1;transform:none} to{opacity:0;transform:translateX(20px)} }
.toast-success { background:#eaf3de; border-color:#97c459; }
.toast-success .toast-title { color:#27500a; }
.toast-success .toast-body  { color:#3b6d11; }
.toast-error   { background:#fcebeb; border-color:#f09595; }
.toast-error .toast-title   { color:#791f1f; }
.toast-error .toast-body    { color:#a32d2d; }
.toast-loading { background:#e6f1fb; border-color:#85b7eb; }
.toast-loading .toast-title { color:#0c447c; }
.toast-loading .toast-body  { color:#185fa5; }
.toast-title { font-size:13px; font-weight:700; margin-bottom:3px; }
.toast-body  { font-size:12px; line-height:1.6; }
.toast-bar-wrap { height:3px; background:rgba(0,0,0,.08); border-radius:2px; margin-top:8px; overflow:hidden; }
.toast-bar { height:100%; background:#639922; border-radius:2px; animation:shrinkBar 3.5s linear forwards; }
@keyframes shrinkBar { from{width:100%} to{width:0} }
.spin { animation: spin .8s linear infinite; }
@keyframes spin { to{transform:rotate(360deg)} }
</style>
</head>
<body>

<div id="toast-container"></div>

<!-- ── Sidebar ── -->
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

<!-- ── Main Content ── -->
<div class="content">

    <!-- Header card -->
    <div class="card">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h4 class="mb-1">Penilaian Ekskul</h4>
                <p class="text-muted mb-0">Pilih kelas untuk mulai penilaian siswa</p>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="badge-status bs-locked" style="font-size:12px; padding:5px 14px;">
                    <i class="bi bi-shield-lock"></i> Nilai tersimpan terkunci otomatis
                </span>
            </div>
        </div>
    </div>

    <!-- Filter card -->
    <div class="card">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size:13px;">Eskul</label>
                <input type="text" id="eskulInput" class="form-control" value="{{ $eskul }}" readonly
                       style="background:#f9fafb; color:#6b7280;">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-semibold" style="font-size:13px;">Kelas</label>
                <select id="kelas" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelasOptions as $k)
                        <option value="{{ $k }}">{{ $k }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button onclick="loadData(event)" class="btn btn-primary flex-fill">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
                <button onclick="simpanData()" class="btn btn-success flex-fill">
                    <i class="bi bi-floppy me-1"></i> Simpan Semua
                </button>
            </div>
        </div>
    </div>

    <!-- Table card -->
    <div class="card">

        <!-- Counter + progress -->
        <div class="counter-bar" id="counterBar" style="display:none!important">
            <span class="counter-text" id="counterText">0 dari 0 siswa sudah dinilai</span>
            <span class="counter-pill" id="counterPill">0%</span>
        </div>
        <div class="progress-bar-wrap" id="progressWrap" style="display:none">
            <div class="progress-bar-fill" id="progressFill" style="width:0%"></div>
        </div>

        <!-- Legend -->
        <div id="legendRow" style="display:none; margin-bottom:14px; display:none; gap:12px; flex-wrap:wrap;">
            <span class="badge-status bs-locked"><i class="bi bi-lock-fill"></i> Terkunci</span>
            <span class="badge-status bs-editing"><i class="bi bi-pencil"></i> Sedang diedit</span>
            <span class="badge-status bs-empty"><i class="bi bi-circle"></i> Belum diisi</span>
        </div>

        <!-- Table -->
        <div class="table-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="width:32px">No</th>
                        <th>Nama Siswa</th>
                        <th style="width:72px">NIPD</th>
                        <th style="width:100px">Jurusan</th>
                        <th style="width:80px">Nilai</th>
                        <th style="width:70px">Predikat</th>
                        <th style="min-width:160px">Deskripsi</th>
                        <th style="width:96px">Status</th>
                        <th style="width:160px">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabel_siswa">
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <i class="bi bi-search"></i>
                                Pilih kelas terlebih dahulu untuk memuat data siswa
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- ── Logout Modal ── -->
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:14px; border:none; box-shadow:0 20px 60px rgba(0,0,0,.15);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Konfirmasi Logout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="color:#6b7280; font-size:14px;">
                Apakah Anda yakin ingin keluar dari sesi ini?
            </div>
            <div class="modal-footer border-0 pt-0">
                <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger btn-sm" onclick="confirmLogout()">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const eskulLogin = @json($eskul);
const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;

/* ─────────────────────────────────────────────
   TOAST SYSTEM
───────────────────────────────────────────── */
const toastContainer = document.getElementById('toast-container');

function showToast(type, title, message, duration = 3500) {
    const el = document.createElement('div');
    el.className = `toast-notif toast-${type}`;

    const icons = {
        success: `<svg width="18" height="18" viewBox="0 0 18 18" fill="none" style="flex-shrink:0;margin-top:1px">
                    <circle cx="9" cy="9" r="7.5" stroke="#3B6D11" stroke-width="1.25"/>
                    <path d="M5.5 9l2.5 2.5 4.5-4.5" stroke="#3B6D11" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>`,
        error:   `<svg width="18" height="18" viewBox="0 0 18 18" fill="none" style="flex-shrink:0;margin-top:1px">
                    <circle cx="9" cy="9" r="7.5" stroke="#A32D2D" stroke-width="1.25"/>
                    <rect x="8.19" y="4.5" width="1.62" height="5.5" rx=".8" fill="#A32D2D"/>
                    <circle cx="9" cy="13" r=".875" fill="#A32D2D"/>
                  </svg>`,
        loading: `<svg class="spin" width="18" height="18" viewBox="0 0 18 18" fill="none" style="flex-shrink:0;margin-top:1px">
                    <circle cx="9" cy="9" r="7.5" stroke="#85B7EB" stroke-width="1.25"/>
                    <path d="M9 1.5A7.5 7.5 0 0 1 16.5 9" stroke="#185FA5" stroke-width="1.5" stroke-linecap="round"/>
                  </svg>`
    };

    el.innerHTML = `
        ${icons[type]}
        <div style="flex:1;min-width:0">
            <div class="toast-title">${title}</div>
            <div class="toast-body">${message}</div>
            ${type === 'success' ? '<div class="toast-bar-wrap"><div class="toast-bar"></div></div>' : ''}
        </div>`;

    toastContainer.appendChild(el);
    if (type !== 'loading') setTimeout(() => dismissToast(el), duration);
    return el;
}

function dismissToast(el) {
    if (!el || !el.parentNode) return;
    el.classList.add('hiding');
    setTimeout(() => el.remove(), 260);
}

/* ─────────────────────────────────────────────
   NILAI LOGIC
───────────────────────────────────────────── */
function getPredikat(nilai) {
    const n = parseInt(nilai);
    if (n >= 85) return 'A';
    if (n >= 75) return 'B';
    if (n >= 60) return 'C';
    if (n >= 10) return 'D';
    return 'E';
}

/* ─────────────────────────────────────────────
   ROW STATE MACHINE
   States: 'empty' | 'locked' | 'editing'
───────────────────────────────────────────── */

// Snapshot sebelum edit (untuk cancel)
const snapshots = {};

function getRow(idx) {
    return document.getElementById(`row-${idx}`);
}

function setRowState(idx, state) {
    const row = getRow(idx);
    if (!row) return;

    const nilai   = row.querySelector('.r-nilai');
    const pred    = row.querySelector('.r-pred');
    const desk    = row.querySelector('.r-desk');
    const badge   = row.querySelector('.r-badge');
    const actWrap = row.querySelector('.r-act');

    // Reset row class
    row.className = `row-${state}`;

    const isLocked  = state === 'locked';
    const isEditing = state === 'editing';
    const isEmpty   = state === 'empty';

    // Enable / disable inputs
    nilai.disabled = isLocked;
    pred.disabled  = isLocked;
    desk.disabled  = isLocked;

    // Badge
    if (isLocked) {
        badge.className = 'badge-status bs-locked r-badge';
        badge.innerHTML = '<i class="bi bi-lock-fill"></i> Terkunci';
    } else if (isEditing) {
        badge.className = 'badge-status bs-editing r-badge';
        badge.innerHTML = '<i class="bi bi-pencil"></i> Sedang edit';
    } else {
        badge.className = 'badge-status bs-empty r-badge';
        badge.innerHTML = '<i class="bi bi-circle"></i> Belum diisi';
    }

    // Action buttons
    if (isLocked) {
        actWrap.innerHTML = `
            <button class="btn-act btn-edit" onclick="startEdit(${idx})">
                <i class="bi bi-pencil" style="font-size:11px"></i> Edit
            </button>`;
    } else if (isEditing) {
        actWrap.innerHTML = `
            <button class="btn-act btn-save" onclick="saveRow(${idx})">
                <i class="bi bi-check-lg" style="font-size:11px"></i> Simpan
            </button>
            <button class="btn-act btn-cancel" onclick="cancelRow(${idx})">
                <i class="bi bi-x-lg" style="font-size:11px"></i>
            </button>`;
    } else {
        actWrap.innerHTML = `<span style="font-size:12px;color:#d1d5db;">—</span>`;
    }
}

function startEdit(idx) {
    const row = getRow(idx);
    // Simpan snapshot sebelum edit
    snapshots[idx] = {
        nilai: row.querySelector('.r-nilai').value,
        pred:  row.querySelector('.r-pred').value,
        desk:  row.querySelector('.r-desk').value,
    };
    setRowState(idx, 'editing');
    row.querySelector('.r-nilai').focus();
}

function saveRow(idx) {
    const row   = getRow(idx);
    const nilai = row.querySelector('.r-nilai').value.trim();
    const desk  = row.querySelector('.r-desk').value.trim();

    if (!nilai) {
        showToast('error', 'Nilai kosong', 'Isi nilai terlebih dahulu sebelum menyimpan baris ini.');
        row.querySelector('.r-nilai').focus();
        return;
    }

    // Update predikat
    row.querySelector('.r-pred').value = getPredikat(nilai);

    setRowState(idx, 'locked');
    updateCounter();
    showToast('success', 'Baris tersimpan', `Data siswa berhasil dikunci.`);
}

function cancelRow(idx) {
    const snap = snapshots[idx];
    if (!snap) return;
    const row = getRow(idx);
    row.querySelector('.r-nilai').value = snap.nilai;
    row.querySelector('.r-pred').value  = snap.pred;
    row.querySelector('.r-desk').value  = snap.desk;

    const state = snap.nilai ? 'locked' : 'empty';
    setRowState(idx, state);
}

/* ─────────────────────────────────────────────
   COUNTER & PROGRESS
───────────────────────────────────────────── */
function updateCounter() {
    const rows = document.querySelectorAll('#tabel_siswa tr[id^="row-"]');
    const total  = rows.length;
    const filled = [...rows].filter(r => {
        const v = r.querySelector('.r-nilai')?.value?.trim();
        return v && v !== '';
    }).length;

    document.getElementById('counterText').textContent =
        `${filled} dari ${total} siswa sudah dinilai`;
    const pct = total ? Math.round(filled / total * 100) : 0;
    document.getElementById('counterPill').textContent = `${pct}%`;
    document.getElementById('progressFill').style.width = `${pct}%`;
}

/* ─────────────────────────────────────────────
   LOAD DATA
───────────────────────────────────────────── */
async function loadData(event) {
    const kelas = document.getElementById('kelas').value;
    if (!kelas) {
        showToast('error', 'Kelas belum dipilih', 'Pilih kelas terlebih dahulu.');
        return;
    }

    const btn = event?.target?.closest('button');
    if (btn) btn.disabled = true;

    const loading = showToast('loading', 'Memuat data...', `Mengambil data siswa kelas ${kelas}.`);

    try {
        const res  = await fetch(`/eskul/data?eskul=${encodeURIComponent(eskulLogin)}&kelas=${encodeURIComponent(kelas)}`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();

        dismissToast(loading);

        const tbody = document.getElementById('tabel_siswa');
        tbody.innerHTML = '';

        if (!data.length) {
            tbody.innerHTML = `<tr><td colspan="9">
                <div class="empty-state">
                    <i class="bi bi-person-x"></i>
                    Tidak ada siswa di kelas ${kelas}
                </div></td></tr>`;
            showToast('error', 'Data kosong', `Tidak ada siswa di kelas ${kelas}.`);
            hideCounterUI();
            return;
        }

        data.forEach((s, i) => {
            const isFilled = s.nilai_lama !== null && s.nilai_lama !== undefined && s.nilai_lama !== '';
            const state    = isFilled ? 'locked' : 'empty';

            const tr = document.createElement('tr');
            tr.id        = `row-${i}`;
            tr.className = `row-${state}`;
            tr.innerHTML = `
                <td class="no-cell">${i + 1}</td>
                <td style="font-weight:500;color:#1a1a2e">${s.nama_siswa}</td>
                <td class="nipd-cell">${s.nipd}</td>
                <td style="font-size:13px;color:#6b7280">${s.jurusan}</td>
                <td>
                    <input type="number" min="0" max="100"
                           class="inp-tbl inp-nilai r-nilai"
                           value="${s.nilai_lama ?? ''}"
                           placeholder="0–100"
                           ${isFilled ? 'disabled' : ''}
                           oninput="onNilaiInput(${i}, this)">
                </td>
                <td>
                    <input type="text" class="inp-tbl inp-pred r-pred"
                           value="${s.predikat_lama ?? ''}"
                           readonly ${isFilled ? 'disabled' : ''}>
                </td>
                <td>
                    <input type="text" class="inp-tbl inp-desk r-desk"
                           value="${s.deskripsi_lama ?? ''}"
                           placeholder="Tulis deskripsi..."
                           ${isFilled ? 'disabled' : ''}>
                </td>
                <td>
                    <span class="r-badge badge-status ${isFilled ? 'bs-locked' : 'bs-empty'}">
                        ${isFilled
                            ? '<i class="bi bi-lock-fill"></i> Terkunci'
                            : '<i class="bi bi-circle"></i> Belum diisi'}
                    </span>
                </td>
                <td class="r-act">
                    ${isFilled
                        ? `<button class="btn-act btn-edit" onclick="startEdit(${i})">
                               <i class="bi bi-pencil" style="font-size:11px"></i> Edit
                           </button>`
                        : `<span style="font-size:12px;color:#d1d5db;">—</span>`}
                </td>`;
            tbody.appendChild(tr);
        });

        showCounterUI();
        updateCounter();
        showToast('success', 'Data berhasil dimuat', `${data.length} siswa kelas ${kelas} ditemukan.`);

    } catch (e) {
        console.error(e);
        dismissToast(loading);
        showToast('error', 'Gagal memuat', 'Tidak dapat terhubung ke server.');
    } finally {
        if (btn) btn.disabled = false;
    }
}

function onNilaiInput(idx, input) {
    const row  = getRow(idx);
    const pred = row.querySelector('.r-pred');
    pred.value = input.value.trim() ? getPredikat(input.value) : '';
    updateCounter();
}

function showCounterUI() {
    document.getElementById('counterBar').style.setProperty('display', 'flex', 'important');
    document.getElementById('progressWrap').style.display = 'block';
    document.getElementById('legendRow').style.display = 'flex';
}
function hideCounterUI() {
    document.getElementById('counterBar').style.setProperty('display', 'none', 'important');
    document.getElementById('progressWrap').style.display = 'none';
    document.getElementById('legendRow').style.display = 'none';
}

/* ─────────────────────────────────────────────
   SIMPAN SEMUA (ke server)
───────────────────────────────────────────── */
async function simpanData() {
    const kelas = document.getElementById('kelas').value;
    const rows  = document.querySelectorAll('#tabel_siswa tr[id^="row-"]');
    const data  = [];

    rows.forEach(row => {
        const nilai = row.querySelector('.r-nilai')?.value?.trim();
        if (nilai) {
            data.push({
                nama_siswa: row.cells[1]?.textContent?.trim(),
                nipd:       row.cells[2]?.textContent?.trim(),
                jurusan:    row.cells[3]?.textContent?.trim(),
                nilai,
                predikat:   row.querySelector('.r-pred')?.value ?? '',
                deskripsi:  row.querySelector('.r-desk')?.value ?? '',
            });
        }
    });

    if (!data.length) {
        showToast('error', 'Tidak ada data', 'Isi minimal satu nilai siswa sebelum menyimpan.');
        return;
    }

    // Cek apakah ada yang sedang di-edit (belum disimpan baris)
    const editingRows = [...rows].filter(r => r.classList.contains('row-editing'));
    if (editingRows.length) {
        showToast('error', 'Ada baris yang belum selesai diedit', 'Simpan atau batalkan edit baris terlebih dahulu.');
        return;
    }

    const loading = showToast('loading', 'Menyimpan...', `Mengirim ${data.length} data ke server.`);

    try {
        const res    = await fetch('/eskul/simpan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept':       'application/json',
            },
            body: JSON.stringify({ eskul: eskulLogin, kelas, data }),
        });
        const result = await res.json();
        dismissToast(loading);

        if (res.ok) {
            showToast('success', 'Berhasil disimpan', `${data.length} nilai siswa kelas ${kelas} tersimpan ke database.`);
            // Kunci semua baris yang punya nilai setelah simpan ke server
            rows.forEach((row, i) => {
                const nilai = row.querySelector('.r-nilai')?.value?.trim();
                if (nilai) setRowState(i, 'locked');
            });
        } else {
            showToast('error', 'Gagal menyimpan', result.message || 'Terjadi kesalahan pada server.');
        }
    } catch (e) {
        console.error(e);
        dismissToast(loading);
        showToast('error', 'Gagal menyimpan', 'Tidak dapat terhubung ke server.');
    }
}

/* ─────────────────────────────────────────────
   LOGOUT
───────────────────────────────────────────── */
function showLogoutModal() {
    new bootstrap.Modal(document.getElementById('logoutModal')).show();
}

async function confirmLogout() {
    try {
        await fetch('/logout-eskul', {
            method:  'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        });
        window.location.href = '/gin';
    } catch {
        alert('Gagal logout.');
    }
}
</script>
</body>
</html>
