<?php

class MaskHelper
{

	static function maskMoney($number) { 
	    return number_format($number, 2, ',', '.');
	} 

	static function aplicaMascara($val, $mask)
	{
	    $maskared = '';
	    $k = 0;
	    for($i = 0; $i<=strlen($mask)-1; $i++)
	    {
	        if($mask[$i] == '#')
	        {
	            if(isset($val[$k]))
	                $maskared .= $val[$k++];
	        }
	        else
	        {
	            if(isset($mask[$i]))
	                $maskared .= $mask[$i];
	        }
	    }
	    return $maskared;
	}

	static function removeMascaraCpf($cpf)
	{
	    $cpf = str_replace("." , "" , $cpf); // remove os pontos
	    $cpf = str_replace("-" , "" , $cpf); // remove o hifen

	    return $cpf;
	}
}