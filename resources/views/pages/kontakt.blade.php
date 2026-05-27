@extends('layouts.app')
@section('title', 'Kontakt')
@section('content')
<div class="container">
  <div class="page-hero">
    <div class="page-label">// PRONAĐI NAS</div>
    <h1 class="page-title">Kontakt</h1>
  </div>
 
  <div class="row g-5">
    <div class="col-lg-6">
      @if(session('uspjeh'))
        <div class="alert alert-success">{{ session('uspjeh') }}</div>
      @endif
      <div class="page-label mb-3">// POŠALJI PORUKU</div>
      <form action="{{ route('kontakt.salji') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">IME I PREZIME</label>
          <input type="text" name="ime" class="form-control @error('ime') is-invalid @enderror" value="{{ old('ime') }}" required>
          @error('ime')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">E-MAIL</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
          @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">PREDMET</label>
          <input type="text" name="predmet" class="form-control" value="{{ old('predmet') }}">
        </div>
        <div class="mb-4">
          <label class="form-label">PORUKA</label>
          <textarea name="poruka" class="form-control @error('poruka') is-invalid @enderror" required>{{ old('poruka') }}</textarea>
          @error('poruka')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-rk px-5">Pošalji poruku</button>
      </form>
    </div>
 
    <div class="col-lg-6">
      <div class="page-label mb-3">// INFO</div>
      <div class="rk-card p-4 mb-3">
        <div class="d-flex align-items-start gap-3 py-2 border-bottom" style="border-color:var(--rk-border)!important;">
          <i class="bi bi-geo-alt" style="color:var(--rk-green);font-size:1.1rem;margin-top:2px;"></i>
          <div>
            <div class="page-label">ADRESA</div>
            <div>Prostori Stadiona Pirota<br>Travnik, BiH</div>
          </div>
        </div>
        <div class="d-flex align-items-start gap-3 py-2 border-bottom" style="border-color:var(--rk-border)!important;">
          <i class="bi bi-facebook" style="color:var(--rk-green);font-size:1.1rem;margin-top:2px;"></i>
          <div>
            <div class="page-label">FACEBOOK</div>
            <a href="https://facebook.com/" target="_blank" style="color:var(--rk-text);text-decoration:none;">Radio Klub Travnik</a>
          </div>
        </div>
        <div class="d-flex align-items-start gap-3 py-2 border-bottom" style="border-color:var(--rk-border)!important;">
          <i class="bi bi-instagram" style="color:var(--rk-green);font-size:1.1rem;margin-top:2px;"></i>
          <div>
            <div class="page-label">INSTAGRAM</div>
            <a href="https://instagram.com/" target="_blank" style="color:var(--rk-text);text-decoration:none;">@radioklub_travnik</a>
          </div>
        </div>
        <div class="d-flex align-items-start gap-3 py-2">
          <i class="bi bi-radio" style="color:var(--rk-green);font-size:1.1rem;margin-top:2px;"></i>
          <div>
            <div class="page-label">KLUPSKA FREKVENCIJA</div>
            <div style="font-family:'Share Tech Mono',monospace;font-size:.85rem;">145.500 MHz FM (VHF)</div>
          </div>
        </div>
      </div>
      <a href="https://maps.google.com/?q=Stadion+Pirota+Travnik" target="_blank"
         class="btn btn-rk-outline w-100 py-3">
        <i class="bi bi-map me-2"></i>Otvori u Google Maps
      </a>
    </div>
  </div>
</div>
@endsection