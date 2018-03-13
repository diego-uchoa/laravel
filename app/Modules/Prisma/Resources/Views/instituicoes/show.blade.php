@extends('prisma::layouts.master')

@section('breadcrumbs-page')
  
    @permission('prisma::instituicoes.show.minha')
        {!! Breadcrumbs::render('prisma::instituicoes.show.minha', $instituicao) !!}
    @endpermission

    @permission('prisma::instituicoes.show.todas')
        {!! Breadcrumbs::render('prisma::instituicoes.show', $instituicao) !!}
    @endpermission

@endsection


@section('page-header')
    Instituição 
    <small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{ $instituicao->no_razao_social }}
    </small>
@endsection


@section('content')
	<div class="row">
	    <div class="col-xs-12 col-sm-5">
	    	<div id="dados-instituicao">
	    	    @include('prisma::instituicoes.show._dados_instituicao')
	    	</div>
	    	<br>
	    	<div id="dados-instituicao-responsavel-previsao">
	    	    @include('prisma::instituicoes.show._dados_instituicao_responsavel_previsao')
	    	</div>
        </div>

	    <div class="col-xs-12 col-sm-7">
	    	<div id="dados-responsavel">
	    	    @include('prisma::instituicoes.show._dados_responsavel')
	    	</div>
	    	<br>
	    	<div id="dados-editores">
	    	    @include('prisma::instituicoes.show._dados_editores')
	    	</div>
        </div>
    </div>  

    <div class="formulario-container">

    </div>  
@endsection


@section('script-end')
    
    @parent

    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>

    <script type="text/javascript">

        $(function() {

            $.fn.carregarFuncoes = function() {
                $.fn.inputMaiusculo();
                $('.input-mask-cpf').mask('999.999.999-99');
                $('.input-mask-telefone').focusout(function(){
                    var phone, element;
                    element = $(this);
                    element.unmask();
                    phone = element.val().replace(/\D/g, '');
                    if(phone.length > 10) {
                        element.mask("(99) 99999-999?9");
                    } else {
                        element.mask("(99) 9999-9999?9");
                    }
                }).trigger('focusout');
            };

            $(document).ready(function() {
                $.fn.inputMaiusculo = function() {
                    $('#no_relatorio').keyup(function() {
                        this.value = this.value.toUpperCase();
                    });
                };
            });
            
        });

        
    </script>

    <script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>
    <script src="{{ asset('modules/prisma/js/ajax_show.js') }}"></script>

@endsection