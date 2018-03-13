<?php

class GesconHelper
{

	static function maskMoney($number) { 
	    return number_format($number, 2, ',', '.');
	} 
		
}