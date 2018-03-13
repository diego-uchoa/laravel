@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::servidor.index') !!}

@endsection


@section('content')

    @section('page-header')
        <i class="ace-icon fa fa-plus-square"></i> Consulta Atestado 
    @endsection


  

   <div class="table-container">

    <div class="search-area well well-sm" style="background: #EFF3F8; border: 0;">
                            
        <h5 class="blue smaller">
          <i class="ace-icon fa fa-search light-grey bigger-110"></i>
          Filtros para Pesquisa
        </h5>

      <div class="row">

        <form method="POST" id="search-form" role="form" class="form-horizontal">
        
          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Período Registro:</label>

            <div class="col-sm-9">
              <input type="text" class="input-sm input-data"  name="inicio_dt_registro" id="inicio_dt_registro" placeholder="Início do Período">
              a
              <input type="text" class="input-sm input-data"  name="fim_dt_registro" id="fim_dt_registro" placeholder="Fim do Período">
            </div>
          </div>
        


          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Período Início do Afastamento:</label>

            <div class="col-sm-4">
              <input type="text" class="input-sm input-data"  name="inicio_dt_inicio" id="inicio_dt_inicio" placeholder="Início do Período">
              a
              <input type="text" class="input-sm input-data"  name="inicio_dt_fim" id="inicio_dt_fim" placeholder="Fim do Período">
            </div>

            <label class="col-sm-2 control-label no-padding-right">Período Fim do Afastamento:</label>

            <div class="col-sm-4">
              <input type="text" class="input-sm input-data" name="fim_dt_inicio" id="fim_dt_inicio" placeholder="Início do Período">
              a
              <input type="text" class="input-sm input-data" name="fim_dt_fim" id="fim_dt_fim" placeholder="Fim do Período">
            </div>
          </div>
        
          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Área de Atendimento:</label>

            <div class="col-sm-9">
              {!! Form::select('area_atendimento',$areaAtendimento, null, ['id'=>'area_atendimento','class'=>'input-sm']) !!}
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Tipo Afastamento:</label>

            <div class="col-sm-9">
              {!! Form::select('tipo_afastamento',$tipoAfastamento, null, ['id'=>'tipo_afastamento','class'=>'input-sm']) !!}
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Tipo Perícia:</label>

            <div class="col-sm-9">
              {!! Form::select('tipo_pericia',$tipoPericia, null, ['id'=>'tipo_pericia' ,'class'=>'input-sm']) !!}
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Situação:</label>

            <div class="col-sm-9">
              {!! Form::select('situacao',$situacao, null, ['id'=>'situacao' ,'class'=>'input-sm']) !!}
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Prazo:</label>

            <div class="col-sm-9">
              <input type="text" class="input-sm"  name="prazo" id="prazo" placeholder="Prazo">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right">Observação:</label>

            <div class="col-sm-9">
              <select name="observacao" id="observacao">
                <option value=''></option>
                <option value='%'>Sim</option>
              </select>

            </div>
          </div>


          <div class="form-group">
            <div class="col-sm-11">
              <button type="submit" class="btn btn-sm btn-primary insert pull-right">
                <i class="ace-icon fa fa-search bigger-110"></i>Pesquisar
              </button>
            </div>
          </div>


        </form>

        </div>

    </div>


    <table id="users-table" class="table table-striped table-bordered">
            

           <thead>
              <th>Prontuário</th>
              <th>Nome Servidor</th>
              <th>Aréa de Atendimento</th>
              <th>Tipo de Afastamento</th>
              <th>Tipo Perícia</th>          
              <th>Prazo Atestado</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Situação</th>
              <th>Observação</th>
              <th>Opções</th>               
           </thead>

           
  
           
           
           
       </table>

   </div> 

  
@endsection




@section('script-end')
@parent
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>

<script>

$(function() {
    $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
    });

    var oTable = $('#users-table').DataTable({
        language: {
          url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}",
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "{!! route('sismed::atestado.consulta') !!}",
            data: function (d) {
                    d.inicio_dt_registro = $('input[name=inicio_dt_registro]').val();
                    d.fim_dt_registro = $('input[name=fim_dt_registro]').val();
                    d.inicio_dt_inicio = $('input[name=inicio_dt_inicio]').val();
                    d.inicio_dt_fim = $('input[name=inicio_dt_fim]').val();
                    d.fim_dt_inicio = $('input[name=fim_dt_inicio]').val();
                    d.fim_dt_fim = $('input[name=fim_dt_fim]').val();
                    d.area_atendimento = $('select[id=area_atendimento]').val();
                    d.tipo_afastamento = $('select[id=tipo_afastamento]').val();
                    d.tipo_pericia = $('select[id=tipo_pericia]').val();
                    d.situacao = $('select[id=situacao]').val();
                    d.prazo = $('input[name=prazo]').val();
                    d.observacao = $('select[id=observacao]').val();       
            }
        },
        columns: [
            { data: 'servidor.co_prontuario', name: 'servidor.co_prontuario', width: 'auto' },
            { data: 'servidor.no_servidor', name: 'servidor.no_servidor', width: 'auto' },
            { data: 'in_area_atendimento', name: 'in_area_atendimento', width: 'auto' },
            { data: 'in_tipo_afastamento', name: 'in_tipo_afastamento', width: 'auto' },
            { data: 'in_tipo_pericia', name: 'in_tipo_pericia', width: 'auto' },
            { data: 'te_prazo', name: 'te_prazo', width: '10' },
            { data: 'dt_inicio_afastamento', name: 'dt_inicio_afastamento', width: 'auto' },
            { data: 'dt_fim_afastamento', name: 'dt_fim_afastamento', width: 'auto' },
            { data: 'in_situacao', name: 'in_situacao', width: 'auto' },
            { data: 'observacao', name: 'tx_observacao', width: 'auto' },
            { data: 'action', name: 'action', orderable: false, searchable: false, width: 'auto'}
            
        ],


        

        

    });
    

});


</script>


<style type="text/css">
  tfoot {
      display: table-header-group;
  }

  tfoot input {
    width: 100%;
  }

  .dataTables_processing {
      position: absolute;
      top: 410px;
      left: 50%;
      width: 100%;
      
      margin-left: -50%;
      margin-top: -25px;
      padding-top: 20px;
      text-align: center;
      
      
  }

  .input-icon>.ace-icon {
      padding: 0 3px;
      z-index: 2;
      position: absolute;
      top: 0px;
      bottom: 5px;
      left: 3px;
      line-height: 25px;
      display: inline-block;
      color: #909090;
      font-size: 12px;
  }
  
  .form-group{
    margin-bottom: 5px;
  }

</style>



  <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    
  <script type="text/javascript">

        $('.input-data').mask('99/99/9999');

  </script>

@endsection