<?php
namespace App\Modules\Gescon\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoVariacao extends AbstractEnum
{

    const RQ = "Reequilíbrio";
    const RP = "Repactuação";
    const RJ = "Reajuste";
    const DC = "Dissídio Coletivo";

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