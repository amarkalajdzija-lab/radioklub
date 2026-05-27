@extends('layouts.app')
@section('title', $vijest->naslov)
@section('content')
<div class="container">
  <div class="page-hero">
    <div class="page-label">// {{ strtoupper($vijest->kategorija) }} · {{ $vijest->datum->format('d.m.Y') }}</div>
    <h1 class="page-title">{{ $vijest->naslov }}</h1>
  </div>
 
  <div class="row">
    <div class="col-lg-8">
      @if($vijest->slika)
        <img src="{{ asset('storage/'.$vijest->slika) }}" class="img-fluid w-100 mb-4" style="object-fit:cover;max-height:420px;" alt="">
      @endif
      <div style="font-size:.97rem;line-height:1.85;color:var(--rk-text);">
        {!! nl2br(e($vijest->tekst)) !!}
      </div>
      <hr class="rk-divider mt-5">
      <a href="{{ route('vijesti') }}" class="btn btn-rk-outline">← Nazad na vijesti</a>
    </div>
    <div class="col-lg-4 mt-5 mt-lg-0">
      @if($ostale->count())
      <div class="page-label mb-3">// OSTALE VIJESTI</div>
      @foreach($ostale as $o)
        <a href="{{ route('vijest', $o->slug) }}" class="rk-card card text-decoration-none d-block mb-3 p-3">
          <div class="rk-tag mb-1">{{ $o->kategorija }}</div>
          <div class="rk-date mb-1">{{ $o->datum->format('d.m.Y') }}</div>
          <div style="color:#e0f0d8;font-weight:600;font-size:.9rem;">{{ $o->naslov }}</div>
        </a>
      @endforeach
      @endif
    </div>
  </div>
</div>
@endsection