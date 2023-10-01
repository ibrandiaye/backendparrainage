<?php

namespace App\Http\Controllers;

use App\Repositories\CandidatRepository;
use Illuminate\Http\Request;

class CandidatController extends Controller
{

    protected $candidatRepository;

    public function __construct(CandidatRepository $candidatRepository){
        $this->candidatRepository =$candidatRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidats = $this->candidatRepository->getAll();
        return view('candidat.index',compact('candidats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidat.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $candidats = $this->candidatRepository->store($request->all());
        return redirect('candidat');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidat = $this->candidatRepository->getById($id);
        return view('candidat.show',compact('candidat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidat = $this->candidatRepository->getById($id);
        return view('candidat.edit',compact('candidat'));
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
        $this->candidatRepository->update($id, $request->all());
        return redirect('candidat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->candidatRepository->destroy($id);
        return redirect('candidat');
    }
}
