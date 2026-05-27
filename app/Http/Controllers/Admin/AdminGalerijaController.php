<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GalerijaSlika;
use Illuminate\Http\Request;
 
class AdminGalerijaController {
    public function index() {
        $slike = GalerijaSlika::orderBy('redoslijed')->orderByDesc('datum')->get();
        return view('admin.galerija.index', compact('slike'));
    }
    public function create() { return view('admin.galerija.form', ['slika' => new GalerijaSlika]); }
    public function store(Request $request) {
        $data = $request->validate([
            'naslov'     => 'nullable|string|max:200',
            'kategorija' => 'required|string|max:100',
            'datum'      => 'nullable|date',
            'redoslijed' => 'integer',
            'slika'      => 'required|image|max:8192',
        ]);
        $data['slika'] = $request->file('slika')->store('galerija', 'public');
        GalerijaSlika::create($data);
        return redirect()->route('admin.galerija.index')->with('uspjeh', 'Slika dodana!');
    }
    public function edit(GalerijaSlika $galerija) { return view('admin.galerija.form', ['slika' => $galerija]); }
    public function update(Request $request, GalerijaSlika $galerija) {
        $data = $request->validate([
            'naslov'     => 'nullable|string|max:200',
            'kategorija' => 'required|string|max:100',
            'datum'      => 'nullable|date',
            'redoslijed' => 'integer',
            'slika'      => 'nullable|image|max:8192',
        ]);
        if ($request->hasFile('slika')) {
            $data['slika'] = $request->file('slika')->store('galerija', 'public');
        }
        $galerija->update($data);
        return redirect()->route('admin.galerija.index')->with('uspjeh', 'Slika ažurirana!');
    }
    public function destroy(GalerijaSlika $galerija) {
        \Storage::disk('public')->delete($galerija->slika);
        $galerija->delete();
        return back()->with('uspjeh', 'Slika obrisana.');
    }
}