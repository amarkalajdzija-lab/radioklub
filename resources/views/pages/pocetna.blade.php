@extends('layouts.app')
@section('title', 'Početna')
@section('content')

{{-- HERO --}}
<section style="min-height:90vh;display:flex; align-items:center; justify-content:center; text-align:center; padding:6rem 1rem 4rem; background:#fff; border-bottom:1px solid #dee2e6;">
  <div style="position:relative; z-index:1; max-width:640px; margin:0 auto;">
    <div class="rk-tag mb-4">Zajedno na talasima znanja, zajedništva i prijateljstva</div>
    <div style="width:120px;height:120px;border-radius:50%;border:2px solid #2d9e4f;background:#e8f5ec;display:flex;align-items:center;justify-content:center;margin:0 auto 2rem;font-family:'Share Tech Mono',monospace;color:#1a6b2f;">
      <div>
        <div style="font-size:1rem;font-weight:700;">E74JLM</div>
        <div style="font-size:.8rem;color:#6c757d;">TRAVNIK</div>
      </div>
    </div>
    <h1 style="font-family:'Barlow Condensed',sans-serif;font-size:clamp(3rem,8vw,6rem);font-weight:800;color:#1a1a1a;line-height:.95;letter-spacing:-.02em;">
      Radio Klub<br><span style="color:#1a6b2f;">Travnik</span>
    </h1>
    <p style="margin-top:1.5rem;color:#6c757d;max-width:460px;margin-left:auto;margin-right:auto;font-size:1rem;">
      Amaterski radio klub Travnik — Stadion Pirota, Bosna i Hercegovina.
    </p>
    <div style="font-family:'Share Tech Mono',monospace;font-size:.72rem;color:#2d9e4f;letter-spacing:.15em;margin-top:1.5rem;">
      QTH: TRAVNIK · STADION PIROTA · E7 / BIH
    </div>
    <div class="d-flex gap-3 justify-content-center mt-4">
      <a href="{{ route('vijesti') }}" class="btn btn-rk px-4">Vijesti kluba</a>
      <a href="{{ route('kontakt') }}" class="btn btn-rk-outline px-4">Kontakt</a>
    </div>
  </div>
</section>

{{-- ZADNJE VIJESTI --}}
@if($vijesti->count())
<section class="container py-5">
  <div class="page-label mb-1">// NOVOSTI</div>
  <h2 style="font-family:'Barlow Condensed',sans-serif;font-size:2rem;font-weight:800;color:#1a1a1a;margin-bottom:2rem;">Zadnje vijesti</h2>
  <div class="row g-4">
    @foreach($vijesti as $v)
    <div class="col-md-4">
      <a href="{{ route('vijest', $v->slug) }}" class="rk-card card text-decoration-none h-100">
        @if($v->slika)
          <img src="{{ asset('storage/'.$v->slika) }}" class="card-img-top" alt="{{ $v->naslov }}">
        @else
          <div style="height:180px;background:#f1f3f5;display:flex;align-items:center;justify-content:center;color:#adb5bd;font-family:'Share Tech Mono',monospace;font-size:.7rem;">
            <i class="bi bi-image" style="font-size:2rem;"></i>
          </div>
        @endif
        <div class="card-body p-3">
          <div class="rk-tag mb-2">{{ $v->kategorija }}</div>
          <div class="rk-date mb-2">{{ $v->datum->format('d.m.Y') }}</div>
          <h5 style="color:#1a1a1a;font-weight:700;">{{ $v->naslov }}</h5>
          <p style="font-size:.85rem;color:#6c757d;">{{ Str::limit($v->kratki_opis, 100) }}</p>
        </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="text-center mt-4">
    <a href="{{ route('vijesti') }}" class="btn btn-rk-outline px-5">Sve vijesti →</a>
  </div>
</section>
@endif

@endsection