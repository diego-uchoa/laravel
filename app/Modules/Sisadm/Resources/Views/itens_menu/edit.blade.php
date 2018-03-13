@extends('sisadm::layouts.master')

@section('script-head')

	<script type="text/javascript">
		$(function(){

			$.fn.hide_campos = function() {
			    $('#dv_nome').hide();
				$('#dv_sistema').hide();
				$('#dv_precedente').hide();
				$('#dv_rota').hide();
				$('#dv_ordem').hide();
				$('#dv_icon').hide();
				$('#dv_btn').hide();
			};
			
			$.fn.hide_campos(); 

			
			@if($itemMenu)

				@if($itemMenu->tipo == 'raiz')
					$('#dv_nome').show();
					$('#dv_sistema').show();
					$('#dv_ordem').show();
					$('#dv_icon').show();
		        	$('#dv_btn').show();
				@endif

				@if($itemMenu->tipo == 'submenu')
		        	$('#dv_nome').show();
					$('#dv_sistema').show();
					$('#dv_precedente').show();
					$('#dv_rota').show();
					$('#dv_ordem').show();
		        	$('#dv_btn').show();
				@endif	

			@endif
			
		
	   		$("input[name$='tipo']").click(function() {
		        var tipo = $(this).val();
		        
		        if(tipo == 'raiz')
		        {
		        	$.fn.hide_campos(); 
		        	$('#dv_nome').show();
					$('#dv_sistema').show();
					$('#dv_ordem').show();
					$('#dv_icon').show();
		        	$('#dv_btn').show();
		        }

		        if (tipo == 'submenu')
		        {
		        	$.fn.hide_campos(); 
		        	$('#dv_nome').show();
					$('#dv_sistema').show();
					$('#dv_precedente').show();
					$('#dv_rota').show();
					$('#dv_ordem').show();
		        	$('#dv_btn').show();
		        }
	        
	    	});
		
		});
	</script>

@endsection


@section('breadcrumbs-page')
	
	{!! Breadcrumbs::render('sisadm::itens_menu.edit', $itemMenu) !!}

@endsection


@section('page-header')
	Editar Item de Menu 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$itemMenu->no_item_menu}}
    </small>
@endsection


@section('content')
	<div class="col-xs-6">
        {!! Form::model($itemMenu, ['route'=>['sisadm::itens_menu.update', $itemMenu->id_item_menu], 'method'=>'put']) !!}

            @include('sisadm::itens_menu._form',['submit_text' => 'Editar'])

        {!! Form::close() !!}
	</div>
@endsection