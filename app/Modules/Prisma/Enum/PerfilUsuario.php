<?php
namespace App\Modules\Prisma\Enum;

use Greg0ire\Enum\AbstractEnum;

class PerfilUsuario extends AbstractEnum
{

    const R = "Responsável";
    const E = "Editor";

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