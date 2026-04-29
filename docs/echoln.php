<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Method: Engine::echoln – RustPHP</title>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Syne:wght@400;600;700;800&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:        #0e1117;
      --surface:   #161b27;
      --surface2:  #1c2333;
      --border:    #2a3248;
      --accent:    #4da3ff;
      --accent2:   #7fbaff;
      --green:     #3ddc84;
      --red:       #ff5c5c;
      --text:      #d4ddf5;
      --muted:     #7b8ab8;
      --code-bg:   #111827;
      --radius:    8px;
    }

    html { scroll-behavior: smooth; }

    body {
      background: var(--bg);
      color: var(--text);
      font-family: 'Syne', sans-serif;
      font-size: 15px;
      line-height: 1.7;
      min-height: 100vh;
    }

    /* ── top nav ─────────────────────────────────────────── */
    .topbar {
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      padding: 0 32px;
      height: 52px;
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--muted);
      position: sticky;
      top: 0;
      z-index: 100;
      backdrop-filter: blur(12px);
    }
    .topbar a { color: var(--accent); text-decoration: none; transition: color .2s; }
    .topbar a:hover { color: var(--accent2); }
    .topbar .sep { color: var(--border); }
    .topbar .current { color: var(--text); font-weight: 600; }

    /* ── layout ──────────────────────────────────────────── */
    .wrapper {
      max-width: 900px;
      margin: 0 auto;
      padding: 48px 28px 80px;
      animation: fadeUp .5s ease both;
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(18px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* ── heading ─────────────────────────────────────────── */
    .page-title {
      font-size: clamp(24px, 5vw, 38px);
      font-weight: 800;
      letter-spacing: -.5px;
      color: #fff;
      margin-bottom: 6px;
    }
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: var(--accent);
      text-decoration: none;
      font-size: 13px;
      margin-bottom: 28px;
      transition: gap .2s, color .2s;
    }
    .back-link:hover { gap: 10px; color: var(--accent2); }
    .back-link svg { width: 14px; height: 14px; }

    .description {
      color: var(--muted);
      margin-bottom: 36px;
      font-size: 15px;
    }

    /* ── section label ───────────────────────────────────── */
    .section-label {
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 14px;
    }

    /* ── parameters table ────────────────────────────────── */
    .table-wrap {
      overflow-x: auto;
      border-radius: var(--radius);
      border: 1px solid var(--border);
      margin-bottom: 40px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    thead {
      background: var(--surface2);
    }
    thead th {
      padding: 14px 18px;
      text-align: left;
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--muted);
      border-bottom: 1px solid var(--border);
    }
    tbody tr {
      border-bottom: 1px solid var(--border);
      transition: background .15s;
    }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: rgba(77,163,255,.04); }
    tbody td {
      padding: 16px 18px;
      vertical-align: top;
      font-size: 14px;
    }
    td.name {
      font-family: 'JetBrains Mono', monospace;
      font-size: 13px;
      color: #e2ebff;
      white-space: nowrap;
    }
    td.type a, td.type span {
      color: var(--accent);
      text-decoration: none;
      font-family: 'JetBrains Mono', monospace;
      font-size: 12.5px;
    }
    td.type a:hover { color: var(--accent2); text-decoration: underline; }
    td.desc { color: var(--muted); }
    td.desc a { color: var(--accent); text-decoration: none; }
    td.desc a:hover { text-decoration: underline; }
    td.required .badge {
      display: inline-block;
      padding: 2px 10px;
      border-radius: 99px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: .5px;
    }
    .badge.optional {
      background: rgba(123,138,184,.15);
      color: var(--muted);
      border: 1px solid rgba(123,138,184,.25);
    }
    .badge.required-yes {
      background: rgba(61,220,132,.12);
      color: var(--green);
      border: 1px solid rgba(61,220,132,.3);
    }

    /* ── meta rows ───────────────────────────────────────── */
    .meta-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 14px;
      margin-bottom: 40px;
    }
    .meta-card {
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 16px 20px;
      display: flex;
      flex-direction: column;
      gap: 4px;
    }
    .meta-card .meta-label {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--muted);
    }
    .meta-card .meta-value {
      font-size: 15px;
      font-weight: 700;
    }
    .meta-value.yes { color: var(--green); }
    .meta-value.no  { color: var(--red); }
    .meta-value a   { color: var(--accent); text-decoration: none; }
    .meta-value a:hover { text-decoration: underline; }

    /* ── return type row ─────────────────────────────────── */
    .return-row {
      display: flex;
      align-items: center;
      gap: 10px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 14px 20px;
      margin-bottom: 40px;
      font-size: 14px;
      color: var(--muted);
    }
    .return-row a {
      color: var(--accent);
      font-family: 'JetBrains Mono', monospace;
      font-weight: 600;
      font-size: 13px;
      text-decoration: none;
    }
    .return-row a:hover { text-decoration: underline; }

    /* ── code block ──────────────────────────────────────── */
    .code-section { margin-bottom: 40px; }
    .code-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--surface2);
      border: 1px solid var(--border);
      border-bottom: none;
      border-radius: var(--radius) var(--radius) 0 0;
      padding: 10px 18px;
    }
    .code-header .lang-tag {
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--muted);
      text-transform: uppercase;
    }
    .copy-btn {
      background: none;
      border: 1px solid var(--border);
      color: var(--muted);
      font-family: 'Syne', sans-serif;
      font-size: 12px;
      padding: 4px 12px;
      border-radius: 5px;
      cursor: pointer;
      transition: all .2s;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .copy-btn:hover { border-color: var(--accent); color: var(--accent); }
    .copy-btn.copied { border-color: var(--green); color: var(--green); }

    pre {
      background: var(--code-bg);
      border: 1px solid var(--border);
      border-radius: 0 0 var(--radius) var(--radius);
      padding: 24px 22px;
      overflow-x: auto;
      font-family: 'JetBrains Mono', monospace;
      font-size: 13px;
      line-height: 1.8;
    }

    /* syntax colours */
    .kw  { color: #ff79c6; }
    .fn  { color: #50fa7b; }
    .str { color: #f1fa8c; }
    .cm  { color: #6272a4; font-style: italic; }
    .cls { color: #8be9fd; }
    .var { color: #bd93f9; }
    .op  { color: #ff79c6; }
    .num { color: #ffb86c; }
    .prop { color: #4da3ff; }
    .comment { color:#64748b; }
    .php { color:#f97316; }

    /* ── scrollbar ───────────────────────────────────────── */
    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: var(--bg); }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--muted); }

    /* ── responsive ──────────────────────────────────────── */
    @media (max-width: 600px) {
      .wrapper { padding: 32px 16px 60px; }
      .topbar { padding: 0 16px; font-size: 12px; }
    }
  </style>
</head>
<body>

<!-- top breadcrumb bar -->
<nav class="topbar">
  <a href="index.html">RustPHP</a>
  <span class="sep">/</span>
  <a href="methods.html">Methods</a>
  <span class="sep">/</span>
  <span class="current">Engine::echoln</span>
</nav>

<div class="wrapper">

  <!-- title -->
  <h1 class="page-title">Method: Engine::echoln</h1>

  <a class="back-link" href="methods.html">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
      <path d="M19 12H5M12 5l-7 7 7 7"/>
    </svg>
    Back to methods index
  </a>

  <!-- code example -->
  <div class="code-section">
    <p class="section-label">RustPHP Example
    </p>

    <div class="code-header">
      <span class="lang-tag">PHP</span>
      <button class="copy-btn" id="copyBtn" onclick="copyCode()">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
          <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/>
        </svg>
        Copy
      </button>
    </div>

    <pre id="codeBlock"><span class="php">&lt;?php</span>
    
<span class="kw">require</span> <span class="str">"vendor/autoload.php"</span>;

<span class="kw">use</span> <span class="cls">RustPHP</span>\<span class="cls">Engine</span>;

<span class="cls">Engine</span>::<span class="fn">echoln</span>(<span class="str">"Hello from RustPHP"</span>);
</pre>
  </div>

</div><!-- /wrapper -->

<script>
  function copyCode() {
    const raw = `<?php
require "vendor/autoload.php";

use RustPHP\Engine;

Engine::echoln("Hello from RustPHP");
`;

    navigator.clipboard.writeText(raw).then(() => {
      const btn = document.getElementById('copyBtn');
      btn.classList.add('copied');
      btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Copied!`;
      setTimeout(() => {
        btn.classList.remove('copied');
        btn.innerHTML = `<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></svg> Copy`;
      }, 2000);
    });
  }
</script>

</body>
</html>
