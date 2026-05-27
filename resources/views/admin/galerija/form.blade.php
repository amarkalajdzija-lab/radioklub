@extends('layouts.admin')
@section('title', $slika->exists ? 'Uredi sliku' : 'Dodaj sliku')
@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-label">// {{ $slika->exists ? 'UREDI' : 'NOVA SLIKA' }}</div>
        <div class="admin-page-title">{{ $slika->exists ? 'Uredi sliku' : 'Dodaj sliku' }}</div>
    </div>
    <a href="{{ route('admin.galerija.index') }}" class="btn btn-rk-outline"><i class="bi bi-arrow-left me-1"></i> Nazad</a>
</div>

<div class="row justify-content-center">
<div class="col-lg-6">
<form action="{{ $slika->exists ? route('admin.galerija.update', $slika) : route('admin.galerija.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($slika->exists) @method('PUT') @endif

    <div class="rk-card p-4">
        @if($slika->exists)
        <div class="mb-3">
            <img src="{{ asset('storage/'.$slika->slika) }}" class="img-fluid w-100 mb-2" style="max-height:220px;object-fit:cover;border:1px solid var(--rk-border);">
        </div>
        @endif

        <div class="mb-3">
            <label class="form-label">SLIKA {{ $slika->exists ? '(ostavi prazno da zadržiš staru)' : '*' }}</label>
            <input type="file" name="slika" class="form-control @error('slika') is-invalid @enderror"
                   accept="image/*" {{ !$slika->exists ? 'required' : '' }}
                   onchange="previewImg(this)">
            <img id="img-preview" src="" style="display:none;width:100%;max-height:180px;object-fit:cover;margin-top:.5rem;border:1px solid var(--rk-border);">
            <div style="font-family:'Share Tech Mono',monospace;font-size:.62rem;color:var(--rk-muted);margin-top:.4rem;">Max 8MB · JPG, PNG, WebP</div>
            @error('slika')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label">NASLOV (opcionalno)</label>
            <input type="text" name="naslov" class="form-control" value="{{ old('naslov', $slika->naslov) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">KATEGORIJA *</label>
            <input type="text" name="kategorija" class="form-control @error('kategorija') is-invalid @enderror"
                   value="{{ old('kategorija', $slika->kategorija ?? 'Ostalo') }}"
                   list="kat-list" required>
            <datalist id="kat-list">
                <option value="Natjecanje">
                <option value="Radionica">
                <option value="Oprema">
                <option value="Događaj">
                <option value="Ostalo">
            </datalist>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6">
                <label class="form-label">DATUM</label>
                <input type="date" name="datum" class="form-control" value="{{ old('datum', $slika->datum?->format('Y-m-d')) }}">
            </div>
            <div class="col-6">
                <label class="form-label">REDOSLIJED</label>
                <input type="number" name="redoslijed" class="form-control" value="{{ old('redoslijed', $slika->redoslijed ?? 0) }}">
            </div>
        </div>

        <button type="submit" class="btn btn-rk w-100 py-2">
            <i class="bi bi-check-lg me-1"></i>
            {{ $slika->exists ? 'Sačuvaj izmjene' : 'Dodaj sliku' }}
        </button>
    </div>
</form>
</div>
</div>

@push('scripts')
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('img-preview');
            p.src = e.target.result;
            p.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection