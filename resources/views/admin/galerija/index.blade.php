@extends('layouts.admin')
@section('title', 'Galerija')
@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-label">// UPRAVLJANJE</div>
        <div class="admin-page-title">Galerija</div>
    </div>
    <a href="{{ route('admin.galerija.create') }}" class="btn btn-rk"><i class="bi bi-plus-lg me-1"></i> Dodaj sliku</a>
</div>

@if($slike->isEmpty())
    <div style="text-align:center;padding:4rem;color:var(--rk-muted);font-family:'Share Tech Mono',monospace;">Galerija je prazna.</div>
@else
<div class="row g-3">
    @foreach($slike as $s)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="rk-card">
            <img src="{{ asset('storage/'.$s->slika) }}" style="width:100%;height:150px;object-fit:cover;display:block;" alt="">
            <div class="p-2">
                <div style="font-size:.8rem;font-weight:600;color:#e0f0d8;margin-bottom:2px;">{{ $s->naslov ?: '—' }}</div>
                <div style="font-family:'Share Tech Mono',monospace;font-size:.65rem;color:var(--rk-green);">{{ $s->kategorija }}</div>
                <div class="d-flex gap-1 mt-2">
                    <a href="{{ route('admin.galerija.edit', $s) }}" class="btn btn-rk-outline btn-sm flex-fill"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('admin.galerija.destroy', $s) }}" method="POST" onsubmit="return confirm('Obrisati sliku?')" class="flex-fill">
                        @csrf @method('DELETE')
                        <button class="btn btn-rk-danger btn-sm w-100"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

@endsection