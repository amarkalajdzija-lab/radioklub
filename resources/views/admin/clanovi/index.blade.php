@extends('layouts.admin')
@section('title', 'Članovi')
@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-label">// UPRAVLJANJE</div>
        <div class="admin-page-title">Članovi</div>
    </div>
    <a href="{{ route('admin.clanovi.create') }}" class="btn btn-rk"><i class="bi bi-plus-lg me-1"></i> Dodaj člana</a>
</div>

<div class="rk-card">
    <table class="rk-table">
        <thead>
            <tr>
                <th></th>
                <th>Ime i prezime</th>
                <th>Callsign</th>
                <th>Uloga</th>
                <th>Status</th>
                <th>Red.</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($clanovi as $c)
            <tr>
                <td style="width:48px;">
                    @if($c->slika)
                        <img src="{{ asset('storage/'.$c->slika) }}" class="img-preview" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                    @else
                        <div style="width:40px;height:40px;border-radius:50%;background:var(--rk-green-dark);border:1px solid var(--rk-green-dim);display:flex;align-items:center;justify-content:center;font-family:'Share Tech Mono',monospace;font-size:.7rem;color:var(--rk-green);">
                            {{ strtoupper(substr($c->ime,0,1).substr($c->prezime,0,1)) }}
                        </div>
                    @endif
                </td>
                <td style="font-weight:600;color:#e0f0d8;">{{ $c->puno_ime }}</td>
                <td style="font-family:'Share Tech Mono',monospace;font-size:.78rem;color:var(--rk-green);">{{ $c->callsign ?: '—' }}</td>
                <td style="color:var(--rk-muted);font-size:.85rem;">{{ $c->uloga }}</td>
                <td>
                    @if($c->aktivan)
                        <span style="color:var(--rk-green);font-family:'Share Tech Mono',monospace;font-size:.68rem;">● AKTIVAN</span>
                    @else
                        <span style="color:var(--rk-muted);font-family:'Share Tech Mono',monospace;font-size:.68rem;">○ NEAKTIVAN</span>
                    @endif
                </td>
                <td style="font-family:'Share Tech Mono',monospace;font-size:.78rem;color:var(--rk-muted);">{{ $c->redoslijed }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.clanovi.edit', $c) }}" class="btn btn-rk-outline btn-sm"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.clanovi.destroy', $c) }}" method="POST" onsubmit="return confirm('Obrisati člana?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-rk-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;color:var(--rk-muted);font-family:'Share Tech Mono',monospace;padding:3rem;">Nema članova.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection