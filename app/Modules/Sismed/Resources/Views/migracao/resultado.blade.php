@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::relatorio.index') !!}

@endsection


@section('content')

    @section('page-header')
        Importar Atestados
    @endsection


    <div class="well well-lg">
    <h4 class="red smaller lighter">Prontuário/Servidor Não Encontrado e Cadastrado: {{$qtd_servidorNaoEncontrado}}</h4>
    </div>

    <div class="well well-lg">
    <h4 class="red smaller lighter">Atestados Cadastrados Novo Servidor: {{$qtd_atestadoCadastradoNovoServidor}}</h4>
    </div>

    <div class="well well-lg">
    <h4 class="blue smaller lighter">Atestados  Duplicados: {{$qtd_atestadoDuplicado}}</h4>
    </div>

    <div class="well well-lg">
    <h4 class="green smaller lighter">Atestados Cadastrados: {{$qtd_atestadoCadastrado}}</h4>
        Concluídos: {{ $atestadoCadastradoConcluido }}<br>
        Cancelados: {{ $atestadoCadastradoApericiar }}<br>
        A periciar: {{ $atestadoCadastradoCancelado }}<br>
    </div>

  
  
@endsection




@section('script-end')
@parent

<script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/daterangepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>


<link rel="stylesheet" href="{{ URL::asset('assets/css/datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/daterangepicker.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datetimepicker.min.css') }}" />

<script type="text/javascript">


</script>
@endsection