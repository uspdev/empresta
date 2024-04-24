<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\CursoHabilitacao;
use App\Models\Setor;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Uspdev\Replicado\Graduacao;
use Uspdev\Replicado\Pessoa;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('balcao', function ($user) {
            if(Gate::allows('manager') || Auth::user()->hasPermissionTo('balcao')) return true;
            $verifica = User::where('username', $user->username)->where('tipo', 'Balcao')->first();
            if($verifica){
                return true;
            }
        });

        // Gate que verifica as restrições de vínculo e setor conjuntamente da categoria para permitir ou não empréstimos.
        Gate::define('emprestar-material', function(User $user, Categoria $categoria, int $solicitante_codpes){
            $vinculos_solicitante = array_column(Pessoa::listarVinculosAtivos($solicitante_codpes), 'tipvinext');
            return Gate::allows('emprestar-para-vinculo', [$categoria, $vinculos_solicitante]) && Gate::allows('emprestar-para-setor', [$categoria, $solicitante_codpes, $vinculos_solicitante]);
        });

        // Gate que verifica as restrições de setor da categoria.
        Gate::define('emprestar-para-setor', function($user, Categoria $categoria, int $solicitante_codpes, array $vinculos_solicitante){
            if($categoria->setores->isEmpty()) return true;
            
            if(in_array('Docente', $vinculos_solicitante) || in_array('Estagiário', $vinculos_solicitante) || in_array('Servidor', $vinculos_solicitante)){
                $setores_solicitante = array_column(Pessoa::listarVinculosAtivos($solicitante_codpes), 'codset');

                $setores = collect();
                foreach($setores_solicitante as $codset){
                    $setor = Setor::firstWhere('codset', $codset);
                    if(!is_null($setor))
                        $setores->push($setor);
                }

                return $categoria->setores->intersect($setores)->isNotEmpty();
            }
            elseif(in_array('Aluno de Graduação', $vinculos_solicitante)){
                $curso_solicitante = Graduacao::obterCursoAtivo($solicitante_codpes, env('REPLICADO_CODUNDCLG'));
            
                $curso_cadastrado = CursoHabilitacao::where('codcur', $curso_solicitante['codcur'])
                                        ->where('codhab', $curso_solicitante['codhab'])->first();

                if(!is_null($curso_cadastrado)){
                    return $categoria->setores->contains($curso_cadastrado->setor);
                }
            }
        });

        // Gate que verifica as restrições de vinculo da categoria.
        Gate::define('emprestar-para-vinculo', function($user, Categoria $categoria, array $vinculos_solicitante){
            if($categoria->vinculos->isEmpty()) return true;

            return count(array_intersect($categoria->vinculos->pluck('nome')->all(), $vinculos_solicitante)) > 0;
        });
    }
}
