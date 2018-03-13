<?php
namespace App\Modules\Parla\Enum;

use Greg0ire\Enum\AbstractEnum;

class RegimeTramitacao extends AbstractEnum
{

    const P = "Prioridade";
    const U = "Urgência";
    const O = "Ordinária";
    const E = "Especial";

    public static function getValue($str)
    {

        foreach(self::getConstants() as $key => $value){
            if($key == $str){
                return $value;
            }
        }
        return false;

    }
}