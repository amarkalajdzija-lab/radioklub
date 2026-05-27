@extends('layouts.admin')
@section('title', 'Vijesti')
@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-label">// UPRAVLJANJE</div>
        <div class="admin-page-title">Vijesti</div>
    </div>
    <a href="{{ route('admin.vijesti.create') }}" class="btn btn-rk"><i class="bi bi-plus-lg me-1"></i> Nova vijest</a>
</div>

<div class="rk-card">
    <table class="rk-table">
        <thead>
            <tr>
                <th>Naslov</th>
                <th>Kategorija</th>
                <th>Datum</th>
                <th>Status</th>
                <th>Featured</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($vijesti as $v)
            <tr>
                <td style="font-weight:600;color:#e0f0d8;max-width:300px;">
                    {{ $v->naslov }}
                </td>
                <td>
                    <span style="font-family:'Share Tech Mono',monospace;font-size:.65rem;color:var(--rk-green-dim);border:1px solid var(--rk-green-dark);padding:2px 7px;">
                        {{ $v->kategorija }}
                    </span>
                </td>
                <td style="font-family:'Share Tech Mono',monospace;font-size:.75rem;color:var(--rk-muted);">
                    {{ $v->datum->format('d.m.Y') }}
                </td>
                <td>
                    @if($v->objavljena)
                        <span style="color:var(--rk-green);font-family:'Share Tech Mono',monospace;font-size:.7rem;">● OBJAVLJENO</span>
                    @else
                        <span style="color:var(--rk-muted);font-family:'Share Tech Mono',monospace;font-size:.7rem;">○ SKRIVENO</span>
                    @endif
                </td>
                <td>
                    @if($v->featured)
                        <span style="color:var(--rk-green);font-size:.8rem;"><i class="bi bi-star-fill"></i></span>
                    @else
                        <span style="color:var(--rk-border);font-size:.8rem;"><i class="bi bi-star"></i></span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('vijest', $v->slug) }}" target="_blank" class="btn btn-rk-outline btn-sm" title="Pogledaj"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('admin.vijesti.edit', $v) }}" class="btn btn-rk-outline btn-sm"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.vijesti.destroy', $v) }}" method="POST" onsubmit="return confirm('Obrisati vijest?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-rk-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--rk-muted);font-family:'Share Tech Mono',monospace;padding:3rem;">Nema vijesti.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection