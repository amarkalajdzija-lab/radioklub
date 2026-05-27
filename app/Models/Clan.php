<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class Clan extends Model {
    protected $table = 'clanovi';
    protected $fillable = ['ime','prezime','callsign','uloga','email','slika','redoslijed','aktivan'];
    protected $casts = ['aktivan' => 'boolean'];
 
    public function getPunoImeAttribute() {
        return $this->ime . ' ' . $this->prezime;
    }
}