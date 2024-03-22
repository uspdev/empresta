<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Uspdev\Replicado\Graduacao;

class CursoHabilitacaoController extends Controller
{
    public function __construct() {
        $this->middleware('can:admin');
    }

    public function index(){
        $cursos_hab = Graduacao::obterCursosHabilitacoes(getenv('REPLICADO_CODUNDCLG'));
        $departamentos_ensino = Graduacao::listarDepartamentosDeEnsino();

        return view('cursos_hab.index')->with([
            'cursos_hab' => $cursos_hab,
            'departamentos_ensino' => $departamentos_ensino,
            'cursos_cadastrados' => array()
        ]);
    }
}
