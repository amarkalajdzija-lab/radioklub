<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Vijest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
 
class AdminVijestController {
    public function index() {
        $vijesti = Vijest::orderByDesc('datum')->get();
        return view('admin.vijesti.index', compact('vijesti'));
    }
    public function create() { return view('admin.vijesti.form', ['vijest' => new Vijest]); }
    public function store(Request $request) {
        $data = $this->validateVijest($request);
        $data['slug'] = Str::slug($data['naslov']);
        if ($request->hasFile('slika')) {
            $data['slika'] = $request->file('slika')->store('vijesti', 'public');
        }
        Vijest::create($data);
        return redirect()->route('admin.vijesti.index')->with('uspjeh', 'Vijest objavljena!');
    }
    public function edit(Vijest $vijesti) { return view('admin.vijesti.form', ['vijest' => $vijesti]); }
    public function update(Request $request, Vijest $vijesti) {
        $data = $this->validateVijest($request);
        if ($request->hasFile('slika')) {
            $data['slika'] = $request->file('slika')->store('vijesti', 'public');
        }
        $vijesti->update($data);
        return redirect()->route('admin.vijesti.index')->with('uspjeh', 'Vijest ažurirana!');
    }
    public function destroy(Vijest $vijesti) {
        $vijesti->delete();
        return back()->with('uspjeh', 'Vijest obrisana.');
    }
    private function validateVijest(Request $r): array {
        return $r->validate([
            'naslov'      => 'required|string|max:255',
            'kategorija'  => 'required|string|max:100',
            'kratki_opis' => 'required|string|max:500',
            'tekst'       => 'required|string',
            'datum'       => 'required|date',
            'featured'    => 'boolean',
            'objavljena'  => 'boolean',
            'slika'       => 'nullable|image|max:4096',
        ]);
    }
}