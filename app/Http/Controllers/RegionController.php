<?php

namespace App\Http\Controllers;

use App\Imports\RegionImport;
use App\Repositories\RegionRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class RegionController extends Controller
{

    protected $regionRepository;

    public function __construct(RegionRepository $regionRepository){
        $this->regionRepository =$regionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = $this->regionRepository->getAll();
        return view('region.index',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('region.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regions = $this->regionRepository->store($request->all());
        return redirect('region');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = $this->regionRepository->getById($id);
        return view('region.show',compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = $this->regionRepository->getById($id);
        return view('region.edit',compact('region'));
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
        $this->regionRepository->update($id, $request->all());
        return redirect('region');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->regionRepository->destroy($id);
        return redirect('region');
    }
    public function    allRegionapi(){
        $regions = $this->regionRepository->getAll();
        return response()->json($regions);
    }
    public function importExcel(Request $request)
{

      Excel::import(new RegionImport,$request['file']);
   //  dd($data);

    return redirect()->back()->with('success', 'Données importées avec succès.');
}



}
