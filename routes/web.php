<?php

use App\Http\Controllers\CandidatController;
use App\Http\Controllers\CarteController;
use App\Http\Controllers\CollecteurController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\DelegueController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name("home")->middleware("auth");
Route::resource('region', RegionController::class)->middleware("auth");
Route::resource('departement', DepartementController::class)->middleware("auth");
Route::resource('commune', CommuneController::class)->middleware("auth");
Route::resource('delegue', DelegueController::class)->middleware("auth");
Route::resource('collecteur', CollecteurController::class)->middleware("auth");
Route::resource('candidat', CandidatController::class)->middleware("auth");
Route::resource('carte', CarteController::class)->middleware("auth");

Route::get('/carte/by/departement/{id}/{nom}',[HomeController::class,'carteByDepartement'])->name("carte.by.departement")->middleware("auth");
Route::get('/carte/by/collecteur/{id}/{nom}',[CarteController::class,'carteByCollecteur'])->name("carte.by.collecteur")->middleware("auth");
Route::get('/generer/pdf/par/region/{id}',[CarteController::class,'pdfParRegion'])->name("pdf.by.region")->middleware("auth");
Route::get('/carte/by/region',[HomeController::class,'carteParRegion'])->name("carte.by.region")->middleware("auth");
Route::post('/importer/region',[RegionController::class,'importExcel'])->name("importer.region")->middleware("auth");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware("auth");
Route::get('/debartement/by/region/{region}',[DepartementController::class,'byRegion'])->name("departement.by.region")->middleware("auth");
Route::get('/commune/by/departement/{nom}',[CommuneController::class,'byDepartement'])->name("commune.by.departement")->middleware("auth");

Route::post('/importer/departement',[DepartementController::class,'importExcel'])->name("importer.departement")->middleware("auth");
Route::post('/importer/commune',[CommuneController::class,'importExcel'])->name("importer.commune")->middleware("auth");
