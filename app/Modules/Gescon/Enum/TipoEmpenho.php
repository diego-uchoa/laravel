<?php
namespace App\Modules\Gescon\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoEmpenho extends AbstractEnum
{

    const ES = "Estimado";
    const GL = "Global";
    const OD = "Ordinário";
    
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