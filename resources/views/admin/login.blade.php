<!DOCTYPE html>
<html lang="bs">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — E74JLM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--green:#39ff14;--green-dim:#1a7a08;--green-dark:#0d3d04;--bg:#080e06;--bg2:#0d1a09;--border:#1e3a17;--text:#c8e6c0;--muted:#6a9460;}
body{background:var(--bg);color:var(--text);font-family:'Barlow',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;}
.login-box{background:var(--bg2);border:1px solid var(--border);padding:2.5rem;width:100%;max-width:420px;}
.login-title{font-family:monospace;font-size:1.1rem;color:var(--green);letter-spacing:.1em;margin-bottom:.25rem;}
.login-sub{font-size:.78rem;color:var(--muted);margin-bottom:2rem;font-family:monospace;letter-spacing:.08em;}
.form-label{font-family:monospace;font-size:.68rem;color:var(--muted);letter-spacing:.1em;}
.form-control{background:#111f0c;border:1px solid var(--border);color:var(--text);border-radius:0;}
.form-control:focus{background:#111f0c;border-color:var(--green-dim);color:var(--text);box-shadow:none;}
.btn-login{background:var(--green);color:#080e06;border:none;border-radius:0;font-weight:700;font-size:.85rem;letter-spacing:.1em;text-transform:uppercase;width:100%;padding:.75rem;}
.btn-login:hover{background:#55ff30;color:#080e06;}
.alert-danger{background:#1a0404;border:1px solid #5a0808;color:#ff6b6b;border-radius:0;font-size:.85rem;}
</style>
</head>
<body>
<div class="login-box">
    <div class="login-title">E74JLM<span style="display:inline-block;width:6px;height:6px;background:var(--green);border-radius:50%;animation:blink 1.2s step-end infinite;margin-left:5px;vertical-align:middle;"></span></div>
    <div class="login-sub">ADMIN PANEL · RADIO KLUB TRAVNIK</div>

    @if($errors->any())
        <div class="alert alert-danger mb-3">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">E-MAIL</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="mb-4">
            <label class="form-label">LOZINKA</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn-login">Prijavi se →</button>
    </form>
</div>
<style>@keyframes blink{0%,100%{opacity:1}50%{opacity:0}}</style>
</body>
</html>