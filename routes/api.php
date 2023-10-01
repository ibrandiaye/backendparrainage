<?php

use App\Http\Controllers\CarteController;
use App\Http\Controllers\CollecteurController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/verifier/collecteur',[CollecteurController::class,'verifierCollecteur'] )->name("home");
Route::get('/regions/all',[RegionController::class,'allRegionapi'] );
Route::get('/departement/by/region/{region}',[DepartementController::class,'byRegion'] );
Route::get('/commune/by/departement/{departement}',[CommuneController::class,'byDepartement'] );
Route::post('/enregistrer/carte',[CarteController::class,'enrgistrerApi'] )->name("home");
Route::get('/nb/carte/un/collecteur/{id}',[CarteController::class,'carteByOneCollecteur'] );


