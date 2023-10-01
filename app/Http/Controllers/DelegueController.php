<?php

namespace App\Http\Controllers;

use App\Repositories\DelegueRepository;
use Illuminate\Http\Request;

class DelegueController extends Controller
{

    protected $delegueRepository;

    public function __construct(DelegueRepository $delegueRepository){
        $this->delegueRepository =$delegueRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegues = $this->delegueRepository->getAll();
        return view('delegue.index',compact('delegues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('delegue.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $delegues = $this->delegueRepository->store($request->all());
        return redirect('delegue');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delegue = $this->delegueRepository->getById($id);
        return view('delegue.show',compact('delegue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delegue = $this->delegueRepository->getById($id);
        return view('delegue.edit',compact('delegue'));
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
        $this->delegueRepository->update($id, $request->all());
        return redirect('delegue');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->delegueRepository->destroy($id);
        return redirect('delegue');
    }
}
