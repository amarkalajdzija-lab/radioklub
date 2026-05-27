<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
 
class Vijest extends Model {
    protected $table = 'vijesti';
    protected $fillable = ['naslov','slug','kategorija','kratki_opis','tekst','slika','featured','objavljena','datum'];
    protected $casts = ['featured' => 'boolean', 'objavljena' => 'boolean', 'datum' => 'date'];
 
    protected static function boot() {
        parent::boot();
        static::creating(function ($v) {
            $v->slug = $v->slug ?: Str::slug($v->naslov);
        });
    }
 
    public function scopeObjavljena($q) { return $q->where('objavljena', true); }
    public function scopeFeatured($q)   { return $q->where('featured', true); }
}