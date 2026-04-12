<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Inventory App API — Documentation</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=Syne:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<style>
  :root[data-theme="dark"] {
    --bg:          #0d0f12;
    --bg2:         #13161c;
    --bg3:         #1a1f28;
    --bg4:         #222733;
    --border:      #2a303e;
    --border2:     #363d50;
    --text:        #e8eaf0;
    --text2:       #9ba3b8;
    --text3:       #626a82;
    --accent:      #f97316;
    --accent2:     #fb923c;
    --accent-dim:  rgba(249,115,22,0.12);
    --accent-glow: rgba(249,115,22,0.25);
    --green:       #22c55e;
    --green-dim:   rgba(34,197,94,0.12);
    --red:         #ef4444;
    --red-dim:     rgba(239,68,68,0.12);
    --blue:        #60a5fa;
    --blue-dim:    rgba(96,165,250,0.12);
    --yellow:      #facc15;
    --yellow-dim:  rgba(250,204,21,0.12);
    --purple:      #a78bfa;
    --purple-dim:  rgba(167,139,250,0.12);
    --sidebar-w:   290px;
    --header-h:    60px;
  }
  :root[data-theme="light"] {
    --bg:          #f7f8fc;
    --bg2:         #ffffff;
    --bg3:         #eef0f7;
    --bg4:         #e4e7f2;
    --border:      #d4d8eb;
    --border2:     #bcc2d8;
    --text:        #1a1f2e;
    --text2:       #4a5270;
    --text3:       #8890aa;
    --accent:      #ea6c00;
    --accent2:     #f97316;
    --accent-dim:  rgba(234,108,0,0.1);
    --accent-glow: rgba(234,108,0,0.2);
    --green:       #16a34a;
    --green-dim:   rgba(22,163,74,0.1);
    --red:         #dc2626;
    --red-dim:     rgba(220,38,38,0.1);
    --blue:        #2563eb;
    --blue-dim:    rgba(37,99,235,0.1);
    --yellow:      #ca8a04;
    --yellow-dim:  rgba(202,138,4,0.1);
    --purple:      #7c3aed;
    --purple-dim:  rgba(124,58,237,0.1);
    --sidebar-w:   290px;
    --header-h:    60px;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body {
    font-family: 'Inter', sans-serif;
    background: var(--bg);
    color: var(--text);
    line-height: 1.6;
    min-height: 100vh;
    overflow-x: hidden;
  }
  /* ─── HEADER ─────────────────────────────────── */
  .header {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    height: var(--header-h);
    background: var(--bg2);
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; gap: 16px;
    padding: 0 20px;
  }
  .header-logo {
    font-family: 'Syne', sans-serif;
    font-weight: 800; font-size: 17px;
    color: var(--accent);
    letter-spacing: -0.3px;
    white-space: nowrap;
  }
  .header-logo span { color: var(--text); }
  .header-badge {
    background: var(--accent-dim);
    color: var(--accent);
    font-family: 'IBM Plex Mono', monospace;
    font-size: 10px; font-weight: 600;
    padding: 2px 8px; border-radius: 4px;
    border: 1px solid var(--accent-glow);
    letter-spacing: 0.5px;
  }
  .header-sep { flex: 1; }
  .header-search {
    display: flex; align-items: center; gap: 8px;
    background: var(--bg3);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0 12px; height: 36px;
    width: 240px; transition: border-color 0.2s;
  }
  .header-search:focus-within { border-color: var(--accent); }
  .header-search svg { color: var(--text3); flex-shrink: 0; }
  .header-search input {
    background: none; border: none; outline: none;
    color: var(--text); font-size: 13px; width: 100%;
    font-family: 'Inter', sans-serif;
  }
  .header-search input::placeholder { color: var(--text3); }
  .filter-pills { display: flex; gap: 6px; }
  .pill {
    padding: 4px 10px; border-radius: 6px; font-size: 11px;
    font-weight: 600; font-family: 'IBM Plex Mono', monospace;
    cursor: pointer; border: 1px solid transparent;
    transition: all 0.15s; letter-spacing: 0.3px;
  }
  .pill.active-pill { border-color: var(--border2); background: var(--bg3); color: var(--text2); }
  .pill[data-method="ALL"] { color: var(--text2); }
  .pill[data-method="ALL"].active { background: var(--bg4); border-color: var(--border2); color: var(--text); }
  .pill[data-method="GET"].active { background: var(--blue-dim); border-color: var(--blue); color: var(--blue); }
  .pill[data-method="POST"].active { background: var(--green-dim); border-color: var(--green); color: var(--green); }
  .pill[data-method="PUT"].active, .pill[data-method="PATCH"].active { background: var(--yellow-dim); border-color: var(--yellow); color: var(--yellow); }
  .pill[data-method="DELETE"].active { background: var(--red-dim); border-color: var(--red); color: var(--red); }
  .theme-btn {
    width: 36px; height: 36px; border-radius: 8px;
    border: 1px solid var(--border); background: var(--bg3);
    color: var(--text2); cursor: pointer; display: grid;
    place-items: center; transition: all 0.15s;
  }
  .theme-btn:hover { background: var(--bg4); color: var(--text); }
  /* ─── LAYOUT ─────────────────────────────────── */
  .layout { display: flex; padding-top: var(--header-h); min-height: 100vh; }
  /* ─── SIDEBAR ────────────────────────────────── */
  .sidebar {
    width: var(--sidebar-w); flex-shrink: 0;
    background: var(--bg2);
    border-right: 1px solid var(--border);
    position: fixed; top: var(--header-h); bottom: 0; left: 0;
    overflow-y: auto; padding: 16px 0;
  }
  .sidebar::-webkit-scrollbar { width: 4px; }
  .sidebar::-webkit-scrollbar-track { background: transparent; }
  .sidebar::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 4px; }
  .sidebar-section { margin-bottom: 4px; }
  .sidebar-cat {
    font-size: 10px; font-weight: 700; letter-spacing: 1.2px;
    color: var(--text3); padding: 8px 20px 4px;
    font-family: 'Syne', sans-serif; text-transform: uppercase;
  }
  .sidebar-item {
    display: flex; align-items: center; gap: 10px;
    padding: 7px 20px; cursor: pointer;
    transition: background 0.12s;
    border-left: 2px solid transparent;
    text-decoration: none;
  }
  .sidebar-item:hover { background: var(--bg3); }
  .sidebar-item.active {
    background: var(--accent-dim);
    border-left-color: var(--accent);
  }
  .sidebar-item.active .si-path { color: var(--accent); }
  .sidebar-item.hidden { display: none; }
  .si-method {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 9px; font-weight: 700; letter-spacing: 0.5px;
    width: 42px; text-align: center;
    padding: 2px 4px; border-radius: 4px; flex-shrink: 0;
  }
  .si-path { font-size: 12px; color: var(--text2); font-family: 'IBM Plex Mono', monospace; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
  /* ─── MAIN ───────────────────────────────────── */
  .main { margin-left: var(--sidebar-w); flex: 1; padding: 32px 40px; max-width: 960px; }
  /* ─── HERO ───────────────────────────────────── */
  .hero {
    margin-bottom: 40px;
    padding: 36px 40px;
    background: var(--bg2);
    border: 1px solid var(--border);
    border-radius: 16px;
    position: relative; overflow: hidden;
  }
  .hero::before {
    content: '';
    position: absolute; top: -60px; right: -60px;
    width: 250px; height: 250px;
    background: radial-gradient(circle, var(--accent-glow) 0%, transparent 70%);
    pointer-events: none;
  }
  .hero-tag {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px; font-weight: 600;
    color: var(--accent); letter-spacing: 1px;
    text-transform: uppercase; margin-bottom: 10px;
  }
  .hero h1 {
    font-family: 'Syne', sans-serif;
    font-size: 28px; font-weight: 800;
    color: var(--text); margin-bottom: 8px; line-height: 1.2;
  }
  .hero p { color: var(--text2); font-size: 14px; max-width: 520px; }
  .hero-meta { display: flex; gap: 24px; margin-top: 20px; }
  .hero-stat { display: flex; flex-direction: column; gap: 2px; }
  .hero-stat-val { font-family: 'IBM Plex Mono', monospace; font-size: 18px; font-weight: 600; color: var(--accent); }
  .hero-stat-label { font-size: 11px; color: var(--text3); letter-spacing: 0.3px; }
  .hero-url {
    margin-top: 16px;
    display: flex; align-items: center; gap: 10px;
    background: var(--bg3); border: 1px solid var(--border);
    border-radius: 8px; padding: 10px 14px;
  }
  .hero-url-label { font-size: 11px; color: var(--text3); font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; }
  .hero-url-val { font-family: 'IBM Plex Mono', monospace; font-size: 13px; color: var(--accent2); }
  /* ─── GROUP ──────────────────────────────────── */
  .group { margin-bottom: 48px; }
  .group-header {
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 16px; padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
  }
  .group-icon {
    width: 36px; height: 36px; border-radius: 8px;
    background: var(--accent-dim); border: 1px solid var(--accent-glow);
    display: grid; place-items: center;
    font-size: 16px;
  }
  .group-title { font-family: 'Syne', sans-serif; font-size: 18px; font-weight: 700; }
  .group-desc { font-size: 12px; color: var(--text3); margin-top: 2px; }
  .group-count {
    margin-left: auto;
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px; color: var(--text3);
    background: var(--bg3); border: 1px solid var(--border);
    padding: 2px 8px; border-radius: 20px;
  }
  /* ─── ENDPOINT CARD ──────────────────────────── */
  .ep-card {
    background: var(--bg2);
    border: 1px solid var(--border);
    border-radius: 12px;
    margin-bottom: 12px;
    overflow: hidden;
    transition: border-color 0.2s;
  }
  .ep-card:hover { border-color: var(--border2); }
  .ep-card.ep-open { border-color: var(--accent-glow); }
  .ep-card.ep-hidden { display: none; }
  .ep-header {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 18px;
    cursor: pointer;
    user-select: none;
  }
  .ep-header:hover { background: var(--bg3); }
  .method-badge {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 11px; font-weight: 700; letter-spacing: 0.5px;
    padding: 4px 10px; border-radius: 6px;
    flex-shrink: 0; min-width: 60px; text-align: center;
  }
  .m-GET    { background: var(--blue-dim);   color: var(--blue);   border: 1px solid rgba(96,165,250,0.3); }
  .m-POST   { background: var(--green-dim);  color: var(--green);  border: 1px solid rgba(34,197,94,0.3); }
  .m-PUT    { background: var(--yellow-dim); color: var(--yellow); border: 1px solid rgba(250,204,21,0.3); }
  .m-PATCH  { background: var(--purple-dim); color: var(--purple); border: 1px solid rgba(167,139,250,0.3); }
  .m-DELETE { background: var(--red-dim);    color: var(--red);    border: 1px solid rgba(239,68,68,0.3); }
  .ep-path {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 13px; color: var(--text);
    flex: 1;
  }
  .ep-path .path-param { color: var(--accent2); }
  .ep-summary { font-size: 12px; color: var(--text3); margin-left: auto; padding-left: 16px; white-space: nowrap; }
  .ep-auth-icon { font-size: 13px; title: 'Requires auth'; }
  .ep-chevron {
    color: var(--text3); flex-shrink: 0;
    transition: transform 0.2s;
  }
  .ep-open .ep-chevron { transform: rotate(180deg); }
  /* ─── EP BODY ────────────────────────────────── */
  .ep-body { display: none; border-top: 1px solid var(--border); }
  .ep-open .ep-body { display: block; }
  .ep-tabs {
    display: flex; gap: 0;
    border-bottom: 1px solid var(--border);
    padding: 0 18px;
    background: var(--bg3);
  }
  .ep-tab {
    padding: 10px 14px; font-size: 12px; font-weight: 500;
    color: var(--text3); cursor: pointer;
    border-bottom: 2px solid transparent; margin-bottom: -1px;
    transition: color 0.15s;
  }
  .ep-tab.active { color: var(--accent); border-bottom-color: var(--accent); }
  .ep-tab:hover:not(.active) { color: var(--text2); }
  .ep-panel { display: none; padding: 20px 18px; }
  .ep-panel.active { display: block; }
  /* ─── PARAMS TABLE ───────────────────────────── */
  .params-section { margin-bottom: 20px; }
  .params-label {
    font-size: 11px; font-weight: 700; letter-spacing: 0.8px;
    color: var(--text3); text-transform: uppercase;
    margin-bottom: 8px; display: flex; align-items: center; gap: 6px;
  }
  .params-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  th {
    text-align: left; padding: 8px 12px;
    font-size: 10px; font-weight: 700; letter-spacing: 0.8px;
    color: var(--text3); text-transform: uppercase;
    background: var(--bg3); border-bottom: 1px solid var(--border);
  }
  td { padding: 9px 12px; border-bottom: 1px solid var(--border); vertical-align: top; }
  tr:last-child td { border-bottom: none; }
  tr:hover td { background: var(--bg3); }
  .param-name { font-family: 'IBM Plex Mono', monospace; font-size: 12px; color: var(--accent2); }
  .param-type { font-family: 'IBM Plex Mono', monospace; font-size: 11px; color: var(--blue); }
  .param-req { font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 4px; letter-spacing: 0.3px; }
  .req-yes { background: var(--red-dim); color: var(--red); }
  .req-no  { background: var(--bg4);     color: var(--text3); }
  .param-desc { font-size: 12px; color: var(--text2); }
  /* ─── CODE BLOCK ─────────────────────────────── */
  .code-block {
    position: relative;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    margin-bottom: 16px;
    overflow: hidden;
  }
  .code-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 8px 14px;
    background: var(--bg3);
    border-bottom: 1px solid var(--border);
  }
  .code-lang {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 10px; font-weight: 700; letter-spacing: 0.5px;
    color: var(--text3); text-transform: uppercase;
  }
  .copy-btn {
    display: flex; align-items: center; gap: 5px;
    background: none; border: 1px solid var(--border);
    color: var(--text3); font-size: 11px; cursor: pointer;
    padding: 3px 10px; border-radius: 5px;
    transition: all 0.15s; font-family: 'Inter', sans-serif;
  }
  .copy-btn:hover { background: var(--bg4); color: var(--text); border-color: var(--border2); }
  .copy-btn.copied { color: var(--green); border-color: var(--green); background: var(--green-dim); }
  pre {
    padding: 16px; overflow-x: auto; font-size: 12px; line-height: 1.7;
    font-family: 'IBM Plex Mono', monospace;
  }
  pre::-webkit-scrollbar { height: 4px; }
  pre::-webkit-scrollbar-track { background: transparent; }
  pre::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 4px; }
  /* ─── JSON HIGHLIGHT ─────────────────────────── */
  .jk  { color: #f97316; }    /* key       */
  .js  { color: #86efac; }    /* string    */
  .jn  { color: #60a5fa; }    /* number    */
  .jb  { color: #c4b5fd; }    /* bool/null */
  .jp  { color: #9ba3b8; }    /* punctuation */
  /* ─── STATUS CODE ────────────────────────────── */
  .status-row { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
  .status-badge {
    font-family: 'IBM Plex Mono', monospace;
    font-size: 12px; font-weight: 700;
    padding: 3px 10px; border-radius: 6px;
  }
  .s-2xx { background: var(--green-dim); color: var(--green); border: 1px solid rgba(34,197,94,0.3); }
  .s-4xx { background: var(--red-dim);   color: var(--red);   border: 1px solid rgba(239,68,68,0.3); }
  .s-5xx { background: var(--yellow-dim);color: var(--yellow); border: 1px solid rgba(250,204,21,0.3); }
  .status-msg { font-size: 12px; color: var(--text2); }
  /* ─── TRY API ────────────────────────────────── */
  .try-panel { }
  .try-input-group { margin-bottom: 14px; }
  .try-label { font-size: 11px; font-weight: 600; color: var(--text3); letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 6px; }
  .try-input {
    width: 100%; background: var(--bg3);
    border: 1px solid var(--border); border-radius: 7px;
    color: var(--text); font-size: 13px; padding: 9px 12px;
    font-family: 'IBM Plex Mono', monospace; outline: none;
    transition: border-color 0.15s;
  }
  .try-input:focus { border-color: var(--accent); }
  textarea.try-input { min-height: 120px; resize: vertical; }
  .try-btn {
    background: var(--accent); color: #fff;
    border: none; border-radius: 8px;
    padding: 10px 20px; font-size: 13px; font-weight: 600;
    cursor: pointer; font-family: 'Inter', sans-serif;
    display: flex; align-items: center; gap: 8px;
    transition: background 0.15s;
  }
  .try-btn:hover { background: var(--accent2); }
  .try-btn:disabled { opacity: 0.5; cursor: not-allowed; }
  .try-result { margin-top: 16px; }
  .try-result-header { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
  .try-status { font-family: 'IBM Plex Mono', monospace; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 6px; }
  .try-time { font-size: 11px; color: var(--text3); }
  /* ─── HEADERS SECTION ────────────────────────── */
  .headers-chip {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--bg3); border: 1px solid var(--border);
    border-radius: 6px; padding: 5px 10px;
    font-size: 12px; font-family: 'IBM Plex Mono', monospace;
    margin-bottom: 6px; margin-right: 6px;
  }
  .headers-chip span:first-child { color: var(--text3); }
  .headers-chip span:last-child { color: var(--accent2); }
  /* ─── SCROLLBAR ──────────────────────────────── */
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-track { background: var(--bg); }
  ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 4px; }
  /* ─── ANIMATIONS ─────────────────────────────── */
  @keyframes fadeIn { from { opacity:0; transform:translateY(6px); } to { opacity:1; transform:translateY(0); } }
  .group { animation: fadeIn 0.3s ease; }
  /* ─── RESPONSIVE ─────────────────────────────── */
  @media (max-width: 800px) {
    :root { --sidebar-w: 0px; }
    .sidebar { display: none; }
    .main { margin-left: 0; padding: 20px 16px; }
    .filter-pills { display: none; }
    .header-search { width: 160px; }
    .hero { padding: 24px 20px; }
  }
  .no-results {
    text-align: center; padding: 40px;
    color: var(--text3); font-size: 14px;
    display: none;
  }
  .no-results.show { display: block; }
</style>
</head>
<body>

<!-- ═══════════ HEADER ═══════════ -->
<header class="header">
  <div class="header-logo">Inventory<span>App</span></div>
  <div class="header-badge">v1.0.0</div>
  <div class="header-sep"></div>
  <div class="header-search">
    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
    <input type="text" id="searchInput" placeholder="Search endpoints…"/>
  </div>
  <div class="filter-pills">
    <div class="pill active" data-method="ALL" onclick="filterMethod(this)">ALL</div>
    <div class="pill" data-method="GET" onclick="filterMethod(this)">GET</div>
    <div class="pill" data-method="POST" onclick="filterMethod(this)">POST</div>
    <div class="pill" data-method="PUT" onclick="filterMethod(this)">PUT</div>
    <div class="pill" data-method="DELETE" onclick="filterMethod(this)">DEL</div>
  </div>
  <button class="theme-btn" onclick="toggleTheme()" title="Toggle theme">
    <svg id="themeIcon" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
  </button>
</header>

<!-- ═══════════ LAYOUT ═══════════ -->
<div class="layout">

  <!-- ── SIDEBAR ── -->
  <nav class="sidebar" id="sidebar"></nav>

  <!-- ── MAIN ── -->
  <main class="main">

    <!-- HERO -->
    <div class="hero">
      <div class="hero-tag">REST API · Laravel Sanctum</div>
      <h1>Inventory App API</h1>
      <p>Dokumentasi lengkap untuk sistem manajemen aset tetap, aset habis pakai, mutasi, peminjaman, dan stock opname.</p>
      <div class="hero-meta">
        <div class="hero-stat"><span class="hero-stat-val" id="totalEndpoints">0</span><span class="hero-stat-label">Endpoints</span></div>
        <div class="hero-stat"><span class="hero-stat-val">10</span><span class="hero-stat-label">Groups</span></div>
        <div class="hero-stat"><span class="hero-stat-val">Sanctum</span><span class="hero-stat-label">Auth Type</span></div>
        <div class="hero-stat"><span class="hero-stat-val">JSON</span><span class="hero-stat-label">Format</span></div>
      </div>
      <div class="hero-url">
        <span class="hero-url-label">Base URL</span>
        <span class="hero-url-val" id="baseUrlDisplay">http://127.0.0.1:8000/api</span>
      </div>
    </div>

    <!-- CONTENT INJECTED BY JS -->
    <div id="apiContent"></div>
    <div class="no-results" id="noResults">No endpoints found matching your search.</div>

  </main>
</div>

<script>
// ════════════════════════════════════════════════════
//  API DATA
// ════════════════════════════════════════════════════
const BASE_URL = 'http://127.0.0.1:8000/api';

const API_GROUPS = [
  {
    id: 'auth',
    title: 'Authentication',
    icon: '🔐',
    description: 'Login, register, logout, dan informasi pengguna aktif',
    endpoints: [
      {
        method: 'POST', path: '/login', summary: 'Login pengguna',
        auth: false,
        description: 'Melakukan autentikasi pengguna dan mengembalikan Bearer token yang digunakan untuk mengakses endpoint yang dilindungi.',
        headers: [],
        pathParams: [],
        queryParams: [],
        bodyParams: [
          { name: 'email', type: 'string', required: true, desc: 'Alamat email terdaftar' },
          { name: 'password', type: 'string', required: true, desc: 'Password pengguna' },
        ],
        reqExample: `{
  "email": "admin@example.com",
  "password": "password123"
}`,
        resSuccess: `{
  "status": true,
  "message": "Login berhasil.",
  "data": {
    "user": {
      "id": 1,
      "name": "Admin Utama",
      "email": "admin@example.com",
      "role": "admin"
    },
    "token": "1|eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9..."
  }
}`,
        resError: `{
  "status": false,
  "message": "Email atau password salah.",
  "errors": {
    "email": ["Email atau password salah."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'POST', path: '/register', summary: 'Registrasi pengguna baru',
        auth: false,
        description: 'Mendaftarkan pengguna baru ke dalam sistem.',
        headers: [],
        pathParams: [],
        queryParams: [],
        bodyParams: [
          { name: 'name', type: 'string', required: true, desc: 'Nama lengkap pengguna' },
          { name: 'email', type: 'string', required: true, desc: 'Alamat email unik' },
          { name: 'password', type: 'string', required: true, desc: 'Password (min. 8 karakter)' },
          { name: 'role', type: 'string', required: false, desc: 'Role pengguna: admin, operator, user (default: user)' },
        ],
        reqExample: `{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "role": "user"
}`,
        resSuccess: `{
  "status": true,
  "message": "Registrasi berhasil.",
  "data": {
    "user": {
      "id": 2,
      "name": "John Doe",
      "email": "john@example.com",
      "role": "user"
    },
    "token": "2|AbCdEfGhIjKl..."
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "email": ["Email sudah terdaftar."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'POST', path: '/logout', summary: 'Logout pengguna',
        auth: true,
        description: 'Mencabut (revoke) token autentikasi pengguna yang sedang aktif.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [], queryParams: [], bodyParams: [],
        reqExample: `// Tidak memerlukan body request`,
        resSuccess: `{
  "status": true,
  "message": "Logout berhasil.",
  "data": null
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'GET', path: '/me', summary: 'Data pengguna aktif',
        auth: true,
        description: 'Mengambil informasi profil pengguna yang sedang terautentikasi.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [], queryParams: [], bodyParams: [],
        reqExample: `// Tidak memerlukan body request`,
        resSuccess: `{
  "status": true,
  "message": "Data pengguna aktif.",
  "data": {
    "id": 1,
    "name": "Admin Utama",
    "email": "admin@example.com",
    "role": "admin"
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
    ]
  },
  {
    id: 'locations',
    title: 'Locations',
    icon: '📍',
    description: 'Master data lokasi penyimpanan aset',
    endpoints: [
      {
        method: 'GET', path: '/locations', summary: 'Daftar semua lokasi',
        auth: true,
        description: 'Mengambil seluruh daftar lokasi yang terdaftar di sistem.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'search', type: 'string', required: false, desc: 'Filter berdasarkan nama lokasi' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data (default: 1)' },
          { name: 'per_page', type: 'integer', required: false, desc: 'Jumlah data per halaman (default: 15)' },
        ],
        bodyParams: [],
        reqExample: `GET /api/locations?search=gudang&page=1&per_page=10`,
        resSuccess: `{
  "status": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Gudang Utama",
        "code": "GU-001",
        "address": "Jl. Raya No. 1, Surabaya",
        "description": "Gudang penyimpanan aset utama",
        "created_at": "2024-01-01T00:00:00.000000Z"
      }
    ],
    "total": 1,
    "per_page": 15
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/locations', summary: 'Tambah lokasi baru',
        auth: true,
        description: 'Membuat data lokasi baru ke dalam sistem.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'location_code', type: 'string', required: true, desc: 'Kode unik lokasi' },
          { name: 'name', type: 'string', required: true, desc: 'Nama lokasi' },
          { name: 'description', type: 'string', required: false, desc: 'Deskripsi tambahan' },
        ],
        reqExample: `{
  "location_code": "GB-001",
  "name": "Gudang B",
  "description": "Gudang penyimpanan barang habis pakai"
}`,
        resSuccess: `{
  "status": true,
  "message": "Lokasi berhasil ditambahkan.",
  "data": {
    "id": 2,
    "location_code": "GB-001",
    "name": "Gudang B",
    "description": "Gudang penyimpanan barang habis pakai",
    "created_at": "2024-06-01T10:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "location_code": ["Kode lokasi sudah digunakan."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/locations/{id}', summary: 'Detail lokasi',
        auth: true,
        description: 'Mengambil detail satu lokasi berdasarkan ID.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID lokasi' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/locations/1`,
        resSuccess: `{
  "status": true,
  "message": "Detail lokasi.",
  "data": {
    "id": 1,
    "location_code": "GU-001",
    "name": "Gudang Utama",
    "description": "Gudang penyimpanan aset utama",
    "created_at": "2024-01-01T00:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Lokasi tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'PUT', path: '/locations/{id}', summary: 'Update lokasi',
        auth: true,
        description: 'Memperbarui data lokasi berdasarkan ID.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID lokasi yang akan diupdate' }],
        queryParams: [],
        bodyParams: [
          { name: 'location_code', type: 'string', required: false, desc: 'Kode unik lokasi' },
          { name: 'name', type: 'string', required: false, desc: 'Nama lokasi' },
          { name: 'description', type: 'string', required: false, desc: 'Deskripsi' },
        ],
        reqExample: `{
  "name": "Gudang Utama Renovasi",
  "description": "Gudang penyimpanan aset utama"
}`,
        resSuccess: `{
  "status": true,
  "message": "Lokasi berhasil diperbarui.",
  "data": {
    "id": 1,
    "location_code": "GU-001",
    "name": "Gudang Utama Renovasi",
    "description": "Gudang penyimpanan aset utama",
    "updated_at": "2024-06-05T08:30:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Lokasi tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'DELETE', path: '/locations/{id}', summary: 'Hapus lokasi',
        auth: true,
        description: 'Menghapus data lokasi dari sistem.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID lokasi yang akan dihapus' }],
        queryParams: [], bodyParams: [],
        reqExample: `DELETE /api/locations/2`,
        resSuccess: `{
  "status": true,
  "message": "Lokasi berhasil dihapus.",
  "data": null
}`,
        resError: `{
  "status": false,
  "message": "Lokasi tidak dapat dihapus karena masih memiliki aset terkait."
}`,
        errorStatus: '409'
      },
    ]
  },
  {
    id: 'suppliers',
    title: 'Suppliers',
    icon: '🏭',
    description: 'Master data pemasok/vendor aset',
    endpoints: [
      {
        method: 'GET', path: '/suppliers', summary: 'Daftar supplier',
        auth: true,
        description: 'Mengambil seluruh daftar supplier yang terdaftar.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'search', type: 'string', required: false, desc: 'Filter nama atau kode supplier' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/suppliers?search=PT+Teknologi`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "name": "PT Teknologi Maju",
        "code": "SUP-001",
        "contact_person": "Budi Santoso",
        "phone": "08123456789",
        "email": "info@teknologimaju.com",
        "address": "Jl. Pemuda No. 10, Jakarta",
        "created_at": "2024-01-05T00:00:00.000000Z"
      }
    ],
    "total": 1
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/suppliers', summary: 'Tambah supplier',
        auth: true,
        description: 'Mendaftarkan supplier baru ke dalam sistem.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'name', type: 'string', required: true, desc: 'Nama supplier/perusahaan' },
          { name: 'address', type: 'string', required: false, desc: 'Alamat lengkap' },
          { name: 'phone', type: 'string', required: false, desc: 'Nomor telepon' },
        ],
        reqExample: `{
  "name": "CV Sumber Jaya",
  "phone": "08987654321",
  "address": "Jl. Gajah Mada No. 88, Surabaya"
}`,
        resSuccess: `{
  "status": true,
  "message": "Supplier berhasil ditambahkan.",
  "data": {
    "id": 2,
    "name": "CV Sumber Jaya",
    "phone": "08987654321",
    "address": "Jl. Gajah Mada No. 88, Surabaya",
    "created_at": "2024-06-01T11:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "name": ["Nama supplier harus diisi."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/suppliers/{id}', summary: 'Detail supplier',
        auth: true,
        description: 'Mengambil detail satu supplier berdasarkan ID.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID supplier' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/suppliers/1`,
        resSuccess: `{
  "status": true,
  "message": "Detail supplier.",
  "data": {
    "id": 1,
    "name": "PT Teknologi Maju",
    "phone": "08123456789",
    "address": "Jl. Pemuda No. 10, Jakarta"
  }
}`,
        resError: `{
  "status": false,
  "message": "Supplier tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'PUT', path: '/suppliers/{id}', summary: 'Update supplier',
        auth: true,
        description: 'Memperbarui informasi supplier berdasarkan ID.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID supplier' }],
        queryParams: [],
        bodyParams: [
          { name: 'name', type: 'string', required: false, desc: 'Nama supplier' },
          { name: 'phone', type: 'string', required: false, desc: 'Nomor telepon' },
          { name: 'address', type: 'string', required: false, desc: 'Alamat supplier' },
        ],
        reqExample: `{
  "phone": "08111222333",
  "address": "Jl. Pemuda No. 11, Jakarta"
}`,
        resSuccess: `{
  "status": true,
  "message": "Supplier berhasil diperbarui.",
  "data": {
    "id": 1,
    "name": "PT Teknologi Maju",
    "phone": "08111222333",
    "address": "Jl. Pemuda No. 11, Jakarta"
  }
}`,
        resError: `{
  "status": false,
  "message": "Supplier tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'DELETE', path: '/suppliers/{id}', summary: 'Hapus supplier',
        auth: true,
        description: 'Menghapus data supplier dari sistem.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID supplier' }],
        queryParams: [], bodyParams: [],
        reqExample: `DELETE /api/suppliers/2`,
        resSuccess: `{
  "status": true,
  "message": "Supplier berhasil dihapus.",
  "data": null
}`,
        resError: `{
  "status": false,
  "message": "Supplier tidak ditemukan."
}`,
        errorStatus: '404'
      },
    ]
  },
  {
    id: 'fixed-assets',
    title: 'Fixed Assets',
    icon: '🖥️',
    description: 'Manajemen aset tetap perusahaan',
    endpoints: [
      {
        method: 'GET', path: '/fixed-assets', summary: 'Daftar aset tetap',
        auth: true,
        description: 'Mengambil daftar seluruh aset tetap dengan informasi lokasi dan supplier.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'search', type: 'string', required: false, desc: 'Filter nama atau kode aset' },
          { name: 'location_id', type: 'integer', required: false, desc: 'Filter berdasarkan lokasi' },
          { name: 'supplier_id', type: 'integer', required: false, desc: 'Filter berdasarkan supplier' },
          { name: 'condition', type: 'string', required: false, desc: 'Filter kondisi: good, damaged, maintenance' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/fixed-assets?condition=good&location_id=1`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "code": "AST-2024-001",
        "name": "Laptop Dell Latitude 5520",
        "brand": "Dell",
        "model": "Latitude 5520",
        "serial_number": "DL5520-XYZ123",
        "acquisition_date": "2024-01-15",
        "acquisition_price": 18500000,
        "condition": "good",
        "location": { "id": 1, "name": "Gudang Utama" },
        "supplier": { "id": 1, "name": "PT Teknologi Maju" }
      }
    ],
    "total": 1
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/fixed-assets', summary: 'Tambah aset tetap',
        auth: true,
        description: 'Mendaftarkan aset tetap baru ke dalam sistem inventaris. Kode aset akan auto-generated.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'name', type: 'string', required: true, desc: 'Nama/deskripsi aset' },
          { name: 'location_id', type: 'integer', required: false, desc: 'ID lokasi penyimpanan' },
          { name: 'brand', type: 'string', required: false, desc: 'Merek aset' },
          { name: 'purchase_year', type: 'integer', required: false, desc: 'Tahun perolehan (4 digit)' },
          { name: 'condition_status', type: 'string', required: false, desc: 'Kondisi: baik | rusak_ringan | rusak_berat' },
          { name: 'is_active', type: 'boolean', required: false, desc: 'Status aktif (true/false)' },
        ],
        reqExample: `{
  "name": "Printer HP LaserJet M404n",
  "brand": "HP",
  "location_id": 1,
  "purchase_year": 2024,
  "condition_status": "baik",
  "is_active": true
}`,
        resSuccess: `{
  "status": true,
  "message": "Aset tetap berhasil ditambahkan.",
  "data": {
    "id": 2,
    "asset_code": "INV-202406-0001",
    "name": "Printer HP LaserJet M404n",
    "brand": "HP",
    "location_id": 1,
    "condition_status": "baik",
    "is_active": true,
    "created_at": "2024-06-01T12:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "location_id": ["Lokasi tidak ditemukan."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/fixed-assets/{id}', summary: 'Detail aset tetap',
        auth: true,
        description: 'Mengambil detail lengkap satu aset tetap termasuk riwayat mutasi dan peminjaman.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID aset tetap' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/fixed-assets/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "code": "AST-2024-001",
    "name": "Laptop Dell Latitude 5520",
    "condition": "good",
    "acquisition_date": "2024-01-15",
    "acquisition_price": 18500000,
    "location": { "id": 1, "name": "Gudang Utama" },
    "supplier": { "id": 1, "name": "PT Teknologi Maju" },
    "mutations": [],
    "borrowings": []
  }
}`,
        resError: `{
  "status": false,
  "message": "Aset tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'PUT', path: '/fixed-assets/{id}', summary: 'Update aset tetap',
        auth: true,
        description: 'Memperbarui data aset tetap.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID aset tetap' }],
        queryParams: [],
        bodyParams: [
          { name: 'name', type: 'string', required: false, desc: 'Nama aset' },
          { name: 'location_id', type: 'integer', required: false, desc: 'ID lokasi baru' },
          { name: 'brand', type: 'string', required: false, desc: 'Merek aset' },
          { name: 'purchase_year', type: 'integer', required: false, desc: 'Tahun perolehan' },
          { name: 'condition_status', type: 'string', required: false, desc: 'Kondisi: baik | rusak_ringan | rusak_berat' },
          { name: 'is_active', type: 'boolean', required: false, desc: 'Status aktif' },
        ],
        reqExample: `{
  "condition_status": "rusak_ringan",
  "brand": "HP"
}`,
        resSuccess: `{
  "status": true,
  "message": "Aset tetap berhasil diperbarui.",
  "data": {
    "id": 1,
    "name": "Printer HP LaserJet M404n",
    "brand": "HP",
    "condition_status": "rusak_ringan",
    "updated_at": "2024-06-10T09:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Aset tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'DELETE', path: '/fixed-assets/{id}', summary: 'Hapus aset tetap',
        auth: true,
        description: 'Menghapus data aset tetap dari sistem.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID aset tetap' }],
        queryParams: [], bodyParams: [],
        reqExample: `DELETE /api/fixed-assets/3`,
        resSuccess: `{
  "status": true,
  "message": "Aset tetap berhasil dihapus.",
  "data": null
}`,
        resError: `{
  "status": false,
  "message": "Aset tidak dapat dihapus karena memiliki riwayat transaksi."
}`,
        errorStatus: '409'
      },
    ]
  },
  {
    id: 'mutations',
    title: 'Asset Mutations',
    icon: '🔄',
    description: 'Perpindahan lokasi atau kepemilikan aset tetap',
    endpoints: [
      {
        method: 'GET', path: '/asset-mutations', summary: 'Daftar mutasi aset',
        auth: true,
        description: 'Mengambil riwayat seluruh mutasi aset yang terjadi.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'asset_id', type: 'integer', required: false, desc: 'Filter berdasarkan aset' },
          { name: 'from_location_id', type: 'integer', required: false, desc: 'Lokasi asal' },
          { name: 'to_location_id', type: 'integer', required: false, desc: 'Lokasi tujuan' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/asset-mutations?asset_id=1`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "asset": { "id": 1, "code": "AST-2024-001", "name": "Laptop Dell" },
        "from_location": { "id": 1, "name": "Gudang Utama" },
        "to_location": { "id": 2, "name": "Kantor Pusat" },
        "mutation_date": "2024-04-10",
        "reason": "Keperluan WFH",
        "processed_by": "Admin Utama",
        "created_at": "2024-04-10T08:00:00.000000Z"
      }
    ],
    "total": 1
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/asset-mutations', summary: 'Buat mutasi aset',
        auth: true,
        description: 'Mencatat mutasi (perpindahan) aset dari satu lokasi ke lokasi lain. Lokasi aset akan otomatis diperbarui.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'fixed_asset_id', type: 'integer', required: true, desc: 'ID aset yang dimutasi' },
          { name: 'from_location_id', type: 'integer', required: false, desc: 'ID lokasi asal' },
          { name: 'to_location_id', type: 'integer', required: true, desc: 'ID lokasi tujuan' },
          { name: 'mutation_date', type: 'date', required: true, desc: 'Tanggal mutasi (Y-m-d)' },
          { name: 'notes', type: 'string', required: false, desc: 'Catatan tambahan' },
        ],
        reqExample: `{
  "fixed_asset_id": 1,
  "from_location_id": 1,
  "to_location_id": 3,
  "mutation_date": "2024-06-15",
  "notes": "Kondisi baik saat pemindahan"
}`,
        resSuccess: `{
  "status": true,
  "message": "Mutasi aset berhasil dicatat. Lokasi aset telah diperbarui.",
  "data": {
    "id": 2,
    "fixed_asset_id": 1,
    "from_location_id": 1,
    "to_location_id": 3,
    "mutation_date": "2024-06-15",
    "created_at": "2024-06-15T10:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "to_location_id": ["Lokasi tujuan harus berbeda dari lokasi asal."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/asset-mutations/{assetMutation}', summary: 'Detail mutasi aset',
        auth: true,
        description: 'Mengambil detail satu record mutasi aset.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'assetMutation', type: 'integer', required: true, desc: 'ID record mutasi' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/asset-mutations/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "asset": { "id": 1, "code": "AST-2024-001", "name": "Laptop Dell" },
    "from_location": { "id": 1, "name": "Gudang Utama" },
    "to_location": { "id": 2, "name": "Kantor Pusat" },
    "mutation_date": "2024-04-10",
    "reason": "Keperluan WFH"
  }
}`,
        resError: `{
  "status": false,
  "message": "Data mutasi tidak ditemukan."
}`,
        errorStatus: '404'
      },
    ]
  },
  {
    id: 'stock-opnames',
    title: 'Stock Opname',
    icon: '📋',
    description: 'Kegiatan penghitungan dan verifikasi stok aset secara berkala',
    endpoints: [
      {
        method: 'GET', path: '/stock-opnames', summary: 'Daftar stock opname',
        auth: true,
        description: 'Mengambil daftar seluruh kegiatan stock opname yang pernah dilakukan.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'year', type: 'integer', required: false, desc: 'Filter tahun pelaksanaan' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/stock-opnames?year=2024`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "title": "Stock Opname Q1 2024",
        "opname_date": "2024-03-31",
        "location": { "id": 1, "name": "Gudang Utama" },
        "total_items_checked": 25,
        "discrepancy_count": 2,
        "status": "completed",
        "conducted_by": "Admin Utama"
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/stock-opnames', summary: 'Buat stock opname',
        auth: true,
        description: 'Membuat record kegiatan stock opname baru untuk verifikasi kondisi aset.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'opnable_type', type: 'string', required: true, desc: 'Tipe model: App\\Models\\FixedAsset atau App\\Models\\Building' },
          { name: 'opnable_id', type: 'integer', required: true, desc: 'ID aset atau gedung yang diopname' },
          { name: 'opname_date', type: 'date', required: true, desc: 'Tanggal opname (Y-m-d)' },
          { name: 'actual_condition', type: 'string', required: true, desc: 'Kondisi aktual: baik | rusak_ringan | rusak_berat' },
          { name: 'notes', type: 'string', required: false, desc: 'Catatan opname' },
        ],
        reqExample: `{
  "opnable_type": "App\\Models\\FixedAsset",
  "opnable_id": 1,
  "opname_date": "2024-06-30",
  "actual_condition": "baik",
  "notes": "Kondisi fisik sesuai dengan data system"
}`,
        resSuccess: `{
  "status": true,
  "message": "Stock opname berhasil dicatat. Kondisi aset diperbarui.",
  "data": {
    "id": 2,
    "opnable_type": "App\\Models\\FixedAsset",
    "opnable_id": 1,
    "opname_date": "2024-06-30",
    "actual_condition": "baik",
    "user_id": 1,
    "created_at": "2024-06-30T10:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "opnable_id": ["Aset tidak ditemukan."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/stock-opnames/{stockOpname}', summary: 'Detail stock opname',
        auth: true,
        description: 'Mengambil detail lengkap satu record stock opname beserta item-itemnya.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'stockOpname', type: 'integer', required: true, desc: 'ID stock opname' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/stock-opnames/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "title": "Stock Opname Q1 2024",
    "opname_date": "2024-03-31",
    "location": { "id": 1, "name": "Gudang Utama" },
    "items": [
      {
        "asset": { "id": 1, "code": "AST-2024-001", "name": "Laptop Dell" },
        "physical_condition": "good",
        "system_condition": "good",
        "is_discrepancy": false
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Data stock opname tidak ditemukan."
}`,
        errorStatus: '404'
      },
    ]
  },
  {
    id: 'disposals',
    title: 'Asset Disposals',
    icon: '🗑️',
    description: 'Penghapusan dan pelepasan aset dari inventaris',
    endpoints: [
      {
        method: 'GET', path: '/asset-disposals', summary: 'Daftar disposal aset',
        auth: true,
        description: 'Mengambil daftar seluruh aset yang telah atau sedang dalam proses disposal.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'method', type: 'string', required: false, desc: 'Metode: sold | donated | scrapped | written_off' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/asset-disposals?method=sold`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "asset": { "id": 3, "code": "AST-2022-005", "name": "Laptop Lama" },
        "disposal_date": "2024-05-01",
        "method": "sold",
        "sale_price": 2500000,
        "reason": "Aset sudah melebihi umur ekonomis",
        "approved_by": "Direktur"
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/asset-disposals', summary: 'Buat disposal aset',
        auth: true,
        description: 'Mencatat proses disposal (penghapusan/pelepasan) aset dari inventaris. Aset akan dinonaktifkan.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'disposable_type', type: 'string', required: true, desc: 'Tipe model: App\\Models\\FixedAsset atau App\\Models\\Building' },
          { name: 'disposable_id', type: 'integer', required: true, desc: 'ID aset yang akan di-dispose' },
          { name: 'disposal_date', type: 'date', required: true, desc: 'Tanggal disposal (Y-m-d)' },
          { name: 'reason', type: 'string', required: true, desc: 'Alasan: rusak | dijual | hilang | diganti' },
          { name: 'notes', type: 'string', required: false, desc: 'Catatan tambahan' },
        ],
        reqExample: `{
  "disposable_type": "App\\Models\\FixedAsset",
  "disposable_id": 4,
  "disposal_date": "2024-06-20",
  "reason": "rusak",
  "notes": "Kerusakan akibat kebakaran kecil"
}`,
        resSuccess: `{
  "status": true,
  "message": "Disposal aset berhasil dicatat. Aset telah dinonaktifkan.",
  "data": {
    "id": 2,
    "disposable_type": "App\\Models\\FixedAsset",
    "disposable_id": 4,
    "disposal_date": "2024-06-20",
    "reason": "rusak",
    "user_id": 1,
    "created_at": "2024-06-20T10:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "reason": ["Alasan harus salah satu dari: rusak, dijual, hilang, diganti."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/asset-disposals/{assetDisposal}', summary: 'Detail disposal aset',
        auth: true,
        description: 'Mengambil detail record disposal satu aset.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'assetDisposal', type: 'integer', required: true, desc: 'ID record disposal' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/asset-disposals/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "asset": { "id": 3, "code": "AST-2022-005", "name": "Laptop Lama" },
    "disposal_date": "2024-05-01",
    "method": "sold",
    "sale_price": 2500000,
    "reason": "Aset sudah melebihi umur ekonomis"
  }
}`,
        resError: `{
  "status": false,
  "message": "Data disposal tidak ditemukan."
}`,
        errorStatus: '404'
      },
    ]
  },
  {
    id: 'borrowings',
    title: 'Borrowings',
    icon: '🤝',
    description: 'Peminjaman dan pengembalian aset tetap',
    endpoints: [
      {
        method: 'GET', path: '/borrowings', summary: 'Daftar peminjaman',
        auth: true,
        description: 'Mengambil daftar seluruh transaksi peminjaman aset.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'status', type: 'string', required: false, desc: 'Filter: borrowed | returned | overdue' },
          { name: 'borrower_name', type: 'string', required: false, desc: 'Filter nama peminjam' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/borrowings?status=borrowed`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "asset": { "id": 1, "code": "AST-2024-001", "name": "Laptop Dell" },
        "borrower_name": "Siti Rahayu",
        "borrower_department": "Marketing",
        "borrow_date": "2024-05-10",
        "expected_return_date": "2024-05-20",
        "actual_return_date": null,
        "status": "borrowed"
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/borrowings', summary: 'Buat peminjaman',
        auth: true,
        description: 'Mencatat peminjaman aset oleh pegawai atau pihak tertentu. Dapat meminjam multiple items dalam satu record.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'borrower_name', type: 'string', required: true, desc: 'Nama peminjam' },
          { name: 'borrow_date', type: 'date', required: true, desc: 'Tanggal pinjam (Y-m-d)' },
          { name: 'expected_return_date', type: 'date', required: true, desc: 'Perkiraan tanggal kembali (Y-m-d)' },
          { name: 'details', type: 'array', required: true, desc: 'Array item yang dipinjam (min. 1)' },
          { name: 'details[].fixed_asset_id', type: 'integer', required: true, desc: 'ID aset yang dipinjam' },
          { name: 'details[].condition_when_borrowed', type: 'string', required: false, desc: 'Kondisi saat peminjaman: baik | rusak_ringan | rusak_berat (default: baik)' },
        ],
        reqExample: `{
  "borrower_name": "Eko Prasetyo",
  "borrow_date": "2024-06-01",
  "expected_return_date": "2024-06-07",
  "details": [
    {
      "fixed_asset_id": 2,
      "condition_when_borrowed": "baik"
    }
  ]
}`,
        resSuccess: `{
  "status": true,
  "message": "Peminjaman berhasil dibuat.",
  "data": {
    "id": 2,
    "borrow_code": "BRW-20240601-ABC5D",
    "borrower_name": "Eko Prasetyo",
    "borrow_date": "2024-06-01",
    "expected_return_date": "2024-06-07",
    "status": "dipinjam",
    "details": [
      {
        "fixed_asset_id": 2,
        "condition_when_borrowed": "baik"
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "details": ["Minimal harus ada 1 item yang dipinjam."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/borrowings/{borrowing}', summary: 'Detail peminjaman',
        auth: true,
        description: 'Mengambil detail satu record peminjaman aset.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'borrowing', type: 'integer', required: true, desc: 'ID record peminjaman' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/borrowings/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "asset": { "id": 1, "code": "AST-2024-001", "name": "Laptop Dell" },
    "borrower_name": "Siti Rahayu",
    "borrower_department": "Marketing",
    "borrow_date": "2024-05-10",
    "expected_return_date": "2024-05-20",
    "actual_return_date": null,
    "status": "overdue",
    "purpose": "Kebutuhan presentasi"
  }
}`,
        resError: `{
  "status": false,
  "message": "Data peminjaman tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'PATCH', path: '/borrowings/{borrowing}/return', summary: 'Kembalikan aset',
        auth: true,
        description: 'Mencatat pengembalian aset yang telah dipinjam.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [{ name: 'borrowing', type: 'integer', required: true, desc: 'ID record peminjaman' }],
        queryParams: [],
        bodyParams: [
          { name: 'actual_return_date', type: 'date', required: true, desc: 'Tanggal pengembalian aktual (Y-m-d)' },
        ],
        reqExample: `{
  "actual_return_date": "2024-06-08"
}`,
        resSuccess: `{
  "status": true,
  "message": "Aset berhasil dikembalikan.",
  "data": {
    "id": 2,
    "status": "dikembalikan",
    "actual_return_date": "2024-06-08"
  }
}`,
        resError: `{
  "status": false,
  "message": "Peminjaman sudah pernah dikembalikan."
}`,
        errorStatus: '422'
      },
    ]
  },
  {
    id: 'consumables',
    title: 'Consumables',
    icon: '📦',
    description: 'Master data barang habis pakai',
    endpoints: [
      {
        method: 'GET', path: '/consumables', summary: 'Daftar barang habis pakai',
        auth: true,
        description: 'Mengambil daftar seluruh barang habis pakai dengan stok terkini.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'search', type: 'string', required: false, desc: 'Filter nama barang' },
          { name: 'low_stock', type: 'boolean', required: false, desc: 'Filter stok menipis (true/false)' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/consumables?low_stock=true`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "code": "CON-001",
        "name": "Kertas HVS A4 80gsm",
        "unit": "rim",
        "current_stock": 15,
        "minimum_stock": 10,
        "is_low_stock": false,
        "supplier": { "id": 1, "name": "PT Teknologi Maju" }
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/consumables', summary: 'Tambah barang habis pakai',
        auth: true,
        description: 'Mendaftarkan barang habis pakai baru ke dalam sistem.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'item_code', type: 'string', required: true, desc: 'Kode unik barang' },
          { name: 'name', type: 'string', required: true, desc: 'Nama barang' },
          { name: 'unit', type: 'string', required: true, desc: 'Satuan: pcs | rim | box | kg | liter | dll' },
          { name: 'min_stock', type: 'integer', required: false, desc: 'Stok minimum sebelum peringatan' },
        ],
        reqExample: `{
  "item_code": "CON-002",
  "name": "Tinta Printer HP 680 Black",
  "unit": "pcs",
  "min_stock": 5
}`,
        resSuccess: `{
  "status": true,
  "message": "Barang habis pakai berhasil ditambahkan.",
  "data": {
    "id": 2,
    "item_code": "CON-002",
    "name": "Tinta Printer HP 680 Black",
    "unit": "pcs",
    "current_stock": 0,
    "min_stock": 5,
    "created_at": "2024-06-01T11:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "item_code": ["Kode barang sudah digunakan."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/consumables/{id}', summary: 'Detail barang habis pakai',
        auth: true,
        description: 'Mengambil detail satu barang habis pakai.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID barang' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/consumables/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "code": "CON-001",
    "name": "Kertas HVS A4 80gsm",
    "unit": "rim",
    "current_stock": 15,
    "minimum_stock": 10
  }
}`,
        resError: `{
  "status": false,
  "message": "Barang tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'PUT', path: '/consumables/{id}', summary: 'Update barang habis pakai',
        auth: true,
        description: 'Memperbarui informasi barang habis pakai.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID barang' }],
        queryParams: [],
        bodyParams: [
          { name: 'name', type: 'string', required: false, desc: 'Nama barang' },
          { name: 'unit', type: 'string', required: false, desc: 'Satuan barang' },
          { name: 'minimum_stock', type: 'integer', required: false, desc: 'Stok minimum' },
        ],
        reqExample: `{
  "minimum_stock": 8,
  "description": "Update stok minimum"
}`,
        resSuccess: `{
  "status": true,
  "message": "Barang berhasil diperbarui",
  "data": {
    "id": 1,
    "minimum_stock": 8,
    "updated_at": "2024-06-10T08:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Barang tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'DELETE', path: '/consumables/{id}', summary: 'Hapus barang habis pakai',
        auth: true,
        description: 'Menghapus barang habis pakai dari sistem.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'id', type: 'integer', required: true, desc: 'ID barang' }],
        queryParams: [], bodyParams: [],
        reqExample: `DELETE /api/consumables/3`,
        resSuccess: `{
  "status": true,
  "message": "Barang berhasil dihapus"
}`,
        resError: `{
  "status": false,
  "message": "Barang tidak dapat dihapus karena memiliki riwayat transaksi."
}`,
        errorStatus: '409'
      },
    ]
  },
  {
    id: 'consumable-inbounds',
    title: 'Consumable Inbounds',
    icon: '📥',
    description: 'Penerimaan barang habis pakai (barang masuk)',
    endpoints: [
      {
        method: 'GET', path: '/consumable-inbounds', summary: 'Daftar barang masuk',
        auth: true,
        description: 'Mengambil riwayat seluruh penerimaan barang habis pakai.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'consumable_id', type: 'integer', required: false, desc: 'Filter berdasarkan barang' },
          { name: 'supplier_id', type: 'integer', required: false, desc: 'Filter berdasarkan supplier' },
          { name: 'date_from', type: 'date', required: false, desc: 'Tanggal mulai filter (Y-m-d)' },
          { name: 'date_to', type: 'date', required: false, desc: 'Tanggal akhir filter (Y-m-d)' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/consumable-inbounds?date_from=2024-06-01&date_to=2024-06-30`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "consumable": { "id": 1, "code": "CON-001", "name": "Kertas HVS A4" },
        "supplier": { "id": 1, "name": "PT Teknologi Maju" },
        "quantity": 50,
        "unit_price": 45000,
        "total_price": 2250000,
        "received_date": "2024-06-05",
        "invoice_number": "INV/2024/06/001"
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/consumable-inbounds', summary: 'Catat barang masuk',
        auth: true,
        description: 'Mencatat penerimaan barang habis pakai dan otomatis menambah stok.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'consumable_id', type: 'integer', required: true, desc: 'ID barang yang diterima' },
          { name: 'supplier_id', type: 'integer', required: false, desc: 'ID supplier pengirim' },
          { name: 'inbound_date', type: 'date', required: true, desc: 'Tanggal diterima (Y-m-d)' },
          { name: 'quantity', type: 'integer', required: true, desc: 'Jumlah barang diterima' },
          { name: 'notes', type: 'string', required: false, desc: 'Catatan penerimaan' },
        ],
        reqExample: `{
  "consumable_id": 2,
  "supplier_id": 1,
  "inbound_date": "2024-06-15",
  "quantity": 20,
  "notes": "Pengiriman sesuai PO"
}`,
        resSuccess: `{
  "status": true,
  "message": "Barang masuk berhasil dicatat. Stok telah diperbarui.",
  "data": {
    "id": 2,
    "consumable_id": 2,
    "supplier_id": 1,
    "inbound_date": "2024-06-15",
    "quantity": 20,
    "created_at": "2024-06-15T10:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Validasi gagal",
  "errors": {
    "quantity": ["Jumlah harus lebih dari 0."]
  }
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/consumable-inbounds/{consumableInbound}', summary: 'Detail barang masuk',
        auth: true,
        description: 'Mengambil detail satu record penerimaan barang.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'consumableInbound', type: 'integer', required: true, desc: 'ID record barang masuk' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/consumable-inbounds/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "consumable": { "id": 1, "name": "Kertas HVS A4" },
    "quantity": 50,
    "unit_price": 45000,
    "total_price": 2250000,
    "received_date": "2024-06-05"
  }
}`,
        resError: `{
  "status": false,
  "message": "Data tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'DELETE', path: '/consumable-inbounds/{consumableInbound}', summary: 'Hapus barang masuk',
        auth: true,
        description: 'Menghapus record penerimaan barang dan mengurangi stok kembali.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'consumableInbound', type: 'integer', required: true, desc: 'ID record barang masuk' }],
        queryParams: [], bodyParams: [],
        reqExample: `DELETE /api/consumable-inbounds/3`,
        resSuccess: `{
  "status": true,
  "message": "Data barang masuk berhasil dihapus"
}`,
        resError: `{
  "status": false,
  "message": "Data tidak dapat dihapus karena stok sudah terpakai."
}`,
        errorStatus: '409'
      },
    ]
  },
  {
    id: 'consumable-outbounds',
    title: 'Consumable Outbounds',
    icon: '📤',
    description: 'Pengeluaran barang habis pakai (barang keluar)',
    endpoints: [
      {
        method: 'GET', path: '/consumable-outbounds', summary: 'Daftar barang keluar',
        auth: true,
        description: 'Mengambil riwayat seluruh pengeluaran barang habis pakai.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [],
        queryParams: [
          { name: 'consumable_id', type: 'integer', required: false, desc: 'Filter berdasarkan barang' },
          { name: 'date_from', type: 'date', required: false, desc: 'Tanggal mulai (Y-m-d)' },
          { name: 'date_to', type: 'date', required: false, desc: 'Tanggal akhir (Y-m-d)' },
          { name: 'page', type: 'integer', required: false, desc: 'Halaman data' },
        ],
        bodyParams: [],
        reqExample: `GET /api/consumable-outbounds?consumable_id=1&date_from=2024-06-01`,
        resSuccess: `{
  "status": true,
  "data": {
    "data": [
      {
        "id": 1,
        "consumable": { "id": 1, "name": "Kertas HVS A4" },
        "quantity": 5,
        "issue_date": "2024-06-10",
        "issued_to": "Departemen Marketing",
        "requested_by": "Rini Susanti",
        "purpose": "Keperluan cetak laporan"
      }
    ]
  }
}`,
        resError: `{
  "status": false,
  "message": "Unauthenticated."
}`,
        errorStatus: '401'
      },
      {
        method: 'POST', path: '/consumable-outbounds', summary: 'Catat barang keluar',
        auth: true,
        description: 'Mencatat pengeluaran barang habis pakai dan otomatis mengurangi stok.',
        headers: ['Authorization: Bearer {token}', 'Content-Type: application/json'],
        pathParams: [], queryParams: [],
        bodyParams: [
          { name: 'consumable_id', type: 'integer', required: true, desc: 'ID barang yang dikeluarkan' },
          { name: 'outbound_date', type: 'date', required: true, desc: 'Tanggal pengeluaran (Y-m-d)' },
          { name: 'quantity', type: 'integer', required: true, desc: 'Jumlah barang dikeluarkan' },
          { name: 'recipient_name', type: 'string', required: true, desc: 'Nama penerima' },
          { name: 'notes', type: 'string', required: false, desc: 'Catatan tambahan' },
        ],
        reqExample: `{
  "consumable_id": 1,
  "outbound_date": "2024-06-18",
  "quantity": 3,
  "recipient_name": "Ahmad Fauzi"
}`,
        resSuccess: `{
  "status": true,
  "message": "Barang keluar berhasil dicatat. Stok telah dikurangi.",
  "data": {
    "id": 2,
    "consumable_id": 1,
    "outbound_date": "2024-06-18",
    "quantity": 3,
    "recipient_name": "Ahmad Fauzi",
    "created_at": "2024-06-18T10:00:00.000000Z"
  }
}`,
        resError: `{
  "status": false,
  "message": "Stok tidak mencukupi. Stok tersedia: 2, diminta: 3."
}`,
        errorStatus: '422'
      },
      {
        method: 'GET', path: '/consumable-outbounds/{consumableOutbound}', summary: 'Detail barang keluar',
        auth: true,
        description: 'Mengambil detail satu record pengeluaran barang.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'consumableOutbound', type: 'integer', required: true, desc: 'ID record barang keluar' }],
        queryParams: [], bodyParams: [],
        reqExample: `GET /api/consumable-outbounds/1`,
        resSuccess: `{
  "status": true,
  "data": {
    "id": 1,
    "consumable": { "id": 1, "name": "Kertas HVS A4" },
    "quantity": 5,
    "issue_date": "2024-06-10",
    "issued_to": "Departemen Marketing",
    "purpose": "Keperluan cetak laporan"
  }
}`,
        resError: `{
  "status": false,
  "message": "Data tidak ditemukan."
}`,
        errorStatus: '404'
      },
      {
        method: 'DELETE', path: '/consumable-outbounds/{consumableOutbound}', summary: 'Hapus barang keluar',
        auth: true,
        description: 'Menghapus record pengeluaran barang dan mengembalikan stok.',
        headers: ['Authorization: Bearer {token}'],
        pathParams: [{ name: 'consumableOutbound', type: 'integer', required: true, desc: 'ID record barang keluar' }],
        queryParams: [], bodyParams: [],
        reqExample: `DELETE /api/consumable-outbounds/2`,
        resSuccess: `{
  "status": true,
  "message": "Data barang keluar berhasil dihapus"
}`,
        resError: `{
  "status": false,
  "message": "Data tidak ditemukan."
}`,
        errorStatus: '404'
      },
    ]
  },
];

// ════════════════════════════════════════════════════
//  HELPERS
// ════════════════════════════════════════════════════
function methodColor(m) {
  return { GET:'m-GET', POST:'m-POST', PUT:'m-PUT', PATCH:'m-PATCH', DELETE:'m-DELETE' }[m] || 'm-GET';
}

function highlightJSON(raw) {
  if (!raw || raw.startsWith('GET') || raw.startsWith('DELETE')) {
    return `<span style="color:var(--text2)">${escHtml(raw)}</span>`;
  }
  const s = escHtml(raw);
  return s
    .replace(/"([\w\s\-\.\/]+)":/g, '<span class="jk">"$1"</span>:')
    .replace(/: "(.*?)"/g, ': <span class="js">"$1"</span>')
    .replace(/: (\d+\.?\d*)/g, ': <span class="jn">$1</span>')
    .replace(/: (true|false|null)/g, ': <span class="jb">$1</span>')
    .replace(/([{}\[\],])/g, '<span class="jp">$1</span>');
}

function escHtml(str) {
  return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}

function renderPath(path) {
  return path.replace(/\{([^}]+)\}/g, '<span class="path-param">{$1}</span>');
}

function slugify(str) {
  return str.toLowerCase().replace(/[^a-z0-9]/g, '-');
}

function statusClass(code) {
  const n = parseInt(code);
  if (n >= 200 && n < 300) return 's-2xx';
  if (n >= 400 && n < 500) return 's-4xx';
  return 's-5xx';
}

// ════════════════════════════════════════════════════
//  RENDER
// ════════════════════════════════════════════════════
function renderEndpoint(ep, groupId, idx) {
  const id = `${groupId}-ep-${idx}`;
  const hasPath = ep.pathParams.length > 0;
  const hasQuery = ep.queryParams.length > 0;
  const hasBody = ep.bodyParams.length > 0;

  const pathRow = (p) => `<tr>
    <td><span class="param-name">${p.name}</span></td>
    <td><span class="param-type">${p.type}</span></td>
    <td><span class="param-req ${p.required ? 'req-yes' : 'req-no'}">${p.required ? 'Required' : 'Optional'}</span></td>
    <td class="param-desc">${p.desc}</td>
  </tr>`;

  const table = (rows) => `<table>
    <thead><tr><th>Parameter</th><th>Type</th><th>Required</th><th>Description</th></tr></thead>
    <tbody>${rows.map(pathRow).join('')}</tbody>
  </table>`;

  const headerChips = ep.headers.length
    ? ep.headers.map(h => {
        const [k,...rest] = h.split(': ');
        return `<div class="headers-chip"><span>${k}:</span><span>${rest.join(': ')}</span></div>`;
      }).join('')
    : `<span style="color:var(--text3);font-size:12px;">Tidak memerlukan header tambahan</span>`;

  return `
<div class="ep-card" id="${id}" data-method="${ep.method}" data-summary="${ep.summary.toLowerCase()} ${ep.path.toLowerCase()}">
  <div class="ep-header" onclick="toggleEp('${id}')">
    <span class="method-badge ${methodColor(ep.method)}">${ep.method}</span>
    <span class="ep-path">${renderPath(ep.path)}</span>
    <span class="ep-summary">${ep.summary}</span>
    ${ep.auth ? '<span class="ep-auth-icon" title="Requires Bearer Token">🔒</span>' : ''}
    <svg class="ep-chevron" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
  </div>
  <div class="ep-body">
    <div class="ep-tabs">
      <div class="ep-tab active" onclick="switchTab(this,'${id}','overview')">Overview</div>
      <div class="ep-tab" onclick="switchTab(this,'${id}','params')">Parameters</div>
      <div class="ep-tab" onclick="switchTab(this,'${id}','response')">Responses</div>
      <div class="ep-tab" onclick="switchTab(this,'${id}','try')">Try It</div>
    </div>
    <!-- OVERVIEW -->
    <div class="ep-panel active" id="${id}-overview">
      <p style="font-size:13px;color:var(--text2);margin-bottom:16px;">${ep.description}</p>
      <div class="params-section">
        <div class="params-label">Headers</div>
        ${headerChips}
      </div>
      <div class="params-section" style="margin-top:16px;">
        <div class="params-label">Request Example</div>
        <div class="code-block">
          <div class="code-header">
            <span class="code-lang">JSON / HTTP</span>
            <button class="copy-btn" onclick="copyCode(this)">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
              Copy
            </button>
          </div>
          <pre>${highlightJSON(ep.reqExample)}</pre>
        </div>
      </div>
    </div>
    <!-- PARAMS -->
    <div class="ep-panel" id="${id}-params">
      ${hasPath ? `<div class="params-section"><div class="params-label">Path Parameters</div>${table(ep.pathParams)}</div>` : ''}
      ${hasQuery ? `<div class="params-section"><div class="params-label">Query Parameters</div>${table(ep.queryParams)}</div>` : ''}
      ${hasBody ? `<div class="params-section"><div class="params-label">Body Parameters</div>${table(ep.bodyParams)}</div>` : ''}
      ${!hasPath && !hasQuery && !hasBody ? `<p style="color:var(--text3);font-size:13px;">Endpoint ini tidak memiliki parameter.</p>` : ''}
    </div>
    <!-- RESPONSE -->
    <div class="ep-panel" id="${id}-response">
      <div class="params-label">Success Response</div>
      <div class="status-row">
        <span class="status-badge s-2xx">200 OK</span>
        <span class="status-msg">Request berhasil diproses</span>
      </div>
      <div class="code-block">
        <div class="code-header">
          <span class="code-lang">JSON</span>
          <button class="copy-btn" onclick="copyCode(this)">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            Copy
          </button>
        </div>
        <pre>${highlightJSON(ep.resSuccess)}</pre>
      </div>
      <div class="params-label" style="margin-top:16px;">Error Response</div>
      <div class="status-row">
        <span class="status-badge ${statusClass(ep.errorStatus)}">${ep.errorStatus}</span>
        <span class="status-msg">Request gagal</span>
      </div>
      <div class="code-block">
        <div class="code-header">
          <span class="code-lang">JSON</span>
          <button class="copy-btn" onclick="copyCode(this)">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
            Copy
          </button>
        </div>
        <pre>${highlightJSON(ep.resError)}</pre>
      </div>
    </div>
    <!-- TRY IT -->
    <div class="ep-panel try-panel" id="${id}-try">
      <div class="try-input-group">
        <div class="try-label">Base URL</div>
        <input class="try-input" type="text" id="${id}-baseurl" value="${BASE_URL}" />
      </div>
      ${ep.auth ? `<div class="try-input-group">
        <div class="try-label">Authorization Token</div>
        <input class="try-input" type="text" id="${id}-token" placeholder="Bearer your-token-here" />
      </div>` : ''}
      ${ep.pathParams.length ? `<div class="try-input-group">
        <div class="try-label">Path Parameters</div>
        ${ep.pathParams.map(p => `
          <div style="margin-bottom:6px;">
            <div style="font-size:11px;color:var(--text3);margin-bottom:4px;">{${p.name}}</div>
            <input class="try-input" type="text" id="${id}-path-${p.name}" placeholder="Enter ${p.name}..." />
          </div>`).join('')}
      </div>` : ''}
      ${hasBody ? `<div class="try-input-group">
        <div class="try-label">Request Body</div>
        <textarea class="try-input" id="${id}-body">${ep.reqExample.startsWith('{') ? ep.reqExample : ''}</textarea>
      </div>` : ''}
      <button class="try-btn" onclick="tryApi('${id}','${ep.method}','${ep.path}',${ep.auth},[${ep.pathParams.map(p=>`'${p.name}'`).join(',')}],${hasBody})">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg>
        Send Request
      </button>
      <div class="try-result" id="${id}-result" style="display:none;">
        <div class="params-label" style="margin-top:16px;">Response</div>
        <div class="try-result-header">
          <span class="try-status" id="${id}-res-status"></span>
          <span class="try-time" id="${id}-res-time"></span>
        </div>
        <div class="code-block">
          <div class="code-header">
            <span class="code-lang">JSON</span>
            <button class="copy-btn" onclick="copyCode(this)">Copy</button>
          </div>
          <pre id="${id}-res-body"></pre>
        </div>
      </div>
    </div>
  </div>
</div>`;
}

function renderGroup(group) {
  const eps = group.endpoints.map((ep, i) => renderEndpoint(ep, group.id, i)).join('');
  return `
<div class="group" id="group-${group.id}">
  <div class="group-header">
    <div class="group-icon">${group.icon}</div>
    <div>
      <div class="group-title">${group.title}</div>
      <div class="group-desc">${group.description}</div>
    </div>
    <div class="group-count">${group.endpoints.length} endpoints</div>
  </div>
  ${eps}
</div>`;
}

function buildSidebar() {
  const sidebar = document.getElementById('sidebar');
  let total = 0;
  sidebar.innerHTML = API_GROUPS.map(group => {
    total += group.endpoints.length;
    const items = group.endpoints.map((ep, i) => {
      const id = `${group.id}-ep-${i}`;
      return `<a class="sidebar-item" href="#${id}" onclick="highlightSidebar(this)" data-method="${ep.method}" data-summary="${ep.summary.toLowerCase()} ${ep.path.toLowerCase()}">
        <span class="si-method ${methodColor(ep.method)}">${ep.method}</span>
        <span class="si-path">${ep.path}</span>
      </a>`;
    }).join('');
    return `<div class="sidebar-section">
      <div class="sidebar-cat">${group.icon} ${group.title}</div>
      ${items}
    </div>`;
  }).join('');
  document.getElementById('totalEndpoints').textContent = total;
}

function buildContent() {
  document.getElementById('apiContent').innerHTML = API_GROUPS.map(renderGroup).join('');
}

// ════════════════════════════════════════════════════
//  INTERACTIONS
// ════════════════════════════════════════════════════
function toggleEp(id) {
  const card = document.getElementById(id);
  card.classList.toggle('ep-open');
}

function switchTab(tab, cardId, panelName) {
  const body = tab.closest('.ep-body');
  body.querySelectorAll('.ep-tab').forEach(t => t.classList.remove('active'));
  body.querySelectorAll('.ep-panel').forEach(p => p.classList.remove('active'));
  tab.classList.add('active');
  document.getElementById(`${cardId}-${panelName}`).classList.add('active');
}

function copyCode(btn) {
  const pre = btn.closest('.code-block').querySelector('pre');
  const text = pre.textContent;
  navigator.clipboard.writeText(text).then(() => {
    btn.textContent = '✓ Copied!';
    btn.classList.add('copied');
    setTimeout(() => {
      btn.innerHTML = `<svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Copy`;
      btn.classList.remove('copied');
    }, 2000);
  });
}

function highlightSidebar(el) {
  document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
  el.classList.add('active');
}

let activeMethod = 'ALL';
function filterMethod(pill) {
  document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
  pill.classList.add('active');
  activeMethod = pill.dataset.method;
  applyFilters();
}

function applyFilters() {
  const query = document.getElementById('searchInput').value.toLowerCase();
  let visibleGroups = 0;

  document.querySelectorAll('.group').forEach(group => {
    let visibleCards = 0;
    group.querySelectorAll('.ep-card').forEach(card => {
      const method = card.dataset.method;
      const summary = card.dataset.summary || '';
      const methodOk = activeMethod === 'ALL' || method === activeMethod;
      const searchOk = !query || summary.includes(query);
      if (methodOk && searchOk) {
        card.classList.remove('ep-hidden');
        visibleCards++;
      } else {
        card.classList.add('ep-hidden');
      }
    });
    group.style.display = visibleCards > 0 ? '' : 'none';
    if (visibleCards > 0) visibleGroups++;
  });

  // sidebar sync
  document.querySelectorAll('.sidebar-item').forEach(item => {
    const method = item.dataset.method;
    const summary = item.dataset.summary || '';
    const methodOk = activeMethod === 'ALL' || method === activeMethod;
    const searchOk = !query || summary.includes(query);
    item.classList.toggle('hidden', !(methodOk && searchOk));
  });

  document.getElementById('noResults').classList.toggle('show', visibleGroups === 0);
}

document.getElementById('searchInput').addEventListener('input', applyFilters);

// ── THEME ──
function toggleTheme() {
  const root = document.documentElement;
  const isDark = root.getAttribute('data-theme') === 'dark';
  root.setAttribute('data-theme', isDark ? 'light' : 'dark');
  const icon = document.getElementById('themeIcon');
  icon.innerHTML = isDark
    ? '<circle cx="12" cy="12" r="5"/><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>'
    : '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>';
}

// ── TRY API ──
async function tryApi(id, method, path, auth, pathParamNames, hasBody) {
  const base = document.getElementById(`${id}-baseurl`).value.trim();
  let url = base + path;

  pathParamNames.forEach(name => {
    const val = document.getElementById(`${id}-path-${name}`)?.value.trim() || `{${name}}`;
    url = url.replace(`{${name}}`, val);
  });

  const headers = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
  if (auth) {
    const tok = document.getElementById(`${id}-token`)?.value.trim();
    if (tok) headers['Authorization'] = tok.startsWith('Bearer') ? tok : `Bearer ${tok}`;
  }

  let body = undefined;
  if (hasBody && method !== 'GET' && method !== 'DELETE') {
    const rawBody = document.getElementById(`${id}-body`)?.value.trim();
    if (rawBody) body = rawBody;
  }

  const btn = document.querySelector(`#${id}-try .try-btn`);
  btn.disabled = true;
  btn.textContent = 'Sending…';

  const t0 = Date.now();
  try {
    const res = await fetch(url, { method, headers, body });
    const elapsed = Date.now() - t0;
    const data = await res.text();
    let pretty;
    try { pretty = JSON.stringify(JSON.parse(data), null, 2); } catch { pretty = data; }

    const statusEl = document.getElementById(`${id}-res-status`);
    statusEl.textContent = `${res.status} ${res.statusText}`;
    statusEl.className = `try-status ${statusClass(res.status)}`;
    document.getElementById(`${id}-res-time`).textContent = `${elapsed}ms`;
    document.getElementById(`${id}-res-body`).innerHTML = highlightJSON(pretty);
    document.getElementById(`${id}-result`).style.display = 'block';
  } catch (err) {
    document.getElementById(`${id}-res-status`).textContent = 'Network Error';
    document.getElementById(`${id}-res-status`).className = 'try-status s-4xx';
    document.getElementById(`${id}-res-time`).textContent = '';
    document.getElementById(`${id}-res-body`).textContent = err.message;
    document.getElementById(`${id}-result`).style.display = 'block';
  } finally {
    btn.disabled = false;
    btn.innerHTML = `<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"/></svg> Send Request`;
  }
}

// ════════════════════════════════════════════════════
//  INIT
// ════════════════════════════════════════════════════
buildSidebar();
buildContent();
</script>
</body>
</html>