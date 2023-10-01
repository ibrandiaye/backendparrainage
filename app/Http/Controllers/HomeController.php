<?php

namespace App\Http\Controllers;

use App\Repositories\CarteRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $carteRepository;
    public function __construct(CarteRepository $carteRepository){
        $this->carteRepository = $carteRepository;
    }
    public function index(){
        $nbCartesParRegion = $this->carteRepository->CarteByRegion();
       $cartesParCollecteurs =$this->carteRepository->nbCarteByCollecteurs();
       $nbCartes = $this->carteRepository->nbCarte();
       $nbCarte = $nbCartes[0];
       //dd($nbCarte);

        return view("dasboard",compact("nbCartesParRegion","cartesParCollecteurs",
    "nbCarte"));
    }
    public function carteParRegion(){
        $nbCartesParRegion = $this->carteRepository->CarteByRegion();

        return view("dashboardr",compact("nbCartesParRegion"));
    }
    public function carteByDepartement($id,$nom){
        $nbCarteGroupByDepartementByRegions=$this->carteRepository->nbCarteGroupByDepartementByRegion($id);
        $carteByRegions = $this->carteRepository->parRegion($id);
        return view("carte.carte-by-departement",compact("nbCarteGroupByDepartementByRegions","nom","carteByRegions",
    "id"));
    }
}
