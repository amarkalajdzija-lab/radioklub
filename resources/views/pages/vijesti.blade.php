@extends('layouts.app')
@section('title', 'Vijesti')
@section('content')
<div class="container">
  <div class="page-hero">
    <div class="page-label">// NOVOSTI · E74JLM</div>
    <h1 class="page-title">Vijesti</h1>
  </div>
 
  {{-- Filteri --}}
  <div class="d-flex gap-2 flex-wrap mb-4">
    <a href="{{ route('vijesti') }}" class="btn btn-sm {{ !request('kategorija') ? 'btn-rk' : 'btn-rk-outline' }}">SVE</a>
    @foreach($kategorije as $k)
      <a href="{{ route('vijesti', ['kategorija'=>$k]) }}" class="btn btn-sm {{ request('kategorija')==$k ? 'btn-rk' : 'btn-rk-outline' }}">{{ strtoupper($k) }}</a>
    @endforeach
  </div>
 
  <div class="row g-4">
    @forelse($vijesti as $v)
    <div class="col-md-4">
      <a href="{{ route('vijest', $v->slug) }}" class="rk-card card text-decoration-none h-100">
        @if($v->slika)
          <img src="{{ asset('storage/'.$v->slika) }}" class="card-img-top" alt="">
        @else
          <div style="height:170px;background:var(--rk-bg3);display:flex;align-items:center;justify-content:center;color:var(--rk-muted);font-family:'Share Tech Mono',monospace;font-size:.7rem;letter-spacing:.1em;">FOTOGRAFIJA</div>
        @endif
        <div class="card-body p-3">
          <div class="rk-tag mb-2">{{ $v->kategorija }}</div>
          <div class="rk-date mb-2">{{ $v->datum->format('d.m.Y') }}</div>
          <h5 style="color:#e0f0d8;font-weight:700;font-size:1rem;">{{ $v->naslov }}</h5>
          <p style="font-size:.83rem;color:var(--rk-muted);">{{ Str::limit($v->kratki_opis, 110) }}</p>
          <span style="font-family:'Share Tech Mono',monospace;font-size:.72rem;color:var(--rk-green);">Pročitaj više →</span>
        </div>
      </a>
    </div>
    @empty
      <div class="col-12 text-center py-5" style="color:var(--rk-muted);font-family:'Share Tech Mono',monospace;">
        Nema vijesti.
      </div>
    @endforelse
  </div>
 
  <div class="mt-5">{{ $vijesti->links() }}</div>
</div>
@endsection