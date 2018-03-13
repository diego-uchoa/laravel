<?php
namespace App\Modules\Parla\Enum;

use Greg0ire\Enum\AbstractEnum;

class Situacao extends AbstractEnum
{

    const T = "Tramitando";
    const S = "Sancionada";
    const E = "Sem eficácia";
    const I = "Indefinida";

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