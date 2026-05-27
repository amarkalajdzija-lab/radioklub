<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Clan;
use Illuminate\Http\Request;
 
class AdminClanController {
    public function index() {
        $clanovi = Clan::orderBy('redoslijed')->get();
        return view('admin.clanovi.index', compact('clanovi'));
    }
    public function create() { return view('admin.clanovi.form', ['clan' => new Clan]); }
    public function store(Request $request) {
        $data = $this->validate($request);
        if ($request->hasFile('slika')) {
            $data['slika'] = $request->file('slika')->store('clanovi', 'public');
        }
        Clan::create($data);
        return redirect()->route('admin.clanovi.index')->with('uspjeh', 'Član dodan!');
    }
    public function edit(Clan $clan) { return view('admin.clanovi.form', compact('clan')); }
    public function update(Request $request, Clan $clan) {
        $data = $this->validate($request);
        if ($request->hasFile('slika')) {
            $data['slika'] = $request->file('slika')->store('clanovi', 'public');
        }
        $clan->update($data);
        return redirect()->route('admin.clanovi.index')->with('uspjeh', 'Član ažuriran!');
    }
    public function destroy(Clan $clan) {
        $clan->delete();
        return back()->with('uspjeh', 'Član obrisan.');
    }
    private function validate(Request $r): array {
        return $r->validate([
            'ime'        => 'required|string|max:100',
            'prezime'    => 'required|string|max:100',
            'callsign'   => 'nullable|string|max:20',
            'uloga'      => 'required|string|max:100',
            'email'      => 'nullable|email',
            'redoslijed' => 'integer',
            'aktivan'    => 'boolean',
            'slika'      => 'nullable|image|max:4096',
        ]);
    }
}