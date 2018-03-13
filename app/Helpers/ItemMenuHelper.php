<?php

class ItemMenuHelper
{

	static	function testeMascara()
	{
		return '111.222.333-55';

	}

	static function montaSelectMenu($idItemPai, $itens, $itemMenuPrecedente = null)
	{
		$options = '';

		foreach($itens as $item){

			if($item->id_item_menu == $itemMenuPrecedente)
				$options = $options."<option value='".$item->id_item_menu."' data-parent='".$idItemPai."' selected='selected'>".$item->no_item_menu."</option>";
			else
				$options = $options."<option value='".$item->id_item_menu."' data-parent='".$idItemPai."' >".$item->no_item_menu."</option>";
		}
		
		return $options;
	}
}