<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard Kesiswaan – Data Siswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --font: 'Plus Jakarta Sans', sans-serif;
      --bg:        #F4F6FB;
      --surface:   #FFFFFF;
      --sidebar-bg:#1A2340;
      --sidebar-active: #2563EB;
      --sidebar-hover:  rgba(255,255,255,0.07);
      --primary:   #2563EB;
      --primary-dk:#1D4ED8;
      --danger:    #DC2626;
      --danger-lt: #FEF2F2;
      --success:   #16A34A;
      --success-lt:#F0FDF4;
      --border:    #E5E9F2;
      --text-1:    #111827;
      --text-2:    #6B7280;
      --text-3:    #9CA3AF;
      --radius-sm: 6px;
      --radius-md: 10px;
      --radius-lg: 14px;
      --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
      --shadow-md: 0 4px 16px rgba(0,0,0,0.08);
    }

    body { font-family: var(--font); background: var(--bg); color: var(--text-1); font-size: 14px; }

    /* ── Layout ── */
    .app { display: flex; min-height: 100vh; }

    /* ── Sidebar ── */
    .sidebar {
      width: 240px; flex-shrink: 0;
      background: var(--sidebar-bg);
      display: flex; flex-direction: column;
      padding: 0 0 1.5rem;
      position: sticky; top: 0; height: 100vh;
    }
    .sidebar-logo {
      padding: 1.5rem 1.25rem 1.25rem;
      border-bottom: 1px solid rgba(255,255,255,0.08);
      margin-bottom: 1rem;
    }
    .logo-badge {
      display: inline-flex; align-items: center; justify-content: center;
      width: 40px; height: 40px; border-radius: var(--radius-md);
      background: var(--primary); color: white;
      font-size: 18px; font-weight: 700; margin-bottom: 10px;
    }
    .logo-title { font-size: 14px; font-weight: 700; color: white; line-height: 1.3; }
    .logo-sub   { font-size: 11px; color: rgba(255,255,255,0.45); margin-top: 2px; }

    .nav-label {
      font-size: 10px; font-weight: 600; letter-spacing: 0.1em;
      text-transform: uppercase; color: rgba(255,255,255,0.3);
      padding: 0 1.25rem; margin-bottom: 4px;
    }
    .nav-section { padding: 0 0.75rem; margin-bottom: 1.5rem; }
    .nav-item {
      display: flex; align-items: center; gap: 10px;
      padding: 9px 12px; border-radius: var(--radius-md);
      cursor: pointer; font-size: 13px; font-weight: 500;
      color: rgba(255,255,255,0.55);
      margin-bottom: 2px; transition: all 0.15s;
      text-decoration: none;
    }
    .nav-item:hover { background: var(--sidebar-hover); color: rgba(255,255,255,0.9); }
    .nav-item.active { background: var(--sidebar-active); color: white; }
    .nav-item svg { flex-shrink: 0; opacity: 0.8; }
    .nav-item.active svg { opacity: 1; }

    .sidebar-footer {
      margin-top: auto; padding: 0 0.75rem;
    }

    /* ── Main ── */
    .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

    /* ── Topbar ── */
    .topbar {
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      padding: 0 1.75rem; height: 60px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 40;
      box-shadow: var(--shadow-sm);
    }
    .topbar-left { display: flex; align-items: center; gap: 12px; }
    .topbar-title { font-size: 16px; font-weight: 700; color: var(--text-1); }
    .topbar-right { display: flex; align-items: center; gap: 10px; }

    /* ── Buttons ── */
    .btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 8px 16px; border-radius: var(--radius-md);
      font-size: 13px; font-weight: 600; cursor: pointer;
      border: 1px solid var(--border);
      background: var(--surface); color: var(--text-1);
      transition: all 0.15s; font-family: var(--font);
      text-decoration: none;
    }
    .btn:hover { background: var(--bg); }
    .btn-primary { background: var(--primary); color: white; border-color: var(--primary); }
    .btn-primary:hover { background: var(--primary-dk); border-color: var(--primary-dk); }
    .btn-danger { background: var(--danger-lt); color: var(--danger); border-color: #FECACA; }
    .btn-danger:hover { background: #FEE2E2; }
    .btn-sm { padding: 6px 12px; font-size: 12px; }
    .btn-xs { padding: 4px 9px; font-size: 11px; border-radius: var(--radius-sm); }

    /* ── Content ── */
    .content { flex: 1; padding: 1.75rem; overflow-y: auto; }

    /* ── Stats ── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px; margin-bottom: 1.75rem;
    }
    .stat-card {
      background: var(--surface);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border);
      padding: 1.25rem 1.25rem 1rem;
      box-shadow: var(--shadow-sm);
      position: relative; overflow: hidden;
    }
    .stat-card::before {
      content: ''; position: absolute;
      top: 0; left: 0; right: 0; height: 3px;
      background: var(--primary);
    }
    .stat-card:nth-child(2)::before { background: #7C3AED; }
    .stat-card:nth-child(3)::before { background: #D97706; }
    .stat-card:nth-child(4)::before { background: #059669; }
    .stat-icon {
      width: 36px; height: 36px; border-radius: var(--radius-md);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 12px; font-size: 16px;
    }
    .stat-icon-blue   { background: #EFF6FF; color: var(--primary); }
    .stat-icon-purple { background: #F5F3FF; color: #7C3AED; }
    .stat-icon-amber  { background: #FFFBEB; color: #D97706; }
    .stat-icon-green  { background: #ECFDF5; color: #059669; }
    .stat-label { font-size: 12px; color: var(--text-2); font-weight: 500; margin-bottom: 4px; }
    .stat-value { font-size: 28px; font-weight: 700; color: var(--text-1); line-height: 1; }
    .stat-sub   { font-size: 11px; color: var(--text-3); margin-top: 6px; }

    /* ── Panel ── */
    .panel {
      background: var(--surface);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border);
      box-shadow: var(--shadow-sm);
      overflow: hidden;
    }
    .panel-header {
      padding: 1rem 1.25rem;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
    }
    .panel-title { font-size: 14px; font-weight: 700; }
    .panel-subtitle { font-size: 12px; color: var(--text-2); }

    /* ── Search / Filter ── */
    .toolbar {
      display: flex; gap: 8px; align-items: center;
      padding: 0.875rem 1.25rem;
      border-bottom: 1px solid var(--border);
    }
    .search-wrap { position: relative; flex: 1; max-width: 320px; }
    .search-wrap svg { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--text-3); }
    .search-input {
      width: 100%; padding: 8px 12px 8px 34px;
      border: 1px solid var(--border); border-radius: var(--radius-md);
      font-size: 13px; background: var(--bg); color: var(--text-1);
      font-family: var(--font); transition: border 0.15s;
    }
    .search-input:focus { outline: none; border-color: var(--primary); background: white; }
    .filter-select {
      padding: 8px 10px; border: 1px solid var(--border);
      border-radius: var(--radius-md); font-size: 13px;
      background: var(--bg); color: var(--text-1);
      cursor: pointer; font-family: var(--font);
    }
    .filter-select:focus { outline: none; border-color: var(--primary); }

    /* ── Table ── */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    thead th {
      padding: 10px 1.25rem;
      font-size: 11px; font-weight: 600;
      text-transform: uppercase; letter-spacing: 0.06em;
      color: var(--text-2); text-align: left;
      background: #FAFBFD;
      border-bottom: 1px solid var(--border);
    }
    tbody td {
      padding: 12px 1.25rem;
      border-bottom: 1px solid var(--border);
      font-size: 13px; color: var(--text-1);
      vertical-align: middle;
    }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr { transition: background 0.1s; }
    tbody tr:hover td { background: #F8FAFF; }

    /* ── Avatar ── */
    .avatar {
      width: 34px; height: 34px; border-radius: 50%;
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 700; flex-shrink: 0;
    }
    .av-blue   { background: #DBEAFE; color: #1D4ED8; }
    .av-purple { background: #EDE9FE; color: #6D28D9; }
    .av-pink   { background: #FCE7F3; color: #9D174D; }
    .av-teal   { background: #CCFBF1; color: #0F766E; }
    .av-amber  { background: #FEF3C7; color: #92400E; }

    .cell-name { display: flex; align-items: center; gap: 10px; }
    .cell-name-text .nm { font-weight: 600; font-size: 13px; }
    .cell-name-text .nipd { font-size: 11px; color: var(--text-2); margin-top: 1px; }

    /* ── Badges ── */
    .badge {
      display: inline-flex; align-items: center;
      padding: 3px 8px; border-radius: 99px;
      font-size: 11px; font-weight: 600;
    }
    .badge-blue   { background: #DBEAFE; color: #1D4ED8; }
    .badge-purple { background: #EDE9FE; color: #6D28D9; }
    .badge-amber  { background: #FEF3C7; color: #92400E; }
    .badge-green  { background: #D1FAE5; color: #065F46; }
    .badge-rose   { background: #FFE4E6; color: #9F1239; }
    .badge-gray   { background: #F3F4F6; color: #374151; }
    .badge-teal   { background: #CCFBF1; color: #0F766E; }
    .badge-indigo { background: #E0E7FF; color: #3730A3; }

    .eskul-chip {
      display: inline-flex; align-items: center;
      padding: 3px 8px; border-radius: 99px;
      font-size: 11px; font-weight: 500;
      background: #EFF6FF; color: #1D4ED8;
      margin: 1px 2px;
    }

    /* ── Empty state ── */
    .empty-state {
      text-align: center; padding: 3.5rem 1rem;
      color: var(--text-2);
    }
    .empty-state svg { margin-bottom: 12px; opacity: 0.35; }
    .empty-state p { font-size: 13px; }

    /* ── Pagination ── */
    .pagination {
      display: flex; align-items: center; justify-content: space-between;
      padding: 0.875rem 1.25rem;
      border-top: 1px solid var(--border);
      font-size: 12px; color: var(--text-2);
    }
    .page-btns { display: flex; gap: 4px; }
    .page-btn {
      width: 30px; height: 30px; border-radius: var(--radius-sm);
      border: 1px solid var(--border); background: white;
      cursor: pointer; font-size: 12px; font-family: var(--font);
      display: flex; align-items: center; justify-content: center;
      transition: all 0.1s;
    }
    .page-btn:hover { background: var(--bg); }
    .page-btn.active { background: var(--primary); color: white; border-color: var(--primary); font-weight: 600; }
    .page-btn:disabled { opacity: 0.4; cursor: not-allowed; }

    /* ── User chip ── */
    .user-chip { display: flex; align-items: center; gap: 8px; }
    .user-chip .uc-name { font-size: 13px; font-weight: 600; }
    .user-chip .uc-role { font-size: 11px; color: var(--text-2); }

    /* ── Modal ── */
    .modal-overlay {
      position: fixed; inset: 0;
      background: rgba(15,23,42,0.55);
      backdrop-filter: blur(4px);
      display: flex; align-items: center; justify-content: center;
      z-index: 200; opacity: 0; pointer-events: none;
      transition: opacity 0.2s;
    }
    .modal-overlay.open { opacity: 1; pointer-events: all; }
    .modal {
      background: white; border-radius: var(--radius-lg);
      border: 1px solid var(--border);
      width: 520px; max-width: 95vw; max-height: 92vh;
      overflow-y: auto;
      box-shadow: 0 20px 60px rgba(0,0,0,0.15);
      transform: translateY(16px) scale(0.98);
      transition: transform 0.2s;
    }
    .modal-overlay.open .modal { transform: translateY(0) scale(1); }
    .modal-header {
      padding: 1.25rem 1.5rem 1rem;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; background: white; z-index: 1;
    }
    .modal-title { font-size: 15px; font-weight: 700; }
    .modal-close {
      width: 30px; height: 30px; border-radius: var(--radius-sm);
      border: 1px solid var(--border); background: transparent;
      cursor: pointer; font-size: 16px; color: var(--text-2);
      display: flex; align-items: center; justify-content: center;
      transition: all 0.15s;
    }
    .modal-close:hover { background: var(--bg); color: var(--text-1); }
    .modal-body { padding: 1.25rem 1.5rem; }
    .modal-footer {
      padding: 1rem 1.5rem;
      border-top: 1px solid var(--border);
      display: flex; justify-content: flex-end; gap: 8px;
      position: sticky; bottom: 0; background: white; z-index: 1;
    }

    /* ── Form ── */
    .form-group { margin-bottom: 1rem; }
    .form-label {
      display: block; font-size: 12px; font-weight: 600;
      color: var(--text-2); margin-bottom: 6px;
    }
    .form-label span { color: var(--danger); }
    .form-input, .form-select {
      width: 100%; padding: 9px 12px;
      border: 1px solid var(--border); border-radius: var(--radius-md);
      font-size: 13px; background: var(--bg);
      color: var(--text-1); font-family: var(--font);
      transition: border 0.15s, background 0.15s;
    }
    .form-input:focus, .form-select:focus {
      outline: none; border-color: var(--primary); background: white;
      box-shadow: 0 0 0 3px rgba(37,99,235,0.08);
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .form-error { font-size: 11px; color: var(--danger); margin-top: 4px; }

    /* ── Eskul picker ── */
    .eskul-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin-top: 6px; }
    .eskul-opt {
      border: 1.5px solid var(--border); border-radius: var(--radius-md);
      padding: 10px 12px; cursor: pointer;
      transition: all 0.15s; position: relative;
    }
    .eskul-opt:hover { border-color: var(--primary); background: #EFF6FF; }
    .eskul-opt.sel   { border-color: var(--primary); background: #EFF6FF; }
    .eskul-opt .eo-name { font-weight: 600; font-size: 13px; color: var(--text-1); }
    .eskul-opt .eo-tipe { font-size: 11px; color: var(--text-2); margin-top: 2px; }
    .eskul-opt .eo-check {
      position: absolute; top: 8px; right: 8px;
      width: 16px; height: 16px; border-radius: 50%;
      background: var(--primary); display: none;
      align-items: center; justify-content: center;
    }
    .eskul-opt.sel .eo-check { display: flex; }

    /* ── Loading spinner ── */
    .spinner {
      width: 18px; height: 18px;
      border: 2px solid rgba(255,255,255,0.3);
      border-top-color: white; border-radius: 50%;
      animation: spin 0.6s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* ── Toast ── */
    .toast-wrap {
      position: fixed; bottom: 1.5rem; right: 1.5rem;
      display: flex; flex-direction: column; gap: 8px; z-index: 500;
    }
    .toast {
      display: flex; align-items: center; gap: 10px;
      background: var(--text-1); color: white;
      padding: 12px 16px; border-radius: var(--radius-md);
      font-size: 13px; font-weight: 500;
      box-shadow: var(--shadow-md);
      animation: slideUp 0.25s ease;
      min-width: 260px;
    }
    .toast.success { background: #166534; }
    .toast.error   { background: #991B1B; }
    @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    @media (max-width: 768px) {
      .sidebar { display: none; }
      .stats-grid { grid-template-columns: 1fr 1fr; }
      .form-row { grid-template-columns: 1fr; }
      .eskul-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
<div class="app">

  <!-- ════ SIDEBAR ════ -->
  <aside class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-title">SMK BINA PUTRA MANDIRI</div>
      <div class="logo-sub">Sistem Informasi Kesiswaan</div>
    </div>
    <div class="nav-section">
      <div class="nav-label">Menu</div>
      <a href="{{ route('kesiswaan.dashboard') }}" class="nav-item active">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
          <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        Data Siswa
      </a>
    </div>
    <div class="sidebar-footer">
      <form method="POST" action="{{ route('kesiswaan.logout') }}" style="margin:0;">
        @csrf
        <button type="submit" class="nav-item" style="width:100%;border:none;cursor:pointer;background:transparent;text-align:left;color:rgba(255,255,255,0.55);">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
          </svg>
          Keluar
        </button>
      </form>
    </div>
  </aside>

  <!-- ════ MAIN ════ -->
  <div class="main">
    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-left">
        <span class="topbar-title">Data Siswa</span>
      </div>
      <div class="topbar-right">
        <div class="user-chip">
          <div class="avatar av-blue" style="width:32px;height:32px;font-size:12px;">
            {{ strtoupper(substr(Auth::guard('kesiswaan')->user()->name ?? 'K', 0, 1)) }}
          </div>
          <div>
            <div class="uc-name">{{ Auth::guard('kesiswaan')->user()->name ?? 'Kesiswaan' }}</div>
            <div class="uc-role">Administrator</div>
          </div>
        </div>
        <button class="btn btn-primary" onclick="openModal('tambahSiswa')">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah Siswa
        </button>
      </div>
    </div>

    <!-- Content -->
    <div class="content">

      <!-- Stats -->
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon stat-icon-blue">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div class="stat-label">Total Siswa</div>
          <div class="stat-value">{{ $stats['total'] }}</div>
          <div class="stat-sub">Semua kelas & jurusan</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon stat-icon-purple">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
          </div>
          <div class="stat-label">Ikut Eskul</div>
          <div class="stat-value">{{ $stats['ikut_eskul'] }}</div>
          <div class="stat-sub">Terdaftar di eskul</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon stat-icon-amber">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          </div>
          <div class="stat-label">Belum Eskul</div>
          <div class="stat-value">{{ $stats['belum_eskul'] }}</div>
          <div class="stat-sub">Belum terdaftar eskul</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon stat-icon-green">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <div class="stat-label">Total Eskul</div>
          <div class="stat-value">6</div>
          <div class="stat-sub">Eskul aktif tersedia</div>
        </div>
      </div>

      <!-- Table panel -->
      <div class="panel">
        <div class="panel-header">
          <div>
            <div class="panel-title">Daftar Siswa</div>
            <div class="panel-subtitle" id="jumlahLabel">Menampilkan {{ count($siswa) }} siswa</div>
          </div>
        </div>

        <div class="toolbar">
          <div class="search-wrap">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" class="search-input" id="searchInput" placeholder="Cari nama atau NIPD…" oninput="filterTable()">
          </div>
          <select class="filter-select" id="filterKelas" onchange="filterTable()">
            <option value="">Semua Kelas</option>
            @foreach($kelasList as $k)
              <option>{{ $k }}</option>
            @endforeach
          </select>
          <select class="filter-select" id="filterJurusan" onchange="filterTable()">
            <option value="">Semua Jurusan</option>
            <option>RPL</option>
            <option>TKJ</option>
            <option>DKV</option>
            <option>BIDI</option>
          </select>
          <select class="filter-select" id="filterEskul" onchange="filterTable()">
            <option value="">Semua Status</option>
            <option value="ya">Ikut Eskul</option>
            <option value="tidak">Belum Eskul</option>
          </select>
        </div>

        <div class="table-wrap">
          <table id="siswaTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Jenis Kelamin</th>
                <th>Ekstrakurikuler</th>
                <th style="text-align:center;">Aksi</th>
              </tr>
            </thead>
            <tbody id="siswaBody">
@forelse($siswa as $i => $s)
  @php
    $avColors = ['av-blue','av-purple','av-pink','av-teal','av-amber'];
    $av = $avColors[$i % count($avColors)];

    // ✅ FIX NAMA (ANTI ERROR)
    $namaSafe = trim($s->nama ?? '');
    $parts = array_filter(explode(' ', $namaSafe));

    $initials = 'NA';
    if (count($parts) > 0) {
      $initials = strtoupper(
        implode('', array_map(function($w) {
          return substr($w, 0, 1);
        }, array_slice($parts, 0, 2)))
      );
    }

    // ✅ FIX ESKUL
    $eskulList = is_array($s->eskul_list) ? $s->eskul_list : [];
  @endphp

  <tr
    data-nama="{{ strtolower($s->nama ?? '') }}"
    data-nipd="{{ $s->nipd ?? '' }}"
    data-kelas="{{ $s->kelas ?? '' }}"
    data-jurusan="{{ $s->jurusan ?? '' }}"
    data-eskul="{{ count($eskulList) > 0 ? 'ya' : 'tidak' }}"
  >
    <td>{{ $i + 1 }}</td>

    <td>
      <div class="cell-name">
        <div class="avatar {{ $av }}">{{ $initials }}</div>
        <div class="cell-name-text">
          <div class="nm">{{ $s->nama ?? '-' }}</div>
          <div class="nipd">{{ $s->nipd ?? '-' }}</div>
        </div>
      </div>
    </td>

    <td><span class="badge badge-gray">{{ $s->kelas ?? '-' }}</span></td>

    <td>
      <span class="badge
        @if(($s->jurusan ?? '') == 'RPL') badge-blue
        @elseif(($s->jurusan ?? '') == 'TKJ') badge-green
        @elseif(($s->jurusan ?? '') == 'DKV') badge-purple
        @else badge-amber
        @endif
      ">
        {{ $s->jurusan ?? '-' }}
      </span>
    </td>

    <td>{{ $s->jenis_kelamin ?? '-' }}</td>

    <td>
      @if(count($eskulList) === 0)
        <span>—</span>
      @else
        @foreach($eskulList as $e)
          <span class="eskul-chip">{{ $e }}</span>
        @endforeach
      @endif
    </td>

    <td style="text-align:center;">
      <button class="btn btn-xs"
        onclick="openDaftarEskul({{ $s->id }}, '{{ $s->nama ?? '' }}', {{ json_encode($eskulList) }})">
        + Eskul
      </button>

      <button class="btn btn-xs btn-danger"
        onclick="hapusSiswa({{ $s->id }}, '{{ $s->nama ?? '' }}')">
        Hapus
      </button>
    </td>
  </tr>

@empty
<tr>
  <td colspan="7" style="text-align:center;">Belum ada data siswa</td>
</tr>
@endforelse
</tbody>
          </table>
        </div>

        <div class="pagination">
          <span id="paginationInfo" style="font-size:12px;color:var(--text-2);"></span>
          <div class="page-btns" id="paginationBtns"></div>
        </div>
      </div>

    </div><!-- /content -->
  </div><!-- /main -->
</div><!-- /app -->

<!-- Toast container -->
<div class="toast-wrap" id="toastWrap"></div>

<!-- ════ MODAL: Tambah Siswa ════ -->
<div class="modal-overlay" id="modal-tambahSiswa">
  <div class="modal">
    <div class="modal-header">
      <span class="modal-title">Tambah Siswa Baru</span>
      <button class="modal-close" onclick="closeModal('tambahSiswa')">×</button>
    </div>
    <div class="modal-body">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Lengkap <span>*</span></label>
          <input type="text" class="form-input" id="f-nama" placeholder="Nama lengkap siswa">
          <div class="form-error" id="err-nama"></div>
        </div>
        <div class="form-group">
          <label class="form-label">NIPD <span>*</span></label>
          <input type="text" class="form-input" id="f-nipd" placeholder="Nomor Induk Peserta Didik">
          <div class="form-error" id="err-nipd"></div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Kelas <span>*</span></label>
          <select class="form-select" id="f-kelas">
            <option value="">-- Pilih Kelas --</option>
            <option>X</option><option>XI</option><option>XII</option>
          </select>
          <div class="form-error" id="err-kelas"></div>
        </div>
        <div class="form-group">
          <label class="form-label">Jurusan <span>*</span></label>
          <select class="form-select" id="f-jurusan">
            <option value="">-- Pilih Jurusan --</option>
            <option value="RPL">RPL</option>
            <option value="TKJ">TKJ</option>
            <option value="DKV">DKV</option>
            <option value="BIDI">BIDI</option>
          </select>
          <div class="form-error" id="err-jurusan"></div>
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Jenis Kelamin <span>*</span></label>
        <select class="form-select" id="f-jk">
          <option value="">-- Pilih --</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
        <div class="form-error" id="err-jk"></div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn" onclick="closeModal('tambahSiswa')">Batal</button>
      <button class="btn btn-primary" id="btnSimpanSiswa" onclick="simpanSiswa()">
        Simpan Siswa
      </button>
    </div>
  </div>
</div>

<!-- ════ MODAL: Daftarkan ke Eskul ════ -->
<div class="modal-overlay" id="modal-daftarEskul">
  <div class="modal">
    <div class="modal-header">
      <span class="modal-title">Daftarkan ke Ekstrakurikuler</span>
      <button class="modal-close" onclick="closeModal('daftarEskul')">×</button>
    </div>
    <div class="modal-body">
      <p style="font-size:13px;color:var(--text-2);margin-bottom:1rem;">
        Pilih eskul untuk <strong id="eskul-target-name" style="color:var(--text-1);"></strong>
      </p>
      <div class="eskul-grid" id="eskulPicker">
        @foreach([
          ['id'=>'pramuka',     'nama'=>'Pramuka',      'tipe'=>'Kepanduan'],
          ['id'=>'pmr',         'nama'=>'PMR',           'tipe'=>'Kesehatan'],
          ['id'=>'marchingband','nama'=>'Marching Band', 'tipe'=>'Seni Musik'],
          ['id'=>'paskibra',    'nama'=>'Paskibra',      'tipe'=>'Bela Negara'],
          ['id'=>'jurnal',      'nama'=>'Jurnal',        'tipe'=>'Jurnalistik'],
          ['id'=>'natbinari',   'nama'=>'Natbinari',     'tipe'=>'Akademik'],
        ] as $e)
          <div class="eskul-opt" id="opt-{{ $e['id'] }}" onclick="toggleEskul('{{ $e['id'] }}')">
            <div class="eo-name">{{ $e['nama'] }}</div>
            <div class="eo-tipe">{{ $e['tipe'] }}</div>
            <div class="eo-check">
              <svg width="9" height="9" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn" onclick="closeModal('daftarEskul')">Batal</button>
      <button class="btn btn-primary" id="btnSimpanEskul" onclick="simpanEskul()">Simpan</button>
    </div>
  </div>
</div>

<!-- ════ MODAL: Konfirmasi Hapus ════ -->
<div class="modal-overlay" id="modal-hapus">
  <div class="modal" style="width:380px;">
    <div class="modal-header">
      <span class="modal-title" style="color:var(--danger);">Hapus Siswa</span>
      <button class="modal-close" onclick="closeModal('hapus')">×</button>
    </div>
    <div class="modal-body">
      <p style="font-size:13px;color:var(--text-2);">
        Yakin ingin menghapus data siswa <strong id="hapus-nama" style="color:var(--text-1);"></strong>?
        Data yang dihapus tidak dapat dikembalikan.
      </p>
    </div>
    <div class="modal-footer">
      <button class="btn" onclick="closeModal('hapus')">Batal</button>
      <button class="btn btn-danger" id="btnKonfirmasiHapus" onclick="konfirmasiHapus()">Ya, Hapus</button>
    </div>
  </div>
</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

/* ── Toast ── */
function toast(msg, type = 'success') {
  const w = document.getElementById('toastWrap');
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.innerHTML = `${msg}`;
  w.appendChild(t);
  setTimeout(() => t.remove(), 3000);
}

/* ── Modal ── */
function openModal(id) { document.getElementById('modal-' + id).classList.add('open'); }
function closeModal(id) { document.getElementById('modal-' + id).classList.remove('open'); }

document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
});

/* ── DATA GLOBAL ── */
const PER_PAGE = 10;
let currentPage = 1;
let filteredRows = [];

/* ── FILTER ── */
function filterTable() {
  const q  = document.getElementById('searchInput').value.toLowerCase();
  const k  = document.getElementById('filterKelas').value;
  const j  = document.getElementById('filterJurusan').value;
  const es = document.getElementById('filterEskul').value;

  const rows = [...document.querySelectorAll('#siswaBody tr[data-nama]')];

  filteredRows = rows.filter(r => {
    return (
      (!q  || r.dataset.nama.includes(q) || r.dataset.nipd.includes(q)) &&
      (!k  || r.dataset.kelas === k) &&
      (!j  || r.dataset.jurusan === j) &&
      (!es || r.dataset.eskul === es)
    );
  });

  currentPage = 1; // reset page tiap filter
  renderTable();
}

/* ── RENDER TABLE ── */
function renderTable() {
  const allRows = document.querySelectorAll('#siswaBody tr[data-nama]');
  
  // sembunyikan semua dulu
  allRows.forEach(r => r.style.display = 'none');

  const start = (currentPage - 1) * PER_PAGE;
  const end   = start + PER_PAGE;

  filteredRows.slice(start, end).forEach(r => {
    r.style.display = '';
  });

  document.getElementById('jumlahLabel').textContent =
    `Menampilkan ${filteredRows.length} siswa`;

  renderPagination();
}

/* ── PAGINATION ── */
function renderPagination() {
  const total = filteredRows.length;
  const pages = Math.ceil(total / PER_PAGE) || 1;

  const info = document.getElementById('paginationInfo');
  const btns = document.getElementById('paginationBtns');

  info.textContent = `Halaman ${currentPage} dari ${pages}`;

  btns.innerHTML = `
    <button class="page-btn" onclick="goPage(${currentPage - 1})" ${currentPage <= 1 ? 'disabled' : ''}>‹</button>
    ${Array.from({length: pages}, (_,i) => `
      <button class="page-btn ${i+1===currentPage?'active':''}" onclick="goPage(${i+1})">${i+1}</button>
    `).join('')}
    <button class="page-btn" onclick="goPage(${currentPage + 1})" ${currentPage >= pages ? 'disabled' : ''}>›</button>
  `;
}

function goPage(p) {
  const max = Math.ceil(filteredRows.length / PER_PAGE);
  if (p < 1 || p > max) return;
  currentPage = p;
  renderTable();
}

/* ── INIT ── */
window.addEventListener('DOMContentLoaded', () => {
  filteredRows = [...document.querySelectorAll('#siswaBody tr[data-nama]')];
  renderTable();
});

/* ── TAMBAH SISWA ── */
function simpanSiswa() {
  const nama   = document.getElementById('f-nama').value.trim();
  const nipd   = document.getElementById('f-nipd').value.trim();
  const kelas  = document.getElementById('f-kelas').value;
  const jurusan= document.getElementById('f-jurusan').value;
  const jk     = document.getElementById('f-jk').value;

  if (!nama || !nipd || !kelas || !jurusan || !jk) {
    toast('Semua field wajib diisi', 'error');
    return;
  }

  fetch('{{ route("kesiswaan.siswa.store") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json', // 🔥 WAJIB
      'X-CSRF-TOKEN': CSRF
    },
    body: JSON.stringify({
      nama,
      nipd,
      kelas,
      jurusan,
      jenis_kelamin: jk
    })
  })
  .then(async res => {
    const text = await res.text();

    try {
      const data = JSON.parse(text);

      if (!res.ok) throw new Error(data.message);

      return data;
    } catch (e) {
      console.error('RESPON BUKAN JSON:', text);
      throw new Error('Server error (bukan JSON)');
    }
  })
  .then(data => {
    toast('Berhasil tambah siswa');
    setTimeout(() => location.reload(), 800);
  })
  .catch(err => {
    console.error(err);
    toast(err.message, 'error');
  });
}
/* ── HAPUS ── */
let hapusId = null;

function hapusSiswa(id, nama) {
  hapusId = id;
  document.getElementById('hapus-nama').textContent = nama;
  openModal('hapus');
}

function konfirmasiHapus() {
  fetch(`{{ url('kesiswaan/siswa') }}/${hapusId}`, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': CSRF }
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      toast('Berhasil dihapus');
      setTimeout(() => location.reload(), 800);
    }
  });
}

/* ── ESKUL ── */
let eskulSiswaId  = null;
let selectedEskul = [];

const eskulMap = {
  pramuka: 'Pramuka',
  pmr: 'PMR',
  marchingband: 'Marching Band',
  paskibra: 'Paskibra',
  jurnal: 'Jurnal',
  natbinari: 'Natbinari',
};

function openDaftarEskul(id, nama, currentEskul) {
  eskulSiswaId  = id;
  selectedEskul = [...currentEskul];

  document.getElementById('eskul-target-name').textContent = nama;

  Object.keys(eskulMap).forEach(k => {
    const el = document.getElementById('opt-' + k);
    el.classList.toggle('sel', selectedEskul.includes(eskulMap[k]));
  });

  openModal('daftarEskul');
}

function toggleEskul(key) {
  const nama = eskulMap[key];
  const idx = selectedEskul.indexOf(nama);

  if (idx > -1) selectedEskul.splice(idx, 1);
  else selectedEskul.push(nama);

  document.getElementById('opt-' + key).classList.toggle('sel');
}

function simpanEskul() {
  fetch(`{{ url('kesiswaan/siswa') }}/${eskulSiswaId}/eskul`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': CSRF
    },
    body: JSON.stringify({ eskul: selectedEskul })
  })
  .then(r => r.json())
  .then(data => {
    if (data.success) {
      toast('Eskul disimpan');
      setTimeout(() => location.reload(), 800);
    }
  });
}
</script>
</body>
</html>