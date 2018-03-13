<?php
namespace App\Modules\Parla\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoAutor extends AbstractEnum
{

    const SEN = "Senador(a)";
    const DEP = "Deputado(a)";
    const ENT = "Entidade";

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