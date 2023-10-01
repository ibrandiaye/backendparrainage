<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;
    protected $fillable = [
        'prenom','nom','numelec','numcni','commune_id','collecteur_id','liensignature','expiration',
        'departement_id','region_id'
    ];

    public function commune(){
        return $this->belongsTo(Commune::class);
    }
    public function collecteur(){
        return $this->belongsTo(Collecteur::class);
    }
    public function departement(){
        return $this->belongsTo(Departement::class);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
}
