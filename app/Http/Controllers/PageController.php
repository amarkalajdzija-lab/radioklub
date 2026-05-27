<?php
// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\GalerijaSlika;
use App\Models\Vijest;
use App\Models\KontaktPoruka;
use Illuminate\Http\Request;

class PageController
{
    public function pocetna()
    {
        $vijesti  = Vijest::objavljena()->orderByDesc('datum')->take(3)->get();
        $featured = Vijest::objavljena()->featured()->orderByDesc('datum')->first();
        return view('pages.pocetna', compact('vijesti', 'featured'));
    }

    public function galerija(Request $request)
    {
        $query = GalerijaSlika::orderBy('redoslijed')->orderByDesc('datum');

        if ($request->filled('kategorija')) {
            $query->where('kategorija', $request->kategorija);
        }

        $slike      = $query->get();
        $kategorije = GalerijaSlika::distinct()->pluck('kategorija');

        return view('pages.galerija', compact('slike', 'kategorije'));
    }

    public function clanovi()
    {
        $clanovi = Clan::where('aktivan', true)
            ->orderBy('redoslijed')
            ->get()
            ->groupBy('uloga');

        return view('pages.clanovi', compact('clanovi'));
    }

    public function kontakt()
    {
        return view('pages.kontakt');
    }

    public function kontaktSalji(Request $request)
    {
        $data = $request->validate([
            'ime'     => 'required|string|max:100',
            'email'   => 'required|email',
            'predmet' => 'nullable|string|max:200',
            'poruka'  => 'required|string|max:3000',
        ]);

        KontaktPoruka::create($data);

        return back()->with('uspjeh', 'Vaša poruka je uspješno poslana. Javit ćemo se uskoro!');
    }

    public function vijesti(Request $request)
    {
        $query = Vijest::objavljena()->orderByDesc('datum');

        if ($request->filled('kategorija')) {
            $query->where('kategorija', $request->kategorija);
        }

        $vijesti    = $query->paginate(9);
        $kategorije = Vijest::objavljena()->distinct()->pluck('kategorija');

        return view('pages.vijesti', compact('vijesti', 'kategorije'));
    }

    public function vijest($slug)
    {
        $vijest = Vijest::objavljena()->where('slug', $slug)->firstOrFail();
        $ostale = Vijest::objavljena()
            ->where('id', '!=', $vijest->id)
            ->orderByDesc('datum')
            ->take(3)
            ->get();

        return view('pages.vijest', compact('vijest', 'ostale'));
    }
}
