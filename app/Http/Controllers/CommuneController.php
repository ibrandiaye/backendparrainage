<?php

namespace App\Http\Controllers;

use App\Imports\CommuneImport;
use App\Imports\DepartementImport;
use App\Repositories\CommuneRepository;
use App\Repositories\DepartementRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CommuneController extends Controller
{
    protected $communeRepository;
    protected $departementRepository;

    public function __construct(CommuneRepository $communeRepository, DepartementRepository $departementRepository){
        $this->communeRepository =$communeRepository;
        $this->departementRepository = $departementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes = $this->communeRepository->getAllWithdepartement();
        return view('commune.index',compact('communes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = $this->departementRepository->getAll();
        return view('commune.add',compact('departements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $communes = $this->communeRepository->store($request->all());
        return redirect('commune');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commune = $this->communeRepository->getById($id);
        return view('commune.show',compact('commune'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departements = $this->departementRepository->getAll();
        $commune = $this->communeRepository->getById($id);
        return view('commune.edit',compact('commune','departements'));
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

        $this->communeRepository->update($id, $request->all());
        return redirect('commune');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->communeRepository->destroy($id);
        return redirect('commune');
    }
    public function byDepartement($departement){
        $communes = $this->communeRepository->getByDepartement($departement);
        return response()->json($communes);
    }
    public function importExcel(Request $request)
    {

          Excel::import(new CommuneImport,$request['file']);
       //  dd($data);

        return redirect()->back()->with('success', 'Données importées avec succès.');
    }
}
