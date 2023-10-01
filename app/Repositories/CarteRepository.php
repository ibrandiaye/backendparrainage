<?php
namespace App\Repositories;

use App\Models\Carte;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class CarteRepository extends RessourceRepository{
    public function __construct(Carte $carte){
        $this->model = $carte;
    }
    public function CarteByRegion(){
        return   DB::table('regions')
        ->join('cartes','regions.id','=','cartes.region_id')
        ->select('regions.nom','regions.id', DB::raw('count(cartes.id) as nb'))
        ->groupBy('regions.nom','regions.id')
            ->get();
        /*  Carte::with("region")
        ->select('region.nom', DB::raw('count(id) as nb'))
        ->groupBy('citoyens.nom')
        ->get(); */

    }
    public function nbCarteByCollecteurs(){
        return   DB::table('collecteurs')
        ->join('cartes','collecteurs.id','=','cartes.collecteur_id')
        ->select('collecteurs.nom','collecteurs.id', DB::raw('count(cartes.id) as nb'))
        ->groupBy('collecteurs.nom','collecteurs.id')
            ->get();
        /*  Carte::with("region")
        ->select('region.nom', DB::raw('count(id) as nb'))
        ->groupBy('citoyens.nom')
        ->get(); */

    }
    public function nbCarteByOneCollecteur($id){
        return   DB::table('collecteurs')
        ->join('cartes','collecteurs.id','=','cartes.collecteur_id')
        ->where("collecteurs.id",$id)
        ->select('collecteurs.nom','collecteurs.id', DB::raw('count(cartes.id) as nb'))
        ->groupBy('collecteurs.nom','collecteurs.id')
            ->get();

    }
    public function nbCarteGroupByDepartementByRegion($region){
        return   DB::table('departements')
        ->join('cartes','departements.id','=','cartes.departement_id')
        ->select('departements.nom', DB::raw('count(cartes.id) as nb'))
        ->groupBy('departements.nom')
        ->where("cartes.region_id",$region)
        ->get();
        /*  Carte::with("region")
        ->select('region.nom', DB::raw('count(id) as nb'))
        ->groupBy('citoyens.nom')
        ->get(); */

    }
    public function parRegion($region){
        return DB::table("cartes")
        ->where("region_id",$region)
        ->get();
    }
    public function parDepartement($departement){
        return DB::table("cartes")
        ->where("departement_id",$departement)
        ->get();
    }
    public function parCommune($commune){
        return DB::table("cartes")
        ->where("commune_id",$commune)
        ->get();
    }
    public function parCollecteur($collecteur){
        return DB::table("cartes")
        ->where("collecteur_id",$collecteur)
        ->get();
    }
    public function nbCarte(){
        return   DB::table('cartes')
        ->select( DB::raw('count(cartes.id) as nb'))
        ->get();


    }
}
