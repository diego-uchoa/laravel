<?php
namespace App\Modules\Gescon\Enum;

use Greg0ire\Enum\AbstractEnum;

class ModalidadeGarantia extends AbstractEnum
{

    const DC = "Depósito Caução";
    const FB = "Fiança Bancária";
    const SG = "Seguro Garantia";
    const TD = "Título de Dívida Pública";
    const NH = "Nenhuma";

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