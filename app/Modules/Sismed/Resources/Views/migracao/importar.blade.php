@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::relatorio.index') !!}

@endsection


@section('content')

    @section('page-header')
        Importar Atestados
    @endsection



    <div class="panel-body">
   

      
      {!! Form::open(['route'=>'sismed::importExcel', 'method'=>'post','id'=>'formulario', 'name'=>'formulario', 'enctype' => 'multipart/form-data','class' => 'form-horizontal', ]) !!}
          
          <div class="form-group">
              {!! Form::label('crm', 'Numero de Linhas:') !!}
              {!! Form::text('numero_linhas', null, ['class'=>'form-control input-large']) !!}
          </div>
          <div class="form-group">
              {!! Form::label('Verificar Cadastrados') !!}
              {{ Form::checkbox('verificaCadastro', 'true') }}
          </div>
          <div class="form-group">
              <input type="file" name="import_file" />
              {{ csrf_field() }}
              
              <br/>

              {!! Form::submit('Importar',['class'=>'btn btn-sm btn-primary']) !!}
          </div>
          
          
            
          
      {!! Form::close() !!}
      
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