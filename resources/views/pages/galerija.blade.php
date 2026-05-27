@extends('layouts.app')
@section('title', 'Galerija')
@section('content')
<div class="container">
  <div class="page-hero">
    <div class="page-label">// FOTOGRAFIJE</div>
    <h1 class="page-title">Galerija</h1>
  </div>
 
  <div class="d-flex gap-2 flex-wrap mb-4">
    <a href="{{ route('galerija') }}" class="btn btn-sm {{ !request('kategorija') ? 'btn-rk' : 'btn-rk-outline' }}">SVE</a>
    @foreach($kategorije as $k)
      <a href="{{ route('galerija', ['kategorija'=>$k]) }}" class="btn btn-sm {{ request('kategorija')==$k ? 'btn-rk' : 'btn-rk-outline' }}">{{ strtoupper($k) }}</a>
    @endforeach
  </div>
 
  @if($slike->isEmpty())
    <div class="text-center py-5" style="color:var(--rk-muted);font-family:'Share Tech Mono',monospace;">Galerija je prazna.</div>
  @else
  <div class="row g-3" id="gallery">
    @foreach($slike as $s)
    <div class="col-6 col-md-4 col-lg-3">
      <div class="rk-card" style="cursor:pointer;" onclick="openLightbox('{{ asset('storage/'.$s->slika) }}','{{ $s->naslov ?? '' }}','{{ $s->datum?->format('d.m.Y') ?? '' }}')">
        <img src="{{ asset('storage/'.$s->slika) }}" style="width:100%;height:180px;object-fit:cover;display:block;" alt="{{ $s->naslov }}">
        @if($s->naslov)
        <div class="p-2">
          <div style="font-size:.8rem;color:var(--rk-muted);">{{ $s->naslov }}</div>
        </div>
        @endif
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
 
{{-- Lightbox --}}
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(8,14,6,.97);z-index:9000;align-items:center;justify-content:center;flex-direction:column;gap:1rem;" onclick="closeLightbox()">
  <div style="position:absolute;top:1.5rem;right:2rem;font-family:'Share Tech Mono',monospace;font-size:.8rem;color:var(--rk-green);cursor:pointer;">[ ZATVORI × ]</div>
  <img id="lb-img" src="" style="max-width:90vw;max-height:80vh;object-fit:contain;border:1px solid var(--rk-border);" alt="">
  <div id="lb-caption" style="font-family:'Share Tech Mono',monospace;font-size:.75rem;color:var(--rk-muted);letter-spacing:.1em;"></div>
</div>
@push('scripts')
<script>
function openLightbox(src, caption, datum) {
  document.getElementById('lb-img').src = src;
  document.getElementById('lb-caption').textContent = [caption, datum].filter(Boolean).join(' · ');
  const lb = document.getElementById('lightbox');
  lb.style.display = 'flex';
  event.stopPropagation();
}
function closeLightbox() { document.getElementById('lightbox').style.display='none'; }
document.addEventListener('keydown', e => { if(e.key==='Escape') closeLightbox(); });
</script>
@endpush
@endsection