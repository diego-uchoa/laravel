<?php
namespace App\Modules\Sismed\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoPericia extends AbstractEnum
{

    const S = "Singular";
    const J = "Junta";
    const A = "Administrativo";

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