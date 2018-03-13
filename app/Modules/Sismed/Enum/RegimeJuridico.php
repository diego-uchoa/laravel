<?php
namespace App\Modules\Sismed\Enum;

use Greg0ire\Enum\AbstractEnum;

class RegimeJuridico extends AbstractEnum
{

    const CLT = "Celetista";
    const EST = "Estatutário";

    public static function getValue($str)
    {

        foreach(self::getConstants() as $key => $value){
            if($key == $str){
                return $value;
            }
        }
        return false;

    }
    
    public static function lists()
    {
        $array = array("" => "");
        return array_merge($array, self::getConstants());
    }
}