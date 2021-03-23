<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use App\Http\Requests\VisitanteRequest;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Visitante::orderBy('nome','asc');

        if($request->busca != null){
            $query->where('nome', 'LIKE', "%$request->busca%");
        }
        $visitantes = $query->paginate(50);
        if ($visitantes->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('visitantes.index')->with('visitantes',$visitantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visitante = new Visitante;
        return view('visitantes.create')->with('visitante', $visitante);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitanteRequest $request)
    {
        $validated = $request->validated();
        $visitante = Visitante::create($validated);
        return redirect("/visitantes/$visitante->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function show(Visitante $visitante)
    {
        return view('visitantes.show', compact('visitante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitante $visitante)
    {
        return view('visitantes.edit')->with('visitante', $visitante);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function update(VisitanteRequest $request, Visitante $visitante)
    {
        $validated = $request->validated();
        $visitante->update($validated);
        return redirect("/visitantes/$visitante->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitante  $visitante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitante $visitante)
    {
        $visitante->delete();
        return redirect('/visitantes');
    }
}
