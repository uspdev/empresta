<?php

namespace App\Http\Controllers;

use App\Models\CursoHabilitacao;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Uspdev\Replicado\Graduacao;

class CursoHabilitacaoController extends Controller
{
    public function __construct() {
        $this->middleware('can:admin');
    }

    public function index(){
        $cursos_cadastrados = CursoHabilitacao::all();

        return view('cursos_hab.index')->with([
            'cursos_cadastrados' => $cursos_cadastrados->isEmpty() ? array() : $cursos_cadastrados
        ]);
    }

    public function create(){
        $cursos_hab = Graduacao::obterCursosHabilitacoes(getenv('REPLICADO_CODUNDCLG'));
        $departamentos_ensino = Graduacao::listarDepartamentosDeEnsino();

        return view('cursos_hab.create')->with([
            'cursos_hab' => $cursos_hab,
            'departamentos_ensino' => $departamentos_ensino,
        ]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'curso_hab' => 'required',
            'departamento_ensino' => 'required',
        ]);
        
        $curso_hab_decode = json_decode($validated['curso_hab']);
        $departamento_decode = json_decode($validated['departamento_ensino']);

        if(!is_null(CursoHabilitacao::where('codcur', $curso_hab_decode->codcur)->where('codhab', $curso_hab_decode->codhab)->first())){
            session()->flash('alert-danger', 'Este curso e habilitação já estão cadastrados em um departamento!');
            return back();
        }

        $departamento = Departamento::firstOrCreate([
            'codset' => $departamento_decode->codset,
            'nomabvset' => $departamento_decode->nomabvset
        ]);

        $curso_hab = new CursoHabilitacao();
        $curso_hab->codcur = $curso_hab_decode->codcur;
        $curso_hab->nomcur = $curso_hab_decode->nomcur;
        $curso_hab->codhab = $curso_hab_decode->codhab;
        $curso_hab->nomhab = $curso_hab_decode->nomhab;
        $curso_hab->perhab = $curso_hab_decode->perhab;
        $curso_hab->departamento()->associate($departamento);
        $curso_hab->save();

        session()->flash('alert-success', 'Curso e Habilitação cadastrado no departamento com sucesso!');
        return redirect()->route('cursos_hab.index');
    }

    public function edit(CursoHabilitacao $curso){
        $cursos_hab = Graduacao::obterCursosHabilitacoes(getenv('REPLICADO_CODUNDCLG'));
        $departamentos_ensino = Graduacao::listarDepartamentosDeEnsino();

        return view('cursos_hab.edit')->with([
            'curso' => $curso,
            'cursos_hab' => $cursos_hab,
            'departamentos_ensino' => $departamentos_ensino,
        ]);
    }
}
