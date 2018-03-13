<?php
namespace App\Modules\Parla\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoCargo extends AbstractEnum
{

    const T = "Titular";
    const S = "Suplente";
    const P = "Presidente";
    const VP1 = "Primeiro Vice-presidente";
    const VP2 = "Segundo Vice-presidente";
    const VP3 = "Terceiro Vice-presidente";

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