<?php
namespace App\Modules\Sismed\Enum;

use Greg0ire\Enum\AbstractEnum;

class Situacao extends AbstractEnum
{

    const A = "A periciar";
    const C = "Concluído";
    const X = "Cancelado";

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
        $values = self::getConstants();
        unset($values['X']);

        $array = array("" => "");
        return array_merge($array, $values);
    }
    
}