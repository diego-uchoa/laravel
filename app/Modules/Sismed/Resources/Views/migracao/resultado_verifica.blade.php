@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::relatorio.index') !!}

@endsection


@section('content')

    @section('page-header')
        Confere Cadastro Atestados Atestados
    @endsection


    <div class="well well-lg">
    <h4 class="red smaller lighter">Prontuário/Servidor Não Encontrado : {{$servidorNaoEncontrado->count()}}</h4>
        @foreach ($servidorNaoEncontrado as $naoEncontrado)

            {{$naoEncontrado['nr_cpf']}} / {{$naoEncontrado['no_servidor']}} <br>
        @endforeach
    </div>

    <div class="well well-lg">
    <h4 class="red smaller lighter">Atestados não cadastrados/Servidor Não Encontrado: {{$atestadoServidorNaoEncontrado->count()}}</h4>
        @foreach($atestadoServidorNaoEncontrado as $naoCadastradoServidor)

            {{$naoCadastradoServidor['nr_cpf']}} / {{$naoCadastradoServidor['dt_inicio_afastamento']}} <br>
        @endforeach
    </div>

    <div class="well well-lg">
    <h4 class="blue smaller lighter">Atestados  não cadastrados: {{$atestadoNaoCadastrado->count()}}</h4>
        @foreach($atestadoNaoCadastrado as $naoCadastrado)
            {{$naoCadastrado['PLA_nr_cpf']}} / {{$naoCadastrado['PLA_dt_inicio_afastamento']}} / {{$naoCadastrado['PLA_in_tipo_pericia']}} / {{$naoCadastrado['PLA_in_situacao']}} <br>
        @endforeach
    </div>

    <div class="well well-lg">
    <h4 class="green smaller lighter">Atestados Cadastrados: {{$atestadoCadastrado->count()}}</h4>
        @foreach($atestadoCadastrado as $cadastrado)
            {{$cadastrado['PLA_nr_cpf']}} / {{$cadastrado['PLA_dt_inicio_afastamento']}} / {{$cadastrado['PLA_in_tipo_pericia']}} / {{$cadastrado['PLA_in_situacao']}} - 
            {{$cadastrado['BD_id_servidor']}} / {{$cadastrado['BD_dt_inicio_afastamento']}} / {{$cadastrado['BD_in_tipo_pericia']}} / {{$cadastrado['BD_in_situacao']}} = 
            @if($cadastrado['BD_in_tipo_pericia'] != $cadastrado['PLA_in_tipo_pericia'])
                DIFERENTE
                @else
                IGUAL
                @endif
                <br>
        @endforeach
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