<?php
namespace App\Modules\Gescon\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoFiscal extends AbstractEnum
{

    const FR = "Fiscal Requisitante";
    const FT = "Fiscal Técnico";
    const FA = "Fiscal Administrativo";
    const GE = "Gestor";
    const SE = "Fiscal Setorial";

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