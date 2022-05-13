<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Material::orderBy('codigo','asc');

        if($request->busca != null){
            $query->where('codigo', '=', "$request->busca");
        }
        $materials = $query->paginate(50);
        if ($materials->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('materials.index')->with('materials',$materials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material = new Material;
        return view('materials.create')->with('material', $material);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
        $validated = $request->validated();
        $validated['created_by_id']= auth()->user()->id;
        $material = Material::create($validated);
        return redirect("materials/$material->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('materials.edit')->with('material', $material);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, Material $material)
    {
        $validated = $request->validated();
        $material->update($validated);
        return redirect("materials/$material->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return redirect('materials');
    }
}
