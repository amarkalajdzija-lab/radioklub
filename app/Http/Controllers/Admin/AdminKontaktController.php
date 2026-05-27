<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\KontaktPoruka;
 
class AdminKontaktController {
    public function index() {
        $poruke = KontaktPoruka::latest()->paginate(20);
        return view('admin.kontakt.index', compact('poruke'));
    }
    public function procitaj($id) {
        KontaktPoruka::findOrFail($id)->update(['procitana' => true]);
        return back();
    }
    public function destroy($id) {
        KontaktPoruka::findOrFail($id)->delete();
        return back()->with('uspjeh', 'Poruka obrisana.');
    }
}