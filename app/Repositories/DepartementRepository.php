<?php
namespace App\Repositories;

use App\Models\Departement;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class DepartementRepository extends RessourceRepository{
    public function __construct(Departement $departement){
        $this->model = $departement;
    }
    public function getAllWithRegion(){
        return Departement::with('region')
        ->get();
    }
    public function getByRegion($region){
            return DB::table("departements")
            ->where("region_id",$region)
            ->get();
    }
}
