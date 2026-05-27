@extends('layouts.admin')
@section('title', 'Kontakt poruke')
@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-label">// INBOX</div>
        <div class="admin-page-title">Kontakt poruke</div>
    </div>
</div>

<div class="rk-card">
    <table class="rk-table">
        <thead>
            <tr>
                <th></th>
                <th>Ime</th>
                <th>E-mail</th>
                <th>Predmet</th>
                <th>Datum</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($poruke as $p)
            <tr class="{{ !$p->procitana ? 'unread' : '' }}">
                <td style="width:32px;">
                    @if(!$p->procitana)
                        <span style="color:var(--rk-green);font-size:.75rem;" title="Nepročitano">●</span>
                    @else
                        <span style="color:var(--rk-border);font-size:.75rem;" title="Pročitano">○</span>
                    @endif
                </td>
                <td style="font-weight:600;color:#e0f0d8;">{{ $p->ime }}</td>
                <td style="font-family:'Share Tech Mono',monospace;font-size:.78rem;">
                    <a href="mailto:{{ $p->email }}" style="color:var(--rk-muted);text-decoration:none;">{{ $p->email }}</a>
                </td>
                <td style="color:var(--rk-muted);max-width:200px;">{{ $p->predmet ?: '—' }}</td>
                <td style="font-family:'Share Tech Mono',monospace;font-size:.72rem;color:var(--rk-muted);">
                    {{ $p->created_at->format('d.m.Y H:i') }}
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <button class="btn btn-rk-outline btn-sm" onclick="togglePoruka({{ $p->id }})">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        @if(!$p->procitana)
                        <form action="{{ route('admin.kontakt.procitaj', $p->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button class="btn btn-rk-outline btn-sm" title="Označi kao pročitano"><i class="bi bi-check"></i></button>
                        </form>
                        @endif
                        <form action="{{ route('admin.kontakt.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Obrisati poruku?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-rk-danger btn-sm"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            <tr id="poruka-{{ $p->id }}" style="display:none;">
                <td colspan="6" style="background:var(--rk-bg3);padding:1.25rem 1.5rem;">
                    <div style="font-size:.88rem;line-height:1.8;white-space:pre-wrap;color:var(--rk-text);">{{ $p->poruka }}</div>
                    <div style="margin-top:.75rem;">
                        <a href="mailto:{{ $p->email }}?subject=Re: {{ $p->predmet }}"
                           class="btn btn-rk-outline btn-sm">
                            <i class="bi bi-reply me-1"></i> Odgovori na {{ $p->email }}
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;color:var(--rk-muted);font-family:'Share Tech Mono',monospace;padding:3rem;">Nema poruka.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $poruke->links() }}</div>

@push('scripts')
<script>
function togglePoruka(id) {
    const row = document.getElementById('poruka-' + id);
    row.style.display = row.style.display === 'none' ? 'table-row' : 'none';
}
</script>
@endpush
@endsection
