<?php
namespace App\Repositories;

use App\Models\Commune;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class CommuneRepository extends RessourceRepository{
    public function __construct(Commune $commune){
        $this->model = $commune;
    }
    public function getAllWithdepartement(){
        return Commune::with(['departement','departement.region'])
        ->get();
    }
    public function getOneCommuneWithdepartementAndRegion($id){
        return Commune::with(['departement','departement.region'])
        ->where('id',$id)
        ->first();
    }
    public function getByDepartement($departement){
        return DB::table("communes")
        ->where("departement_id",$departement)
        ->get();
}
}
