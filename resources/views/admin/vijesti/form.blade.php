@extends('layouts.admin')
@section('title', $vijest->exists ? 'Uredi vijest' : 'Nova vijest')
@section('content')

<div class="admin-page-header">
    <div>
        <div class="admin-page-label">// {{ $vijest->exists ? 'UREDI' : 'NOVA' }}</div>
        <div class="admin-page-title">{{ $vijest->exists ? 'Uredi vijest' : 'Nova vijest' }}</div>
    </div>
    <a href="{{ route('admin.vijesti.index') }}" class="btn btn-rk-outline"><i class="bi bi-arrow-left me-1"></i> Nazad</a>
</div>

<form action="{{ $vijest->exists ? route('admin.vijesti.update', $vijest) : route('admin.vijesti.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($vijest->exists) @method('PUT') @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="rk-card p-4">
                <div class="mb-3">
                    <label class="form-label">NASLOV *</label>
                    <input type="text" name="naslov" class="form-control @error('naslov') is-invalid @enderror"
                           value="{{ old('naslov', $vijest->naslov) }}" required>
                    @error('naslov')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">KRATKI OPIS (prikazuje se na kartici) *</label>
                    <textarea name="kratki_opis" class="form-control @error('kratki_opis') is-invalid @enderror"
                              rows="3" required>{{ old('kratki_opis', $vijest->kratki_opis) }}</textarea>
                    @error('kratki_opis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">TEKST VIJESTI * <span style="color:var(--rk-muted);font-size:.65rem;">(novi red = novi paragraf)</span></label>
                    <textarea name="tekst" class="form-control @error('tekst') is-invalid @enderror"
                              rows="16" required>{{ old('tekst', $vijest->tekst) }}</textarea>
                    @error('tekst')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="rk-card p-4 mb-3">
                <div class="admin-page-label mb-3">// OBJAVA</div>

                <div class="mb-3">
                    <label class="form-label">DATUM *</label>
                    <input type="date" name="datum" class="form-control @error('datum') is-invalid @enderror"
                           value="{{ old('datum', $vijest->datum?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required>
                    @error('datum')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">KATEGORIJA *</label>
                    <input type="text" name="kategorija" class="form-control @error('kategorija') is-invalid @enderror"
                           value="{{ old('kategorija', $vijest->kategorija ?? 'Info') }}"
                           list="kategorije-list" required>
                    <datalist id="kategorije-list">
                        <option value="Info">
                        <option value="Natjecanje">
                        <option value="Radionica">
                        <option value="Događaj">
                        <option value="Članovi">
                        <option value="DX">
                    </datalist>
                    @error('kategorija')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3 d-flex gap-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="objavljena" value="1" id="objavljena"
                               {{ old('objavljena', $vijest->objavljena ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="objavljena" style="color:var(--rk-text);font-size:.85rem;">Objavljena</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="featured" value="1" id="featured"
                               {{ old('featured', $vijest->featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="featured" style="color:var(--rk-text);font-size:.85rem;">Featured (istaknuta)</label>
                    </div>
                </div>
            </div>

            <div class="rk-card p-4 mb-3">
                <div class="admin-page-label mb-3">// NASLOVNA SLIKA</div>
                @if($vijest->slika)
                    <img src="{{ asset('storage/'.$vijest->slika) }}" class="img-fluid mb-3 w-100" style="max-height:180px;object-fit:cover;border:1px solid var(--rk-border);">
                @endif
                <input type="file" name="slika" class="form-control @error('slika') is-invalid @enderror" accept="image/*">
                <div style="font-family:'Share Tech Mono',monospace;font-size:.62rem;color:var(--rk-muted);margin-top:.5rem;">Max 4MB · JPG, PNG, WebP</div>
                @error('slika')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn btn-rk w-100 py-2">
                <i class="bi bi-check-lg me-1"></i>
                {{ $vijest->exists ? 'Sačuvaj izmjene' : 'Objavi vijest' }}
            </button>
        </div>
    </div>
</form>

@endsection
