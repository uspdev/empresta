<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoRequest;
use Carbon\Carbon;
use App\Models\Material;
use Uspdev\Wsfoto;
use Uspdev\Replicado\Pessoa;

class EmprestimoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:balcao');
    }
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
    /*public function create()
    {
        return view('emprestimos.create')->with([
            'emprestimo' => New Emprestimo,
        ]);
    }*/

    public function usp(){
        return view('emprestimos.usp');  
    }

    public function visitante(){
        return view('emprestimos.visitante')->with([
            'emprestimo' => New Emprestimo,
        ]);
    }

    public function devolucao(){
        return view('emprestimos.devolucao');
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
        if($validated['username'] != null and Pessoa::dump($validated['username']) == null){
            $request->session()->flash('alert-danger', 'Usuário não existe!');
            return redirect()->back();
        }
        $check = Material::where('codigo', $validated['material_id'])->first();
        if($check){
            if($check->ativo != 1){
                $request->session()->flash('alert-danger', 'Item não está ativo para empréstimos');
                return redirect()->back();
            }
            $check2 = Emprestimo::where('material_id', $check->id)->where('data_devolucao', null)->first();
            
            if($check2 == null){
                $validated['data_emprestimo']= Carbon::now()->format('Y-m-d H:i:s');
                $validated['created_by_id']= auth()->user()->id;
                $validated['material_id'] = $check->id;
                $emprestimo = Emprestimo::create($validated);
            }
            else{
                $request->session()->flash('alert-danger', 'Item ainda não devolvido!');
                return redirect()->back();
            }

        } else {
            $request->session()->flash('alert-danger', 'Item não encontrado');
            return redirect()->back();
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
        if($emprestimo->username) {
            $emprestimo->foto = Wsfoto::obter($emprestimo->username);
        }
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
    /*public function update(Request $request, Emprestimo $emprestimo)
    {
        $emprestimo->data_devolucao = Carbon::now();
        $emprestimo->save();
        return redirect('/emprestimos');
    }*/

    public function devolver(Request $request){
        $request->validate([
            'material_id' => 'required',
        ]);
        $material = Material::where('codigo', $request['material_id'])->first();
        if($material != null){
            $emprestimo = Emprestimo::where('material_id', $material->id)->where('data_devolucao', null)->first();
            if($emprestimo != null){
                $emprestimo->data_devolucao = Carbon::now()->format('Y-m-d H:i:s');
                $emprestimo->save();
                $request->session()->flash('alert-success', 'Item devolvido!');
            }
            else{
                $request->session()->flash('alert-danger', 'Empréstimo não localizado! Verifique se o código do material informado está emprestado atualmente!');
            }
        }
        else{
            $request->session()->flash('alert-danger', 'Item não encontrado! Verifique o código do material!');
        }
        return redirect('/emprestimos/devolucao');

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