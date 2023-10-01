<?php

namespace App\Http\Controllers;

use App\Imports\DepartementImport;
use App\Repositories\DepartementRepository;
use App\Repositories\RegionRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DepartementController extends Controller
{
    protected $departementRepository;
    protected $regionRepository;

    public function __construct(DepartementRepository $departementRepository, RegionRepository $regionRepository){
        $this->departementRepository =$departementRepository;
        $this->regionRepository = $regionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departements = $this->departementRepository->getAllWithRegion();
        return view('departement.index',compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = $this->regionRepository->getAll();
        return view('departement.add',compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departements = $this->departementRepository->store($request->all());
        return redirect('departement');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departement = $this->departementRepository->getById($id);
        return view('departement.show',compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regions = $this->regionRepository->getAll();
        $departement = $this->departementRepository->getById($id);
        return view('departement.edit',compact('departement','regions'));
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
        $this->departementRepository->update($id, $request->all());
        return redirect('departement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->departementRepository->destroy($id);
        return redirect('departement');
    }
    public function    byRegion($region){
        $departements = $this->departementRepository->getByRegion($region);
        return response()->json($departements);
    }
    public function importExcel(Request $request)
    {

          Excel::import(new DepartementImport,$request['file']);
       //  dd($data);

        return redirect()->back()->with('success', 'Données importées avec succès.');
    }
}
