<?php

namespace App\Utils;

use Uspdev\Replicado\Pessoa;

class ReplicadoUtils
{

    /** Método que dado um codpes retorna
      * codpes - nome da pessoa
      */
    public static function pessoaUSP($codpes)
    {

        if(Pessoa::dump($codpes)) {
            $pessoa = explode(',', Pessoa::dump($codpes)['nompesttd'] .','. Pessoa::email($codpes));
            return $pessoa;
        }
        else {
            if(Pessoa::cracha($codpes)){
                $pessoa = explode(',', Pessoa::cracha($codpes)['nompescra'] .', ');
                return $pessoa;
            }
            else {
                return [false];
            }
        }
    }

    /**
     * Retorna os vínculos juntamente com os setores da pessoa.
     *
     * @param int $codpes
     * @return array $vinculos
     */
    public static function vinculos($codpes){
        return Pessoa::vinculos($codpes);
    }
}