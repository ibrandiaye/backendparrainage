<?php

namespace App\Http\Controllers;

use App\Repositories\CarteRepository;
use App\Repositories\CollecteurRepository;
use App\Repositories\CommuneRepository;
use App\Repositories\RegionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/* use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing; */
//require 'vendor/autoload.php';
use Intervention\Image\Facades\Image;
use PDF;

class CarteController extends Controller
{
    protected $carteRepository;
    protected $communeRepository;
    protected $collecteurRepository;
    protected $regionRepository;

    public function __construct(CarteRepository $carteRepository, CommuneRepository $communeRepository,
    CollecteurRepository $collecteurRepository,RegionRepository $regionRepository){
        $this->carteRepository =$carteRepository;
        $this->communeRepository = $communeRepository;
        $this->collecteurRepository=$collecteurRepository;
        $this->regionRepository=$regionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartes = $this->carteRepository->getAll();
        return view('carte.index',compact('cartes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = $this->regionRepository->getAll();
        $collecteurs = $this->collecteurRepository->getAll();
        return view('carte.add',compact('regions','collecteurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $signatureDataUrl =  $request->signed;
        $nom=time().'.'.explode('/',explode(":",substr($signatureDataUrl,0,strpos
        ($signatureDataUrl,';')))[1])[1];
        Image::make($signatureDataUrl)->save(public_path("upload/").$nom);
        $request->merge(["liensignature"=>$nom]);
        $cartes = $this->carteRepository->store($request->all());
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carte = $this->carteRepository->getById($id);
        return view('carte.show',compact('carte'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $communes = $this->communeRepository->getAll();
        $carte = $this->carteRepository->getById($id);
        $collecteurs = $this->collecteurRepository->getAll();
        return view('carte.edit',compact('carte','communes','collecteurs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->carteRepository->update($id, $request->all());
        return redirect('carte');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->carteRepository->destroy($id);
        return redirect('carte');
    }
    public function enrgistrerApi(Request $request){
        $signatureDataUrl = $request['signature'];
       $nom=time().'.'.explode('/',explode(":",substr($signatureDataUrl,0,strpos
       ($signatureDataUrl,';')))[1])[1];
       Image::make($signatureDataUrl)->save(public_path("upload/").$nom);
       /*  // Décodez la signature de l'URL base64 en binaire
        $signatureBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureDataUrl));
        // Générez un nom de fichier unique pour l'image de signature
        $signature = uniqid() . '.png';
        // Enregistrez l'image dans le dossier public
        Storage::disk('public')->put('signatures/' . $signature, $signatureBinary); */
        $request->merge(["liensignature"=>$nom]);
        $this->carteRepository->store($request->except("signature"));
        return response()->json("ok");
    }
    public function carteByCollecteur($id,$nom){
        $cartesParCollecteurs = $this->carteRepository->parCollecteur($id);
        return view("carte.carte-by-collecteur",compact("cartesParCollecteurs","nom"));
    }
    public function carteByOneCollecteur($id){
        $cartesParUnCollecteur = $this->carteRepository->nbCarteByOneCollecteur($id);
        return response()->json($cartesParUnCollecteur);
    }
    public function pdfParRegion($id){
        $carte = $this->carteRepository->parRegion($id);
       $cartesParRegions = $carte->toArray();
     // $pdf = PDF::loadView('carte.pdfregion', ['cartesParRegions' => $cartesParRegions]);
   // return $pdf->download('carte.pdf');
    return view("carte.pdfregion",compact("cartesParRegions"));
    }
    //cartesParRegions
}
