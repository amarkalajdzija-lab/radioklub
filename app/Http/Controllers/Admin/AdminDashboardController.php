<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Clan, GalerijaSlika, Vijest, KontaktPoruka};
 
class AdminDashboardController {
    public function index() {
        $stats = [
            'clanovi'  => Clan::count(),
            'slike'    => GalerijaSlika::count(),
            'vijesti'  => Vijest::count(),
            'poruke'   => KontaktPoruka::where('procitana', false)->count(),
        ];
        $poruke = KontaktPoruka::where('procitana', false)->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'poruke'));
    }
}