@extends('layouts.app')
@section('title', 'Članovi')
@section('content')
<div class="container">
  <div class="page-hero">
    <div class="page-label">// ORGANIZACIJA KLUBA</div>
    <h1 class="page-title">Struktura Kluba</h1>
  </div>
 
  @forelse($clanovi as $uloga => $grupa)
  <div class="mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
      <span class="page-label mb-0">{{ strtoupper($uloga) }}</span>
      <div style="flex:1;height:1px;background:var(--rk-border);"></div>
    </div>
    <div class="row g-3">
      @foreach($grupa as $clan)
      <div class="col-md-4 col-lg-3">
        <div class="rk-card p-3 d-flex align-items-center gap-3">
          <div class="member-avatar">
            @if($clan->slika)
              <img src="{{ asset('storage/'.$clan->slika) }}" alt="{{ $clan->puno_ime }}">
            @else
              {{ strtoupper(substr($clan->ime,0,1).substr($clan->prezime,0,1)) }}
            @endif
          </div>
          <div>
            <div style="font-weight:700;color:#e0f0d8;">{{ $clan->puno_ime }}</div>
            @if($clan->callsign)
              <div style="font-family:'Share Tech Mono',monospace;font-size:.72rem;color:var(--rk-green);">{{ $clan->callsign }}</div>
            @endif
            <div style="font-size:.78rem;color:var(--rk-muted);">{{ $clan->uloga }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @empty
    <div class="text-center py-5" style="color:var(--rk-muted);font-family:'Share Tech Mono',monospace;">Nema članova.</div>
  @endforelse
</div>
@endsection