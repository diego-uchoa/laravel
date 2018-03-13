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
	
	{!! Breadcrumbs::render('sisadm::itens_menu.create') !!}

@endsection


@section('page-header')
	Criar Novo Item de Menu
@endsection


@section('content')

	<div class="col-xs-6">

		{!! Form::open(['route'=>'sisadm::itens_menu.store']) !!}

			@include('sisadm::itens_menu._form',['submit_text' => 'Salvar'])
			
	    {!! Form::close() !!}

	</div>
	
@endsection