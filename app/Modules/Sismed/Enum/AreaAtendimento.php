<?php
namespace App\Modules\Sismed\Enum;

use Greg0ire\Enum\AbstractEnum;

class AreaAtendimento extends AbstractEnum
{

    const M = "Médico";
    const O = "Odontológico";
    const G = "Gestante";
    const C = "CAT/SP";

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