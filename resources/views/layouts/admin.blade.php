{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="bs">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — @yield('title', 'Dashboard') · E74JLM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Barlow:wght@300;400;600;700&family=Barlow+Condensed:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root {
    --rk-green: #1a6b2f;
    --rk-green-dim: #2d9e4f;
    --rk-green-dark: #e8f5ec;
    --rk-bg: #f8f9fa;
    --rk-bg2: #ffffff;
    --rk-bg3: #f1f3f5;
    --rk-text: #1a1a1a;
    --rk-muted: #6c757d;
    --rk-border: #dee2e6;
    --sidebar-w: 240px;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
body { background: var(--rk-bg); color: var(--rk-text); font-family: 'Barlow', sans-serif; display: flex; min-height: 100vh; }
body::before { content:''; position:fixed; inset:0; background:repeating-linear-gradient(0deg,transparent,transparent 2px,rgba(0,0,0,.05) 2px,rgba(0,0,0,.05) 4px); pointer-events:none; z-index:9999; }

/* SIDEBAR */
.sidebar {
    width: var(--sidebar-w); flex-shrink: 0;
    background: var(--rk-bg2); border-right: 1px solid var(--rk-border);
    position: fixed; top: 0; left: 0; bottom: 0;
    display: flex; flex-direction: column; overflow-y: auto; z-index: 100;
}
.sidebar-brand {
    padding: 1.5rem 1.25rem 1.25rem;
    border-bottom: 1px solid var(--rk-border);
    font-family: 'Share Tech Mono', monospace;
}
.sidebar-brand .callsign { color: var(--rk-green); font-size: 1rem; letter-spacing: .1em; }
.sidebar-brand .sub { color: var(--rk-muted); font-size: .65rem; letter-spacing: .15em; margin-top: 2px; }
.sidebar-blink { display:inline-block;width:6px;height:6px;background:var(--rk-green);border-radius:50%;animation:blink 1.2s step-end infinite;margin-left:4px;vertical-align:middle; }
@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}

.sidebar-section { font-family: 'Share Tech Mono', monospace; font-size: .6rem; color: var(--rk-muted); letter-spacing: .2em; padding: 1.25rem 1.25rem .5rem; }
.sidebar-link {
    display: flex; align-items: center; gap: 10px;
    padding: .65rem 1.25rem; text-decoration: none;
    color: var(--rk-muted); font-size: .82rem; font-weight: 600;
    transition: all .15s; border-left: 2px solid transparent;
}
.sidebar-link:hover { color: var(--rk-green); background: var(--rk-bg3); }
.sidebar-link.active { color: var(--rk-green); border-left-color: var(--rk-green); background: var(--rk-green-dark); }
.sidebar-link i { font-size: 1rem; width: 18px; }

.sidebar-badge {
    margin-left: auto; background: var(--rk-green); color: #080e06;
    font-size: .62rem; font-weight: 700; padding: 1px 6px;
    border-radius: 10px; font-family: 'Share Tech Mono', monospace;
}

.sidebar-footer {
    margin-top: auto; padding: 1rem 1.25rem;
    border-top: 1px solid var(--rk-border);
    font-family: 'Share Tech Mono', monospace; font-size: .68rem; color: var(--rk-muted);
}

/* MAIN */
.admin-main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

.admin-topbar {
    height: 56px; border-bottom: 1px solid var(--rk-border);
    background: rgba(8,14,6,.95); backdrop-filter: blur(8px);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 2rem; position: sticky; top: 0; z-index: 50;
}
.admin-topbar-title { font-family: 'Barlow Condensed', sans-serif; font-size: 1.3rem; font-weight: 700; color: #fff; }
.admin-topbar-right { display: flex; align-items: center; gap: 1rem; }
.admin-topbar-user { font-family: 'Share Tech Mono', monospace; font-size: .72rem; color: var(--rk-muted); }

.admin-content { padding: 2rem; flex: 1; }

/* CARDS */
.rk-card { background: var(--rk-bg2); border: 1px solid var(--rk-border); border-radius: 0; }
.rk-stat-card { background: var(--rk-bg2); border: 1px solid var(--rk-border); padding: 1.5rem; }
.rk-stat-card .num { font-family: 'Barlow Condensed', sans-serif; font-size: 2.5rem; font-weight: 800; color: var(--rk-green); line-height: 1; }
.rk-stat-card .label { font-family: 'Share Tech Mono', monospace; font-size: .65rem; color: var(--rk-muted); letter-spacing: .15em; margin-top: .35rem; }

/* TABLE */
.rk-table { width: 100%; border-collapse: collapse; }
.rk-table th { font-family: 'Share Tech Mono', monospace; font-size: .65rem; color: var(--rk-muted); letter-spacing: .15em; text-transform: uppercase; padding: .75rem 1rem; border-bottom: 1px solid var(--rk-border); text-align: left; }
.rk-table td { padding: .75rem 1rem; border-bottom: 1px solid var(--rk-border); font-size: .88rem; vertical-align: middle; }
.rk-table tr:hover td { background: var(--rk-bg3); }
.rk-table tr:last-child td { border-bottom: none; }

/* BUTTONS */
.btn-rk { background: var(--rk-green); color: #ffffff; border-radius: 0; font-weight: 700; font-size: .8rem; letter-spacing: .08em; text-transform: uppercase; border: none; }
.btn-rk:hover { background: #55ff30; color: #080e06; }
.btn-rk-outline { border: 1px solid var(--rk-green-dim); color: var(--rk-green); background: transparent; border-radius: 0; font-size: .8rem; letter-spacing: .08em; text-transform: uppercase; }
.btn-rk-outline:hover { background: var(--rk-green-dark); color: var(--rk-green); }
.btn-rk-danger { border: 1px solid #5a0808; color: #ff6b6b; background: transparent; border-radius: 0; font-size: .78rem; }
.btn-rk-danger:hover { background: #1a0404; color: #ff6b6b; border-color: #ff6b6b; }

/* FORMS */
.form-control, .form-select { background: var(--rk-bg3); border: 1px solid var(--rk-border); color: var(--rk-text); border-radius: 0; }
.form-control:focus, .form-select:focus { background: var(--rk-bg3); border-color: var(--rk-green-dim); color: var(--rk-text); box-shadow: none; }
.form-label { font-family: 'Share Tech Mono', monospace; font-size: .68rem; color: var(--rk-muted); letter-spacing: .1em; margin-bottom: .35rem; }
textarea.form-control { min-height: 160px; }
.form-check-input:checked { background-color: var(--rk-green); border-color: var(--rk-green-dim); }
.form-check-input { background-color: var(--rk-bg3); border-color: var(--rk-border); }

/* ALERTS */
.alert-success { background: var(--rk-green-dark); border: 1px solid var(--rk-green-dim); color: var(--rk-green); border-radius: 0; }
.alert-danger  { background: #1a0404; border: 1px solid #5a0808; color: #ff6b6b; border-radius: 0; }

/* PAGE HEADER */
.admin-page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.75rem; }
.admin-page-title { font-family: 'Barlow Condensed', sans-serif; font-size: 2rem; font-weight: 800; color: #000000; line-height: 1; }
.admin-page-label { font-family: 'Share Tech Mono', monospace; font-size: .65rem; color: var(--rk-green); letter-spacing: .2em; margin-bottom: .3rem; }

/* IMAGE PREVIEW */
.img-preview { width: 80px; height: 60px; object-fit: cover; border: 1px solid var(--rk-border); }

/* UNREAD */
.unread td { background: rgba(57,255,20,.04); }

@media (max-width: 768px) {
    .sidebar { transform: translateX(-100%); transition: transform .3s; }
    .sidebar.open { transform: translateX(0); }
    .admin-main { margin-left: 0; }
    .admin-topbar { padding: 0 1rem; }
    .admin-content { padding: 1rem; }
}
</style>
@stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="callsign">E74JLM<span class="sidebar-blink"></span></div>
        <div class="sub">ADMIN PANEL</div>
    </div>

    <div class="sidebar-section">NAVIGACIJA</div>
    <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <div class="sidebar-section">SADRŽAJ</div>
    <a class="sidebar-link {{ request()->routeIs('admin.vijesti*') ? 'active' : '' }}" href="{{ route('admin.vijesti.index') }}">
        <i class="bi bi-newspaper"></i> Vijesti
    </a>
    <a class="sidebar-link {{ request()->routeIs('admin.galerija*') ? 'active' : '' }}" href="{{ route('admin.galerija.index') }}">
        <i class="bi bi-images"></i> Galerija
    </a>
    <a class="sidebar-link {{ request()->routeIs('admin.clanovi*') ? 'active' : '' }}" href="{{ route('admin.clanovi.index') }}">
        <i class="bi bi-people"></i> Članovi
    </a>
    <a class="sidebar-link {{ request()->routeIs('admin.kontakt*') ? 'active' : '' }}" href="{{ route('admin.kontakt.index') }}">
        <i class="bi bi-envelope"></i> Kontakt poruke
        @php $neprocitane = \App\Models\KontaktPoruka::where('procitana', false)->count(); @endphp
        @if($neprocitane > 0)
            <span class="sidebar-badge">{{ $neprocitane }}</span>
        @endif
    </a>

    <div class="sidebar-section">OSTALO</div>
    <a class="sidebar-link" href="{{ route('pocetna') }}" target="_blank">
        <i class="bi bi-box-arrow-up-right"></i> Pogledaj sajt
    </a>

    <div class="sidebar-footer">
        <div>{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" style="background:none;border:none;color:var(--rk-muted);font-family:'Share Tech Mono',monospace;font-size:.68rem;letter-spacing:.1em;cursor:pointer;padding:0;margin-top:.4rem;">
                LOGOUT →
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="admin-main">
    <div class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn d-md-none p-0" style="color:var(--rk-green)" onclick="document.getElementById('sidebar').classList.toggle('open')">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="admin-topbar-title">@yield('title', 'Dashboard')</div>
        </div>
        <div class="admin-topbar-right">
            <span class="admin-topbar-user">{{ auth()->user()->name }}</span>
        </div>
    </div>

    <div class="admin-content">
        @if(session('uspjeh'))
            <div class="alert alert-success mb-3">{{ session('uspjeh') }}</div>
        @endif
        @if(session('greska'))
            <div class="alert alert-danger mb-3">{{ session('greska') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>