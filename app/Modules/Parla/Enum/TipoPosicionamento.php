<?php
namespace App\Modules\Parla\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoPosicionamento extends AbstractEnum
{

    const B = "Base";
    const O = "Oposição";
    const I = "Indefinido";

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