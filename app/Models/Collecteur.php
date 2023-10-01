<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collecteur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom','login','mdp'
    ];
    public function cartes(){
        return $this->hasMany(Carte::class);
    }
}
