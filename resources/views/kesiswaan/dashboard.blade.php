<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Kesiswaan – SMAN 1 Nusantara</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --font-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      --color-background-primary: #ffffff;
      --color-background-secondary: #f5f5f4;
      --color-background-tertiary: #efefed;
      --color-background-info: #e8f4fd;
      --color-border-tertiary: #e8e7e5;
      --color-border-secondary: #d4d3d0;
      --color-text-primary: #1a1a18;
      --color-text-secondary: #6b6b68;
      --color-text-tertiary: #a3a3a0;
      --color-text-info: #0b5394;
      --border-radius-md: 8px;
      --border-radius-lg: 12px;
    }

    body { font-family: var(--font-sans); background: var(--color-background-tertiary); }

    /* ── Layout ── */
    .app { display: flex; min-height: 100vh; }

    /* ── Sidebar ── */
    .sidebar {
      width: 220px;
      background: var(--color-background-primary);
      border-right: 0.5px solid var(--color-border-tertiary);
      padding: 1.5rem 0;
      flex-shrink: 0;
    }
    .logo {
      padding: 0 1.25rem 1.5rem;
      border-bottom: 0.5px solid var(--color-border-tertiary);
      margin-bottom: 1rem;
    }
    .logo-title { font-size: 15px; font-weight: 500; color: var(--color-text-primary); }
    .logo-sub { font-size: 12px; color: var(--color-text-secondary); margin-top: 2px; }

    .nav-section { padding: 0 0.75rem; margin-bottom: 0.5rem; }
    .nav-label {
      font-size: 10px; color: var(--color-text-tertiary);
      text-transform: uppercase; letter-spacing: 0.08em;
      padding: 0.5rem 0.5rem 0.25rem;
    }
    .nav-item {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 10px; border-radius: var(--border-radius-md);
      cursor: pointer; font-size: 13px; color: var(--color-text-secondary);
      margin-bottom: 2px; transition: all 0.15s;
    }
    .nav-item:hover { background: var(--color-background-secondary); color: var(--color-text-primary); }
    .nav-item.active { background: var(--color-background-info); color: var(--color-text-info); font-weight: 500; }
    .nav-icon { width: 16px; height: 16px; opacity: 0.7; }
    .nav-item.active .nav-icon { opacity: 1; }

    /* ── Main ── */
    .main { flex: 1; overflow: hidden; display: flex; flex-direction: column; }

    .topbar {
      background: var(--color-background-primary);
      border-bottom: 0.5px solid var(--color-border-tertiary);
      padding: 0 1.5rem; height: 56px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .page-title { font-size: 16px; font-weight: 500; color: var(--color-text-primary); }
    .topbar-actions { display: flex; align-items: center; gap: 10px; }

    /* ── Buttons ── */
    .btn {
      padding: 7px 14px; border-radius: var(--border-radius-md);
      font-size: 13px; cursor: pointer;
      border: 0.5px solid var(--color-border-secondary);
      background: var(--color-background-primary); color: var(--color-text-primary);
      transition: all 0.15s;
    }
    .btn:hover { background: var(--color-background-secondary); }
    .btn-primary { background: #1D9E75; color: white; border-color: #1D9E75; }
    .btn-primary:hover { background: #0F6E56; border-color: #0F6E56; }
    .btn-sm { padding: 5px 10px; font-size: 12px; }

    /* ── Content area ── */
    .content { flex: 1; padding: 1.5rem; overflow-y: auto; }

    /* ── Stat cards ── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 12px;
      margin-bottom: 1.5rem;
    }
    .stat-card {
      background: var(--color-background-secondary);
      border-radius: var(--border-radius-md);
      padding: 1rem;
    }
    .stat-label { font-size: 12px; color: var(--color-text-secondary); margin-bottom: 6px; }
    .stat-value { font-size: 24px; font-weight: 500; color: var(--color-text-primary); }
    .stat-sub { font-size: 11px; color: var(--color-text-tertiary); margin-top: 4px; }

    /* ── Panel ── */
    .panel {
      background: var(--color-background-primary);
      border-radius: var(--border-radius-lg);
      border: 0.5px solid var(--color-border-tertiary);
      margin-bottom: 1.25rem;
    }
    .panel-header {
      padding: 1rem 1.25rem;
      border-bottom: 0.5px solid var(--color-border-tertiary);
      display: flex; align-items: center; justify-content: space-between;
    }
    .panel-title { font-size: 14px; font-weight: 500; color: var(--color-text-primary); }
    .panel-body { padding: 0; }

    /* ── Search bar ── */
    .search-bar {
      display: flex; align-items: center; gap: 8px;
      padding: 0.75rem 1.25rem;
      border-bottom: 0.5px solid var(--color-border-tertiary);
    }
    .search-input {
      flex: 1;
      border: 0.5px solid var(--color-border-secondary);
      border-radius: var(--border-radius-md);
      padding: 7px 12px; font-size: 13px;
      background: var(--color-background-secondary);
      color: var(--color-text-primary);
    }
    .search-input:focus { outline: none; border-color: #1D9E75; }
    .filter-select {
      border: 0.5px solid var(--color-border-secondary);
      border-radius: var(--border-radius-md);
      padding: 7px 10px; font-size: 13px;
      background: var(--color-background-secondary);
      color: var(--color-text-primary); cursor: pointer;
    }

    /* ── Table ── */
    table { width: 100%; border-collapse: collapse; font-size: 13px; }
    th {
      padding: 10px 1.25rem; text-align: left;
      font-weight: 500; font-size: 11px;
      color: var(--color-text-secondary);
      text-transform: uppercase; letter-spacing: 0.05em;
      border-bottom: 0.5px solid var(--color-border-tertiary);
    }
    td {
      padding: 12px 1.25rem;
      border-bottom: 0.5px solid var(--color-border-tertiary);
      color: var(--color-text-primary);
    }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--color-background-secondary); }

    /* ── Badges ── */
    .badge {
      display: inline-flex; align-items: center;
      padding: 3px 8px; border-radius: 99px;
      font-size: 11px; font-weight: 500;
    }
    .badge-teal  { background: #E1F5EE; color: #085041; }
    .badge-blue  { background: #E6F1FB; color: #0C447C; }
    .badge-amber { background: #FAEEDA; color: #633806; }
    .badge-coral { background: #FAECE7; color: #4A1B0C; }
    .badge-purple{ background: #EEEDFE; color: #26215C; }
    .badge-gray  { background: var(--color-background-secondary); color: var(--color-text-secondary); }

    /* ── Avatars ── */
    .avatar {
      width: 32px; height: 32px; border-radius: 50%;
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 500; flex-shrink: 0;
    }
    .av-teal   { background: #9FE1CB; color: #085041; }
    .av-blue   { background: #B5D4F4; color: #0C447C; }
    .av-coral  { background: #F5C4B3; color: #4A1B0C; }
    .av-purple { background: #CECBF6; color: #26215C; }
    .av-amber  { background: #FAC775; color: #412402; }

    .cell-name { display: flex; align-items: center; gap: 10px; }

    .eskul-chip {
      display: inline-flex; align-items: center; gap: 4px;
      padding: 2px 8px; border-radius: 99px;
      font-size: 11px;
      background: var(--color-background-info); color: var(--color-text-info);
      margin-right: 4px; margin-bottom: 2px;
    }

    .action-btn {
      padding: 4px 10px; font-size: 11px;
      border-radius: var(--border-radius-md);
      border: 0.5px solid var(--color-border-secondary);
      background: transparent; color: var(--color-text-secondary); cursor: pointer;
    }
    .action-btn:hover { background: var(--color-background-secondary); color: var(--color-text-primary); }
    .action-btn.danger:hover { background: #FCEBEB; color: #A32D2D; border-color: #F09595; }

    /* ── Modal ── */
    .modal-overlay {
      position: fixed; inset: 0; background: rgba(0,0,0,0.45);
      display: flex; align-items: center; justify-content: center; z-index: 100;
    }
    .modal {
      background: var(--color-background-primary);
      border-radius: var(--border-radius-lg);
      border: 0.5px solid var(--color-border-tertiary);
      width: 480px; max-width: 95vw;
    }
    .modal-header {
      padding: 1.25rem 1.25rem 1rem;
      border-bottom: 0.5px solid var(--color-border-tertiary);
      display: flex; align-items: center; justify-content: space-between;
    }
    .modal-title { font-size: 15px; font-weight: 500; color: var(--color-text-primary); }
    .modal-close {
      width: 28px; height: 28px; border-radius: var(--border-radius-md);
      border: none; background: transparent; cursor: pointer;
      color: var(--color-text-secondary); font-size: 18px;
      display: flex; align-items: center; justify-content: center;
    }
    .modal-close:hover { background: var(--color-background-secondary); }
    .modal-body { padding: 1.25rem; }
    .modal-footer {
      padding: 1rem 1.25rem;
      border-top: 0.5px solid var(--color-border-tertiary);
      display: flex; justify-content: flex-end; gap: 8px;
    }

    /* ── Form ── */
    .form-group { margin-bottom: 1rem; }
    .form-label { font-size: 12px; color: var(--color-text-secondary); margin-bottom: 6px; display: block; }
    .form-input {
      width: 100%;
      border: 0.5px solid var(--color-border-secondary);
      border-radius: var(--border-radius-md);
      padding: 8px 12px; font-size: 13px;
      background: var(--color-background-secondary);
      color: var(--color-text-primary);
    }
    .form-input:focus { outline: none; border-color: #1D9E75; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

    /* ── Eskul picker ── */
    .eskul-select-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-top: 6px; }
    .eskul-option {
      border: 0.5px solid var(--color-border-secondary);
      border-radius: var(--border-radius-md);
      padding: 8px 12px; cursor: pointer;
      font-size: 12px; color: var(--color-text-secondary);
      transition: all 0.15s;
    }
    .eskul-option:hover { border-color: #1D9E75; color: #0F6E56; background: #E1F5EE; }
    .eskul-option.selected { border-color: #1D9E75; background: #E1F5EE; color: #085041; font-weight: 500; }
    .eskul-option .eo-name { font-weight: 500; font-size: 13px; }
    .eskul-option .eo-sub  { font-size: 11px; opacity: 0.7; margin-top: 1px; }

    /* ── Pages ── */
    .page { display: none; }
    .page.active { display: block; }

    /* ── Eskul page ── */
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
    .eskul-card {
      background: var(--color-background-primary);
      border-radius: var(--border-radius-lg);
      border: 0.5px solid var(--color-border-tertiary);
      padding: 1.25rem;
    }
    .eskul-card-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1rem; }
    .eskul-card-name { font-size: 15px; font-weight: 500; color: var(--color-text-primary); }
    .eskul-card-type { font-size: 11px; color: var(--color-text-secondary); margin-top: 2px; }
    .eskul-meta { display: flex; gap: 1.5rem; margin-bottom: 1rem; }
    .eskul-meta-item { font-size: 12px; }
    .eskul-meta-label { color: var(--color-text-secondary); }
    .eskul-meta-val { font-weight: 500; color: var(--color-text-primary); font-size: 16px; }
    .member-list { display: flex; flex-wrap: wrap; gap: 6px; }
    .member-chip {
      display: flex; align-items: center; gap: 6px;
      padding: 4px 10px 4px 4px; border-radius: 99px;
      background: var(--color-background-secondary);
      border: 0.5px solid var(--color-border-tertiary);
      font-size: 12px; color: var(--color-text-primary);
    }
    .member-chip .av {
      width: 22px; height: 22px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 9px; font-weight: 500;
    }

    /* ── Pembina page ── */
    .pembina-card {
      background: var(--color-background-primary);
      border-radius: var(--border-radius-lg);
      border: 0.5px solid var(--color-border-tertiary);
      padding: 1.25rem;
      display: flex; flex-direction: column;
    }
    .pembina-info { display: flex; align-items: center; gap: 12px; margin-bottom: 1rem; }
    .pembina-detail { flex: 1; }
    .pembina-name { font-size: 15px; font-weight: 500; color: var(--color-text-primary); }
    .pembina-nip  { font-size: 12px; color: var(--color-text-secondary); margin-top: 1px; }
    .pembina-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 1rem; }
    .pm-item { font-size: 12px; }
    .pm-label { color: var(--color-text-secondary); }
    .pm-val   { color: var(--color-text-primary); font-weight: 500; margin-top: 1px; }
    .eskul-tag-list { display: flex; flex-wrap: wrap; gap: 6px; }

    /* ── Misc ── */
    .status-active { display: inline-flex; align-items: center; gap: 5px; }
    .dot { width: 7px; height: 7px; border-radius: 50%; }
    .dot-green { background: #639922; }
    .dot-red   { background: #A32D2D; }
    .empty-state { text-align: center; padding: 3rem; color: var(--color-text-secondary); font-size: 13px; }

    /* ── Responsive ── */
    @media (max-width: 768px) {
      .sidebar { display: none; }
      .stats-grid { grid-template-columns: 1fr 1fr; }
      .two-col, .form-row { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

<div class="app">

  <!-- ════════════════ SIDEBAR ════════════════ -->
  <aside class="sidebar">
    <div class="logo">
      <div class="logo-title">SMAN 1 Nusantara</div>
      <div class="logo-sub">Sistem Informasi Kesiswaan</div>
    </div>
    <div class="nav-section">
      <div class="nav-label">Menu Utama</div>
      <div class="nav-item active" onclick="switchPage('siswa', this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <rect x="2" y="1" width="12" height="14" rx="2"/>
          <line x1="5" y1="5" x2="11" y2="5"/>
          <line x1="5" y1="8" x2="11" y2="8"/>
          <line x1="5" y1="11" x2="8" y2="11"/>
        </svg>
        Data Siswa
      </div>
      <div class="nav-item" onclick="switchPage('eskul', this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="8" cy="8" r="6"/>
          <path d="M8 4v4l3 2"/>
        </svg>
        Ekstrakurikuler
      </div>
      <div class="nav-item" onclick="switchPage('pembina', this)">
        <svg class="nav-icon" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="6" cy="5" r="3"/>
          <path d="M1 14c0-3 2-5 5-5"/>
          <circle cx="12" cy="9" r="2.5"/>
          <path d="M9.5 14h5"/>
          <line x1="12" y1="11.5" x2="12" y2="14"/>
        </svg>
        Pembina Eskul
      </div>
    </div>
  </aside>

  <!-- ════════════════ MAIN ════════════════ -->
  <div class="main">

    <!-- Topbar -->
    <div class="topbar">
      <span class="page-title" id="pageTitle">Data Siswa</span>
      <div class="topbar-actions">
        <button class="btn btn-primary btn-sm" id="topbarAddBtn" onclick="openModal('addSiswa')">+ Tambah Siswa</button>

        {{-- Info user login --}}
        <div style="display:flex;align-items:center;gap:8px;margin-left:8px;">
          <div style="width:32px;height:32px;border-radius:50%;background:#E1F5EE;color:#085041;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;">
            {{ strtoupper(substr(Auth::guard('kesiswaan')->user()->name ?? 'K', 0, 1)) }}
          </div>
          <div style="font-size:13px;color:var(--color-text-primary);max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
            {{ Auth::guard('kesiswaan')->user()->name ?? 'Kesiswaan' }}
          </div>
        </div>

        {{-- Tombol Logout --}}
        <form method="POST" action="{{ route('kesiswaan.logout') }}" style="margin:0;">
          @csrf
          <button type="submit" class="btn btn-sm" style="color:#A32D2D;border-color:#F09595;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
              <polyline points="16 17 21 12 16 7"/>
              <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
          </button>
        </form>

      </div>
    </div>

    <div class="content">

      <!-- ─── PAGE: SISWA ─── -->
      <div id="page-siswa" class="page active">
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-label">Total Siswa</div>
            <div class="stat-value" id="statTotal">0</div>
            <div class="stat-sub">Semua kelas</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Ikut Eskul</div>
            <div class="stat-value" id="statEskul">0</div>
            <div class="stat-sub">Terdaftar di eskul</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Belum Eskul</div>
            <div class="stat-value" id="statNoEskul">0</div>
            <div class="stat-sub">Belum terdaftar</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Total Eskul</div>
            <div class="stat-value" id="statTotalEskul">0</div>
            <div class="stat-sub">Aktif berjalan</div>
          </div>
        </div>

        <div class="panel">
          <div class="panel-header">
            <span class="panel-title">Daftar Siswa</span>
            <span style="font-size:12px;color:var(--color-text-secondary)" id="siswaCount">0 siswa</span>
          </div>
          <div class="search-bar">
            <input type="text" class="search-input" placeholder="Cari nama atau NIS…" id="searchSiswa" oninput="renderSiswaTable()">
            <select class="filter-select" id="filterKelas" onchange="renderSiswaTable()">
              <option value="">Semua Kelas</option>
              <option>X-A</option><option>X-B</option>
              <option>XI-A</option><option>XI-B</option>
              <option>XII-A</option><option>XII-B</option>
            </select>
            <select class="filter-select" id="filterEskulStatus" onchange="renderSiswaTable()">
              <option value="">Semua Status</option>
              <option value="ya">Ikut Eskul</option>
              <option value="tidak">Belum Eskul</option>
            </select>
          </div>
          <div class="panel-body">
            <table>
              <thead>
                <tr>
                  <th>Siswa</th>
                  <th>NIS</th>
                  <th>Kelas</th>
                  <th>Ekstrakurikuler</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="siswaTableBody"></tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ─── PAGE: ESKUL ─── -->
      <div id="page-eskul" class="page">
        <div class="stats-grid" style="grid-template-columns: repeat(3, minmax(0,1fr));">
          <div class="stat-card">
            <div class="stat-label">Total Eskul</div>
            <div class="stat-value" id="statEskulPage">0</div>
            <div class="stat-sub">Aktif</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Total Anggota</div>
            <div class="stat-value" id="statMemberEskul">0</div>
            <div class="stat-sub">Dari semua eskul</div>
          </div>
          <div class="stat-card">
            <div class="stat-label">Eskul Terpopuler</div>
            <div class="stat-value" style="font-size:16px;margin-top:4px;" id="statPopEskul">-</div>
            <div class="stat-sub">Anggota terbanyak</div>
          </div>
        </div>
        <div id="eskulGrid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1.25rem;"></div>
      </div>

      <!-- ─── PAGE: PEMBINA ─── -->
      <div id="page-pembina" class="page">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
          <div style="font-size:13px;color:var(--color-text-secondary);" id="pembinaCount">0 pembina terdaftar</div>
          <button class="btn btn-primary" onclick="openModal('addPembina')">+ Tambah Pembina</button>
        </div>
        <div id="pembinaGrid" style="display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1.25rem;"></div>
      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->


<!-- ════════════════ MODAL: Tambah Siswa ════════════════ -->
<div class="modal-overlay" id="modal-addSiswa" style="display:none;">
  <div class="modal">
    <div class="modal-header">
      <span class="modal-title">Tambah Siswa Baru</span>
      <button class="modal-close" onclick="closeModal('addSiswa')">×</button>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Lengkap *</label>
          <input type="text" class="form-input" id="f-nama" placeholder="Nama siswa">
        </div>
        <div class="form-group">
          <label class="form-label">NIS *</label>
          <input type="text" class="form-input" id="f-nis" placeholder="Nomor Induk Siswa">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Kelas *</label>
          <select class="form-input" id="f-kelas">
            <option value="">-- Pilih Kelas --</option>
            <option>X-A</option><option>X-B</option>
            <option>XI-A</option><option>XI-B</option>
            <option>XII-A</option><option>XII-B</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Jenis Kelamin</label>
          <select class="form-input" id="f-jk">
            <option>Laki-laki</option>
            <option>Perempuan</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Daftarkan ke Ekstrakurikuler (opsional)</label>
        <div class="eskul-select-grid" id="eskulPickerAdd"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn" onclick="closeModal('addSiswa')">Batal</button>
      <button class="btn btn-primary" onclick="tambahSiswa()">Simpan Siswa</button>
    </div>
  </div>
</div>


<!-- ════════════════ MODAL: Daftarkan ke Eskul ════════════════ -->
<div class="modal-overlay" id="modal-daftarEskul" style="display:none;">
  <div class="modal">
    <div class="modal-header">
      <span class="modal-title">Daftarkan ke Ekstrakurikuler</span>
      <button class="modal-close" onclick="closeModal('daftarEskul')">×</button>
    </div>
    <div class="modal-body">
      <p style="font-size:13px;color:var(--color-text-secondary);margin-bottom:1rem;">
        Pilih eskul untuk
        <strong id="targetSiswaName" style="color:var(--color-text-primary);"></strong>
      </p>
      <div class="eskul-select-grid" id="eskulPickerDaftar"></div>
    </div>
    <div class="modal-footer">
      <button class="btn" onclick="closeModal('daftarEskul')">Batal</button>
      <button class="btn btn-primary" onclick="simpanDaftarEskul()">Simpan</button>
    </div>
  </div>
</div>


<!-- ════════════════ MODAL: Tambah Pembina ════════════════ -->
<div class="modal-overlay" id="modal-addPembina" style="display:none;">
  <div class="modal">
    <div class="modal-header">
      <span class="modal-title">Tambah Pembina Eskul</span>
      <button class="modal-close" onclick="closeModal('addPembina')">×</button>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Pembina *</label>
          <input type="text" class="form-input" id="p-nama" placeholder="Nama lengkap">
        </div>
        <div class="form-group">
          <label class="form-label">NIP *</label>
          <input type="text" class="form-input" id="p-nip" placeholder="Nomor Induk Pegawai">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">No. Telepon</label>
          <input type="text" class="form-input" id="p-telp" placeholder="08xx-xxxx-xxxx">
        </div>
        <div class="form-group">
          <label class="form-label">Mulai Bertugas</label>
          <input type="date" class="form-input" id="p-mulai">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Eskul yang Dibina *</label>
        <div class="eskul-select-grid" id="eskulPickerPembina"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn" onclick="closeModal('addPembina')">Batal</button>
      <button class="btn btn-primary" onclick="tambahPembina()">Simpan Pembina</button>
    </div>
  </div>
</div>


<!-- ════════════════ JAVASCRIPT ════════════════ -->
<script>
  /* ── Helpers ── */
  const avColors    = ['av-teal','av-blue','av-coral','av-purple','av-amber'];
  const badgeColors = ['badge-teal','badge-blue','badge-amber','badge-coral','badge-purple'];
  const avColor    = i => avColors[i % avColors.length];
  const badgeColor = i => badgeColors[i % badgeColors.length];
  const initials   = n => n.split(' ').slice(0,2).map(w => w[0]).join('').toUpperCase();

  /* ── Data ── */
  let siswa = [
    {id:1,  nama:'Andi Prasetyo',  nis:'2024001', kelas:'X-A',   jk:'Laki-laki',  eskul:['OSIS','Paskibra']},
    {id:2,  nama:'Budi Santoso',   nis:'2024002', kelas:'X-A',   jk:'Laki-laki',  eskul:['Basket']},
    {id:3,  nama:'Citra Dewi',     nis:'2024003', kelas:'X-B',   jk:'Perempuan',  eskul:['Pramuka','Paduan Suara']},
    {id:4,  nama:'Dian Permata',   nis:'2024004', kelas:'XI-A',  jk:'Perempuan',  eskul:[]},
    {id:5,  nama:'Eka Saputra',    nis:'2024005', kelas:'XI-A',  jk:'Laki-laki',  eskul:['Futsal']},
    {id:6,  nama:'Fani Lestari',   nis:'2024006', kelas:'XI-B',  jk:'Perempuan',  eskul:['Pramuka']},
    {id:7,  nama:'Gilang Nugraha', nis:'2024007', kelas:'XII-A', jk:'Laki-laki',  eskul:['OSIS','Basket']},
    {id:8,  nama:'Hana Sari',      nis:'2024008', kelas:'XII-B', jk:'Perempuan',  eskul:[]},
    {id:9,  nama:'Irwan Hidayat',  nis:'2024009', kelas:'X-B',   jk:'Laki-laki',  eskul:['Futsal','Paskibra']},
    {id:10, nama:'Juwita Rahayu',  nis:'2024010', kelas:'XII-A', jk:'Perempuan',  eskul:['Paduan Suara']},
  ];

  let eskul = [
    {id:'OSIS',         nama:'OSIS',          tipe:'Organisasi',  deskripsi:'Organisasi Siswa Intra Sekolah'},
    {id:'Pramuka',      nama:'Pramuka',        tipe:'Kepanduan',   deskripsi:'Gerakan Pramuka Sekolah'},
    {id:'Basket',       nama:'Basket',         tipe:'Olahraga',    deskripsi:'Tim Basket Sekolah'},
    {id:'Futsal',       nama:'Futsal',         tipe:'Olahraga',    deskripsi:'Tim Futsal Sekolah'},
    {id:'Paskibra',     nama:'Paskibra',       tipe:'Bela Negara', deskripsi:'Pasukan Kibar Bendera'},
    {id:'Paduan Suara', nama:'Paduan Suara',   tipe:'Seni',        deskripsi:'Paduan Suara Sekolah'},
  ];

  let pembina = [
    {id:1, nama:'Bpk. Rudi Hartono',    nip:'198501012010011001', telp:'0812-3456-7890', eskul:['Basket','Futsal'],        mulai:'2020-07-01', status:'aktif'},
    {id:2, nama:'Ibu Sari Mulyani',     nip:'198702152012012002', telp:'0813-9988-7766', eskul:['Pramuka'],               mulai:'2022-01-10', status:'aktif'},
    {id:3, nama:'Bpk. Hendra Wijaya',   nip:'199001032015011003', telp:'0811-2233-4455', eskul:['OSIS','Paskibra'],       mulai:'2021-08-01', status:'aktif'},
    {id:4, nama:'Ibu Dewi Anggraini',   nip:'199205202018012004', telp:'0856-7744-3322', eskul:['Paduan Suara'],          mulai:'2023-01-15', status:'aktif'},
  ];

  let nextSiswaId    = 11;
  let nextPembinaId  = 5;
  let editingSiswaId = null;
  let selectedEskulAdd     = [];
  let selectedEskulPembina = [];
  let selectedEskulDaftar  = [];

  /* ────────────────────────────────────────────
     Navigation
  ──────────────────────────────────────────── */
  function switchPage(page, el) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    document.getElementById('page-' + page).classList.add('active');
    el.classList.add('active');

    const titles = { siswa: 'Data Siswa', eskul: 'Ekstrakurikuler', pembina: 'Pembina Eskul' };
    document.getElementById('pageTitle').textContent = titles[page];

    const addBtn = document.getElementById('topbarAddBtn');
    if (page === 'siswa') {
      addBtn.style.display = 'inline-flex';
      addBtn.textContent = '+ Tambah Siswa';
      addBtn.onclick = () => openModal('addSiswa');
    } else {
      addBtn.style.display = 'none';
    }

    if (page === 'eskul')   renderEskulPage();
    if (page === 'pembina') renderPembinaPage();
    updateStats();
  }

  /* ────────────────────────────────────────────
     Stats
  ──────────────────────────────────────────── */
  function updateStats() {
    const total     = siswa.length;
    const withEskul = siswa.filter(s => s.eskul.length > 0).length;
    document.getElementById('statTotal').textContent     = total;
    document.getElementById('statEskul').textContent     = withEskul;
    document.getElementById('statNoEskul').textContent   = total - withEskul;
    document.getElementById('statTotalEskul').textContent = eskul.length;
    document.getElementById('siswaCount').textContent    = total + ' siswa';
  }

  /* ────────────────────────────────────────────
     Siswa Table
  ──────────────────────────────────────────── */
  function renderSiswaTable() {
    const q          = document.getElementById('searchSiswa').value.toLowerCase();
    const kelas      = document.getElementById('filterKelas').value;
    const eskulStatus = document.getElementById('filterEskulStatus').value;

    const data = siswa.filter(s => {
      if (q && !s.nama.toLowerCase().includes(q) && !s.nis.includes(q)) return false;
      if (kelas && s.kelas !== kelas) return false;
      if (eskulStatus === 'ya'    && s.eskul.length === 0) return false;
      if (eskulStatus === 'tidak' && s.eskul.length > 0)  return false;
      return true;
    });

    const body = document.getElementById('siswaTableBody');
    if (data.length === 0) {
      body.innerHTML = `<tr><td colspan="5"><div class="empty-state">Tidak ada siswa ditemukan</div></td></tr>`;
      return;
    }

    body.innerHTML = data.map(s => `
      <tr>
        <td>
          <div class="cell-name">
            <div class="avatar ${avColor(s.id - 1)}">${initials(s.nama)}</div>
            <div>
              <div style="font-weight:500;font-size:13px;">${s.nama}</div>
              <div style="font-size:11px;color:var(--color-text-secondary);">${s.jk}</div>
            </div>
          </div>
        </td>
        <td style="font-size:12px;color:var(--color-text-secondary);">${s.nis}</td>
        <td><span class="badge badge-gray">${s.kelas}</span></td>
        <td>
          ${s.eskul.length === 0
            ? '<span style="font-size:12px;color:var(--color-text-tertiary);">Belum terdaftar</span>'
            : s.eskul.map(e => `<span class="eskul-chip">${e}</span>`).join('')}
        </td>
        <td style="white-space:nowrap;">
          <button class="action-btn" onclick="openDaftarEskul(${s.id})">+ Eskul</button>
          <button class="action-btn danger" onclick="hapusSiswa(${s.id})" style="margin-left:4px;">Hapus</button>
        </td>
      </tr>
    `).join('');
  }

  /* ────────────────────────────────────────────
     Eskul Page
  ──────────────────────────────────────────── */
  function renderEskulPage() {
    const totalMember = eskul.reduce((a, e) => a + siswa.filter(s => s.eskul.includes(e.id)).length, 0);
    document.getElementById('statEskulPage').textContent   = eskul.length;
    document.getElementById('statMemberEskul').textContent = totalMember;

    const popEskul = eskul.reduce((best, e) => {
      const cnt = siswa.filter(s => s.eskul.includes(e.id)).length;
      return cnt > (best.cnt || 0) ? { nama: e.nama, cnt } : best;
    }, {});
    document.getElementById('statPopEskul').textContent = popEskul.nama || '-';

    document.getElementById('eskulGrid').innerHTML = eskul.map((e, ei) => {
      const members = siswa.filter(s => s.eskul.includes(e.id));
      const pb      = pembina.filter(p => p.eskul.includes(e.id));
      const pbNames = pb.length > 0
        ? pb.map(p => p.nama.replace('Bpk. ','').replace('Ibu ','')).join(', ')
        : `<span style="color:var(--color-text-tertiary);font-size:12px;font-weight:400;">Belum ada</span>`;

      return `
        <div class="eskul-card">
          <div class="eskul-card-header">
            <div>
              <div class="eskul-card-name">${e.nama}</div>
              <div class="eskul-card-type">${e.tipe}</div>
            </div>
            <span class="badge ${badgeColor(ei)}">${members.length} anggota</span>
          </div>
          <div class="eskul-meta">
            <div class="eskul-meta-item">
              <div class="eskul-meta-label">Pembina</div>
              <div class="eskul-meta-val" style="font-size:14px;">${pbNames}</div>
            </div>
          </div>
          <div style="font-size:12px;color:var(--color-text-secondary);margin-bottom:8px;">Anggota:</div>
          <div class="member-list">
            ${members.length === 0
              ? '<span style="font-size:12px;color:var(--color-text-tertiary);">Belum ada anggota</span>'
              : members.map(m => `
                  <div class="member-chip">
                    <div class="av ${avColor(m.id - 1)}">${initials(m.nama)}</div>
                    ${m.nama.split(' ')[0]}
                  </div>`).join('')}
          </div>
        </div>`;
    }).join('');
  }

  /* ────────────────────────────────────────────
     Pembina Page
  ──────────────────────────────────────────── */
  function renderPembinaPage() {
    document.getElementById('pembinaCount').textContent = pembina.length + ' pembina terdaftar';

    document.getElementById('pembinaGrid').innerHTML = pembina.map((p, i) => {
      const eskulList = p.eskul.map((e, ei) => `<span class="badge ${badgeColor(ei)}">${e}</span>`).join(' ');
      const tglMulai  = p.mulai
        ? new Date(p.mulai).toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' })
        : '-';

      return `
        <div class="pembina-card">
          <div class="pembina-info">
            <div class="avatar ${avColor(i)}" style="width:44px;height:44px;font-size:14px;">
              ${initials(p.nama.replace('Bpk. ','').replace('Ibu ',''))}
            </div>
            <div class="pembina-detail">
              <div class="pembina-name">${p.nama}</div>
              <div class="pembina-nip">NIP: ${p.nip}</div>
            </div>
            <div style="display:flex;gap:6px;">
              <button class="action-btn danger" onclick="hapusPembina(${p.id})">Hapus</button>
            </div>
          </div>
          <div class="pembina-meta">
            <div class="pm-item">
              <div class="pm-label">Telepon</div>
              <div class="pm-val">${p.telp || '-'}</div>
            </div>
            <div class="pm-item">
              <div class="pm-label">Mulai Bertugas</div>
              <div class="pm-val">${tglMulai}</div>
            </div>
          </div>
          <div style="font-size:12px;color:var(--color-text-secondary);margin-bottom:6px;">Membina Eskul:</div>
          <div class="eskul-tag-list">
            ${eskulList || '<span style="font-size:12px;color:var(--color-text-tertiary);">Belum ditugaskan</span>'}
          </div>
        </div>`;
    }).join('');
  }

  /* ────────────────────────────────────────────
     Modals
  ──────────────────────────────────────────── */
  function openModal(id) {
    if (id === 'addSiswa') {
      document.getElementById('f-nama').value  = '';
      document.getElementById('f-nis').value   = '';
      document.getElementById('f-kelas').value = '';
      selectedEskulAdd = [];
      renderEskulPicker('eskulPickerAdd', selectedEskulAdd);
    }
    if (id === 'addPembina') {
      document.getElementById('p-nama').value  = '';
      document.getElementById('p-nip').value   = '';
      document.getElementById('p-telp').value  = '';
      document.getElementById('p-mulai').value = '';
      selectedEskulPembina = [];
      renderEskulPicker('eskulPickerPembina', selectedEskulPembina);
    }
    document.getElementById('modal-' + id).style.display = 'flex';
  }

  function closeModal(id) {
    document.getElementById('modal-' + id).style.display = 'none';
  }

  /* Close on overlay click */
  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
      if (e.target === this) {
        const id = this.id.replace('modal-', '');
        closeModal(id);
      }
    });
  });

  /* ────────────────────────────────────────────
     Eskul Picker
  ──────────────────────────────────────────── */
  function renderEskulPicker(containerId, selectedArr) {
    const c = document.getElementById(containerId);
    c.innerHTML = eskul.map(e => `
      <div class="eskul-option ${selectedArr.includes(e.id) ? 'selected' : ''}"
           id="pick-${containerId}-${e.id.replace(/ /g,'_')}"
           onclick="toggleEskulPick('${e.id}', '${containerId}')">
        <div class="eo-name">${e.nama}</div>
        <div class="eo-sub">${e.tipe}</div>
      </div>
    `).join('');
  }

  function toggleEskulPick(eskulId, containerId) {
    const map = {
      eskulPickerAdd:     'selectedEskulAdd',
      eskulPickerPembina: 'selectedEskulPembina',
      eskulPickerDaftar:  'selectedEskulDaftar',
    };
    const key = map[containerId];
    const ref = window[key];
    const idx = ref.indexOf(eskulId);
    if (idx > -1) ref.splice(idx, 1); else ref.push(eskulId);

    const elId = 'pick-' + containerId + '-' + eskulId.replace(/ /g,'_');
    const el   = document.getElementById(elId);
    if (el) el.classList.toggle('selected', ref.includes(eskulId));
  }

  /* ────────────────────────────────────────────
     CRUD: Siswa
  ──────────────────────────────────────────── */
  function tambahSiswa() {
    const nama  = document.getElementById('f-nama').value.trim();
    const nis   = document.getElementById('f-nis').value.trim();
    const kelas = document.getElementById('f-kelas').value;
    const jk    = document.getElementById('f-jk').value;
    if (!nama || !nis || !kelas) { alert('Nama, NIS, dan Kelas wajib diisi.'); return; }
    siswa.push({ id: nextSiswaId++, nama, nis, kelas, jk, eskul: [...selectedEskulAdd] });
    closeModal('addSiswa');
    renderSiswaTable();
    updateStats();
  }

  function hapusSiswa(id) {
    if (!confirm('Yakin hapus siswa ini?')) return;
    siswa = siswa.filter(s => s.id !== id);
    renderSiswaTable();
    updateStats();
  }

  function openDaftarEskul(id) {
    const s = siswa.find(x => x.id === id);
    editingSiswaId   = id;
    selectedEskulDaftar = [...s.eskul];
    document.getElementById('targetSiswaName').textContent = s.nama;
    renderEskulPicker('eskulPickerDaftar', selectedEskulDaftar);
    document.getElementById('modal-daftarEskul').style.display = 'flex';
  }

  function simpanDaftarEskul() {
    const s = siswa.find(x => x.id === editingSiswaId);
    if (s) s.eskul = [...selectedEskulDaftar];
    closeModal('daftarEskul');
    renderSiswaTable();
    updateStats();
  }

  /* ────────────────────────────────────────────
     CRUD: Pembina
  ──────────────────────────────────────────── */
  function tambahPembina() {
    const nama  = document.getElementById('p-nama').value.trim();
    const nip   = document.getElementById('p-nip').value.trim();
    const telp  = document.getElementById('p-telp').value.trim();
    const mulai = document.getElementById('p-mulai').value;
    if (!nama || !nip) { alert('Nama dan NIP wajib diisi.'); return; }
    if (selectedEskulPembina.length === 0) { alert('Pilih minimal 1 eskul yang dibina.'); return; }
    pembina.push({ id: nextPembinaId++, nama, nip, telp, eskul: [...selectedEskulPembina], mulai, status: 'aktif' });
    closeModal('addPembina');
    renderPembinaPage();
  }

  function hapusPembina(id) {
    if (!confirm('Yakin hapus pembina ini?')) return;
    pembina = pembina.filter(p => p.id !== id);
    renderPembinaPage();
  }

  /* ────────────────────────────────────────────
     Init
  ──────────────────────────────────────────── */
  updateStats();
  renderSiswaTable();
</script>

</body>
</html>