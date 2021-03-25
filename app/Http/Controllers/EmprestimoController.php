<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoRequest;
use Carbon\Carbon;
use App\Models\Material;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Emprestimo::orderBy('data_emprestimo','asc')->where('data_devolucao', null);

        if($request->busca != null){
            $material = Material::where('codigo', $request->busca)->first();
            $query->where('material_id', $material->id);
        }
        $emprestimos = $query->paginate(50);
        if ($emprestimos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('emprestimos.index')->with('emprestimos',$emprestimos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emprestimos.create')->with([
            'emprestimo' => New Emprestimo,
        ]);
    }

    /**
     * Método que realiza empréstimo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmprestimoRequest $request)
    {
        $validated = $request->validated();
        $check = Material::where('codigo', $validated['material_id'])->first();
        $check2 = Emprestimo::where('material_id', $check->id)->where('data_devolucao', null)->first();
        if($check->ativo == 1 and $check2 == null){
            $validated['data_emprestimo']= Carbon::now()->toDateString();
            $validated['created_by_id']= auth()->user()->id;
            $validated['material_id'] = $check->id;
            $emprestimo = Emprestimo::create($validated);
        }
        else{
            $request->session()->flash('alert-danger', 'Item ainda não devolvido!');
            return redirect('/emprestimos/create');
        }
        return redirect("/emprestimos/$emprestimo->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function show(Emprestimo $emprestimo)
    {
        return view('emprestimos.show', compact('emprestimo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Emprestimo $emprestimo)
    {
        
    }*/

    /**
     * Usando o método update para devolução
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        $emprestimo->data_devolucao = Carbon::now();
        $emprestimo->save();
        return redirect('/emprestimos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprestimo $emprestimo)
    {
        $emprestimo->delete();
        return redirect('/');
    }

    public function relatorio(Request $request)
    {
        $query = Emprestimo::orderBy('data_emprestimo','asc');

        if($request->busca != null){
            $material = Material::where('codigo', $request->busca)->first();
            $query->where('material_id', $material->id);
        }
        $emprestimos = $query->paginate(50);
        if ($emprestimos->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('emprestimos.relatorio')->with('emprestimos',$emprestimos);

    }
}