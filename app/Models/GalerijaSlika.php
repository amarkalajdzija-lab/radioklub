<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class GalerijaSlika extends Model {
    protected $table = 'galerija_slike';
    protected $fillable = ['naslov','slika','kategorija','datum','redoslijed'];
    protected $casts = ['datum' => 'date'];
}