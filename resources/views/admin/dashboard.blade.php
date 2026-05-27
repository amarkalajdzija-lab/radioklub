@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="admin-page-label">// PREGLED</div>
<div class="admin-page-title mb-4">Dashboard</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="rk-stat-card">
            <div class="num">{{ $stats['vijesti'] }}</div>
            <div class="label">VIJESTI</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="rk-stat-card">
            <div class="num">{{ $stats['slike'] }}</div>
            <div class="label">SLIKE U GALERIJI</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="rk-stat-card">
            <div class="num">{{ $stats['clanovi'] }}</div>
            <div class="label">ČLANOVA</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="rk-stat-card">
            <div class="num" style="{{ $stats['poruke'] > 0 ? 'color:#ff6b6b' : '' }}">{{ $stats['poruke'] }}</div>
            <div class="label">NEPROČITANE PORUKE</div>
        </div>
    </div>
</div>

{{-- Brze akcije --}}
<div class="admin-page-label mb-2">// BRZE AKCIJE</div>
<div class="d-flex gap-2 flex-wrap mb-5">
    <a href="{{ route('admin.vijesti.create') }}" class="btn btn-rk"><i class="bi bi-plus-lg me-1"></i> Nova vijest</a>
    <a href="{{ route('admin.galerija.create') }}" class="btn btn-rk-outline"><i class="bi bi-plus-lg me-1"></i> Dodaj sliku</a>
    <a href="{{ route('admin.clanovi.create') }}" class="btn btn-rk-outline"><i class="bi bi-plus-lg me-1"></i> Dodaj člana</a>
</div>

{{-- Nepročitane poruke --}}
@if($poruke->count())
<div class="admin-page-label mb-2">// NEPROČITANE PORUKE</div>
<div class="rk-card mb-4">
    <table class="rk-table">
        <thead>
            <tr>
                <th>Ime</th>
                <th>E-mail</th>
                <th>Predmet</th>
                <th>Datum</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($poruke as $p)
            <tr>
                <td style="font-weight:600;color:#e0f0d8;">{{ $p->ime }}</td>
                <td style="font-family:'Share Tech Mono',monospace;font-size:.78rem;">{{ $p->email }}</td>
                <td style="color:var(--rk-muted);">{{ $p->predmet ?? '—' }}</td>
                <td style="font-family:'Share Tech Mono',monospace;font-size:.72rem;color:var(--rk-muted);">{{ $p->created_at->format('d.m.Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.kontakt.index') }}" class="btn btn-rk-outline btn-sm">Pregled</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection