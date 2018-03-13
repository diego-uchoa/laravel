<?php
namespace App\Modules\Prisma\Enum;

use Greg0ire\Enum\AbstractEnum;

class SituacaoSolicitacao extends AbstractEnum
{

    const E = "Em análise";
    const P = "Aguardando análise";
    const C = "Concluído";
    const R = "Rejeitado";
    const A = "Aprovado";

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