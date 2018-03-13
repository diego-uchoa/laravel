<?php
namespace App\Modules\Gescon\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoContrato extends AbstractEnum
{

    const NO = "Normal";
    const SR = "Sub-rogado";

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