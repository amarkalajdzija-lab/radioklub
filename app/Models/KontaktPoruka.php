<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class KontaktPoruka extends Model {
    protected $table = 'kontakt_poruke';
    protected $fillable = ['ime','email','predmet','poruka','procitana'];
    protected $casts = ['procitana' => 'boolean'];
}