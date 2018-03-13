<?php
namespace App\Modules\Sismed\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoAfastamento extends AbstractEnum
{

    const P = "Próprio";
    const A = "Acompanhamento";

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