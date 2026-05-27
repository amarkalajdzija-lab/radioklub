@extends('layouts.admin')
@section('title', $clan->exists ? 'Uredi člana' : 'Dodaj člana')
@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-label">// {{ $clan->exists ? 'UREDI' : 'NOVI ČLAN' }}</div>
        <div class="admin-page-title">{{ $clan->exists ? 'Uredi člana' : 'Dodaj člana' }}</div>
    </div>
    <a href="{{ route('admin.clanovi.index') }}" class="btn btn-rk-outline"><i class="bi bi-arrow-left me-1"></i> Nazad</a>
</div>

<div class="row justify-content-center">
<div class="col-lg-6">
<form action="{{ $clan->exists ? route('admin.clanovi.update', $clan) : route('admin.clanovi.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($clan->exists) @method('PUT') @endif

    <div class="rk-card p-4">
        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">IME *</label>
                <input type="text" name="ime" class="form-control @error('ime') is-invalid @enderror"
                       value="{{ old('ime', $clan->ime) }}" required>
                @error('ime')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-6">
                <label class="form-label">PREZIME *</label>
                <input type="text" name="prezime" class="form-control @error('prezime') is-invalid @enderror"
                       value="{{ old('prezime', $clan->prezime) }}" required>
                @error('prezime')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">CALLSIGN</label>
                <input type="text" name="callsign" class="form-control" value="{{ old('callsign', $clan->callsign) }}" placeholder="E74XXX">
            </div>
            <div class="col-6">
                <label class="form-label">E-MAIL</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $clan->email) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">ULOGA U KLUBU *</label>
            <input type="text" name="uloga" class="form-control @error('uloga') is-invalid @enderror"
                   value="{{ old('uloga', $clan->uloga) }}"
                   list="uloge-list" required>
            <datalist id="uloge-list">
                <option value="Predsjednik">
                <option value="Potpredsjednik">
                <option value="Sekretar">
                <option value="Član UV">
                <option value="Predsjednik NO">
                <option value="Član NO">
                <option value="Operater">
            </datalist>
            @error('uloga')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row g-3 mb-3">
            <div class="col-6">
                <label class="form-label">REDOSLIJED PRIKAZA</label>
                <input type="number" name="redoslijed" class="form-control" value="{{ old('redoslijed', $clan->redoslijed ?? 0) }}">
            </div>
            <div class="col-6 d-flex align-items-end pb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="aktivan" value="1" id="aktivan"
                           {{ old('aktivan', $clan->aktivan ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="aktivan" style="color:var(--rk-text);">Aktivan član</label>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">FOTOGRAFIJA</label>
            @if($clan->slika)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$clan->slika) }}" style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:1px solid var(--rk-border);">
                </div>
            @endif
            <input type="file" name="slika" class="form-control" accept="image/*" onchange="previewAvatar(this)">
            <img id="avatar-preview" src="" style="display:none;width:60px;height:60px;border-radius:50%;object-fit:cover;margin-top:.5rem;border:1px solid var(--rk-border);">
        </div>

        <button type="submit" class="btn btn-rk w-100 py-2">
            <i class="bi bi-check-lg me-1"></i>
            {{ $clan->exists ? 'Sačuvaj izmjene' : 'Dodaj člana' }}
        </button>
    </div>
</form>
</div>
</div>

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('avatar-preview');
            p.src = e.target.result;
            p.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
@endsection