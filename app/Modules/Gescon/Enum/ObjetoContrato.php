<?php
namespace App\Modules\Gescon\Enum;

use Greg0ire\Enum\AbstractEnum;

class ObjetoContrato extends AbstractEnum
{

    const BG = "Brigada";
    const TR = "Terceirizado";
    const VG = "Vigilante";
    const LP = "Limpeza";

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