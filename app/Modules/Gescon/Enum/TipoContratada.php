<?php
namespace App\Modules\Gescon\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoContratada extends AbstractEnum
{

    const PJ = "Pessoa Jurídica";
    const PF = "Pessoa Física";

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