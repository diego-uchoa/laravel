<?php
namespace App\Modules\Sismed\Enum;

use Greg0ire\Enum\AbstractEnum;

class SituacaoServidor extends AbstractEnum
{

    const A = "Ativo";
    const C = "Cedido";
    const R = "Requisitado";
    const AP = "Aposentado";
    const CC = "Nomeado Cargo em Comissão";
    const EXC = "Excluído";
    const CLT = "CLT ANS - DEC 6657/08";
    const EXE = "Exercicio Des. Carreira";
    const ART = "Art.93 8112";
    

    public static function getValue($str)
    {

        foreach(self::getConstants() as $key => $value){
            if($key == $str){
                return $value;
            }
        }
        return false;

    }

    public static function lists()
    {
        $array = array("" => "");
        return array_merge($array, self::getConstants());
    }
    
}