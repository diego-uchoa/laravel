@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::servidor.atestados',$servidor) !!}

@endsection

@section('script-head')
@parent

  <script src="{{ asset('modules/sismed/js/servidor-update.js') }}"></script>

  <style type="text/css" media="screen">
    .infobox-small {width: 300px;}
    .infobox .infobox-content {max-width: 300px;}
    .infobox-small>.infobox-data {max-width: 300px;}
  </style>
@endsection

@section('content')

    @section('page-header')
        Prontuário: {{ $servidor->co_prontuario }}
          <a class="pull-right" id="collapse" data-toggle="collapse" data-target="#collapse-form,#collapse-btn" aria-expanded="false" aria-controls="#collapse-form,#collapse-btn" data-rel="tooltip" data-placement="top" data-original-title="Dados do Servidor">
            <i class="ace-icon fa fa-plus"></i>
          </a>
    @endsection


    {!! Form::model($servidor, ['route'=>['sismed::servidor.update', 'id' => $servidor->id_servidor], 'method'=>'put', 'id'=>'formulario-servidor', 'data-id' => $servidor->id_servidor ]) !!}


      
      @include('sismed::servidor._form',['submit_text' => 'Salvar'])

      <div class="collapse form-group col-xs-12" id="collapse-btn">
          
          @permission('sismed::servidor.edit')
          <a href="#" id='link-alterar' value='alterar' class="btn btn-xs btn-info pull-right"><i class="ace-icon fa fa-pencil"></i>Alterar</a>
          @endpermission

          <a href="#" id='div-btn' class="btn btn-xs btn-info pull-right" style="margin-left: 5px" data-url="{{route('sismed::servidor.update',['id' => $servidor->id_servidor])}}"><i class="ace-icon fa fa-save"></i>Salvar</a>
      
      </div>

      
    {!! Form::close() !!}
    

    <br><br><br><br>
    

    <h3 class="header smaller lighter blue">
      <i class="ace-icon fa fa-plus-square"></i>
      Atestados
    </h3>
    

    <div>
    
      @if($acumulado > 120)
      <div class="infobox infobox-red infobox-small infobox-dark">
      @else
      <div class="infobox infobox-grey infobox-small infobox-dark">
      @endif
      <div class="infobox-icon">
        <i class="ace-icon fa fa-calculator"></i>
      </div>
      <div class="infobox-data">
        <div class="infobox-content">Ciclo Atual: {{$dataInicioAcumulado}} - {{$dataFimAcumulado}}</div>
        <div class="infobox-content">Acumulado: {{$acumulado}} dias</div>
      </div>

    </div>




    <br><br>


    <div class="pull-left">
      <b class="text-primary">Visualizar:</b>

      &nbsp;
      <div id="toggle-result-format" class="btn-group btn-overlap">

        <a href="{{route('sismed::servidor.atestados',['id'=>$servidor->id_servidor])}}"
          class="btn btn-lg btn-white btn-primary 
          @if(isset($ciclos)) active @endif
          " data-class="btn-primary" 
          data-rel="tooltip" data-placement="top" data-original-title="Lista de Atestados">
          <i class="icon-only ace-icon fa fa-list"></i>
          
        </a>

        <a href="{{route('sismed::servidor.atestados',['id'=>$servidor->id_servidor])}}?ciclos"
         class="btn btn-lg btn-white btn-grey
         @if(isset($ciclosAgrupados)) active @endif
         " data-class="btn-warning"
         data-rel="tooltip" data-placement="top" data-original-title="Por Ciclos">
         <i class="icon-only ace-icon fa fa-clone"></i>

       </a>

     </div>
   </div>


   @permission('sismed::atestado.create')
   <a href="#" class="btn btn-sm btn-primary insert pull-right" data-url="{{route('sismed::atestado.create',['id' => $servidor->id_servidor])}}" data-rel="tooltip" data-placement="top" data-original-title="Novo Atestado">
       <i class="ace-icon fa glyphicon-plus bigger-110"></i>
       Novo
   </a>
   @endpermission

  <br><br><br>  

  <div class="table-container">
  @if(isset($ciclos))
    @include('sismed::servidor.atestado._tabela')
  @endif

  @if(isset($ciclosAgrupados))
    @include('sismed::servidor.atestado._tabela_ciclos')
  @endif
  </div> 

  <div class="formulario-container">
    @include('sismed::servidor.atestado._modal')
  </div> 

@endsection




@section('script-end')
@parent

<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/dataTables.tableTools.min.js') }}"></script>

<script src="{{ URL::asset('assets/js/moment.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/daterangepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::asset('assets/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>


<link rel="stylesheet" href="{{ URL::asset('assets/css/datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/daterangepicker.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datetimepicker.min.css') }}" />

<script src="{{ asset('modules/sismed/js/atestado.js') }}"></script>

<script src="{{ asset('modules/sisadm/js/ajax_crud.js') }}"></script>

@endsection