{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="bs">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Radio Klub Travnik') — E74JLM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Barlow:wght@300;400;600;700&family=Barlow+Condensed:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
:root {
    --rk-accent: #1a6b2f;
    --rk-accent-light: #e8f5ec;
    --rk-accent-mid: #2d9e4f;
    --rk-bg: #ffffff;
    --rk-bg2: #f8f9fa;
    --rk-bg3: #f1f3f5;
    --rk-text: #1a1a1a;
    --rk-muted: #6c757d;
    --rk-border: #dee2e6;
}
* { box-sizing: border-box; }
body { background: var(--rk-bg); color: var(--rk-text); font-family: 'Barlow', sans-serif; }

/* NAV */
.navbar { background: #fff !important; border-bottom: 1px solid var(--rk-border); }
.navbar-brand { font-family: 'Share Tech Mono', monospace; color: var(--rk-accent) !important; font-size: 1.1rem; letter-spacing: .1em; font-weight: 700; }
.nav-link { color: var(--rk-muted) !important; font-size: .8rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; transition: color .2s; }
.nav-link:hover { color: var(--rk-accent) !important; }
.nav-link.active { color: var(--rk-accent) !important; border-bottom: 2px solid var(--rk-accent); }
.nav-blink { display: inline-block; width: 6px; height: 6px; background: var(--rk-accent-mid); border-radius: 50%; animation: blink 1.2s step-end infinite; margin-left: 4px; vertical-align: middle; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:0} }

/* PAGE HERO */
.page-hero { padding: 5rem 0 2.5rem; border-bottom: 1px solid var(--rk-border); margin-bottom: 3rem; background: var(--rk-bg2); }
.page-label { font-family: 'Share Tech Mono', monospace; font-size: .7rem; color: var(--rk-accent-mid); letter-spacing: .2em; text-transform: uppercase; margin-bottom: .5rem; }
.page-title { font-family: 'Barlow Condensed', sans-serif; font-size: clamp(2.2rem,5vw,4rem); font-weight: 800; color: var(--rk-text); line-height: 1; }

/* CARDS */
.rk-card { background: #fff; border: 1px solid var(--rk-border); border-radius: 0; transition: border-color .2s, box-shadow .2s; }
.rk-card:hover { border-color: var(--rk-accent); box-shadow: 0 4px 20px rgba(26,107,47,.08); transform: translateY(-2px); }
.rk-card .card-img-top { border-radius: 0; object-fit: cover; height: 200px; }

/* BADGES / TAGS */
.rk-tag { font-family: 'Share Tech Mono', monospace; font-size: .62rem; letter-spacing: .1em; color: var(--rk-accent); background: var(--rk-accent-light); padding: 2px 8px; display: inline-block; }
.rk-date { font-family: 'Share Tech Mono', monospace; font-size: .68rem; color: var(--rk-muted); letter-spacing: .05em; }

/* BUTTONS */
.btn-rk { background: var(--rk-accent); color: #fff; border-radius: 0; font-weight: 700; font-size: .82rem; letter-spacing: .08em; text-transform: uppercase; border: none; transition: background .2s; }
.btn-rk:hover { background: var(--rk-accent-mid); color: #fff; }
.btn-rk-outline { border: 1px solid var(--rk-accent); color: var(--rk-accent); background: transparent; border-radius: 0; font-size: .82rem; letter-spacing: .08em; text-transform: uppercase; }
.btn-rk-outline:hover { background: var(--rk-accent-light); color: var(--rk-accent); }

/* FORMS */
.form-control, .form-select { background: #fff; border: 1px solid var(--rk-border); color: var(--rk-text); border-radius: 0; }
.form-control:focus, .form-select:focus { border-color: var(--rk-accent-mid); box-shadow: 0 0 0 3px rgba(45,158,79,.1); }
.form-label { font-family: 'Share Tech Mono', monospace; font-size: .7rem; color: var(--rk-muted); letter-spacing: .1em; }
textarea.form-control { min-height: 140px; }

/* ALERTS */
.alert-success { background: var(--rk-accent-light); border: 1px solid var(--rk-accent-mid); color: var(--rk-accent); border-radius: 0; }
.alert-danger { background: #fff5f5; border: 1px solid #f5c6cb; color: #842029; border-radius: 0; }

/* DIVIDER */
.rk-divider { border: none; border-top: 1px solid var(--rk-border); margin: 2rem 0; }

/* FOOTER */
footer { border-top: 1px solid var(--rk-border); padding: 2rem 0; margin-top: 4rem; background: var(--rk-bg2); }
footer .mono { font-family: 'Share Tech Mono', monospace; font-size: .75rem; color: var(--rk-muted); letter-spacing: .08em; }
footer .green { color: var(--rk-accent); }

/* MEMBER AVATAR */
.member-avatar { width: 70px; height: 70px; border-radius: 50%; background: var(--rk-accent-light); border: 2px solid var(--rk-accent-mid); display: flex; align-items: center; justify-content: center; font-family: 'Share Tech Mono', monospace; color: var(--rk-accent); font-size: .85rem; overflow: hidden; flex-shrink: 0; }
.member-avatar img { width: 100%; height: 100%; object-fit: cover; }
</style>
@stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ route('pocetna') }}">
      E74JLM<span class="nav-blink"></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto gap-lg-2">
        <li class="nav-item"><a class="nav-link @if(request()->routeIs('pocetna')) active @endif" href="{{ route('pocetna') }}">Početna</a></li>
        <li class="nav-item"><a class="nav-link @if(request()->routeIs('vijesti*')) active @endif" href="{{ route('vijesti') }}">Vijesti</a></li>
        <li class="nav-item"><a class="nav-link @if(request()->routeIs('galerija')) active @endif" href="{{ route('galerija') }}">Galerija</a></li>
        <li class="nav-item"><a class="nav-link @if(request()->routeIs('clanovi')) active @endif" href="{{ route('clanovi') }}">Članovi</a></li>
        <li class="nav-item"><a class="nav-link @if(request()->routeIs('kontakt')) active @endif" href="{{ route('kontakt') }}">Kontakt</a></li>
      </ul>
    </div>
  </div>
</nav>

<main style="padding-top:64px; min-height:calc(100vh - 100px)">
    @yield('content')
</main>

<footer>
  <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
    <span class="mono">Radio Klub Travnik · <span class="green">E74JLM</span></span>
    <span class="mono">Račun: 1320202029189802 NLB banka</span>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>