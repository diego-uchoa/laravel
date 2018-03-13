<?php
namespace App\Modules\Parla\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoComissao extends AbstractEnum
{

    const P = "Permanente";
    const M = "Mista";
    const T = "Temporária";

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