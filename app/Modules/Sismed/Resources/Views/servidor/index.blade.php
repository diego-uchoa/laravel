@extends('sismed::layouts.master')

@section('breadcrumbs-page')

  {!! Breadcrumbs::render('sismed::servidor.index') !!}

@endsection


@section('content')

    @section('page-header')
        <i class="ace-icon fa fa-user"></i> Consulta Servidor
        
        @permission('sismed::servidor.create')
        <a href="{{route('sismed::servidor.create')}}" class="btn btn-sm btn-primary pull-right">
            <i class="ace-icon fa glyphicon-plus bigger-110"></i>
            Novo
        </a>
        @endpermission
    
    @endsection


   <div class="table-container">
    
    <table id="users-table" class="table table-striped table-bordered">
           <thead>
              <th>Prontuário</th>
              <th>CPF</th>
              <th>SIAPE</th>
              <th>Nome</th>          
              <th>Órgão</th>
              <th>Opções</th>
               
               
           </thead>
           <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="non_searchable"></td>

            </tr>
            </tfoot>
           
       </table>

   </div> 

  
@endsection




@section('script-end')
@parent

<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>

<script>


$(function() {

    $('#users-table').DataTable({
        language: {
          url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}"
        },
        processing: true,
        serverSide: true,
        ajax: '{!! route('sismed::servidor.consulta') !!}',
        columns: [
            { data: 'co_prontuario', name: 'co_prontuario', width: '8%'},
            { data: 'nr_cpf', name: 'nr_cpf' , width: '10%'},
            { data: 'nr_siape', name: 'nr_siape' , width: '8%'},
            { data: 'no_servidor', name: 'no_servidor' , width: '30%'},
            { data: 'no_orgao', name: 'no_orgao' , width: '10%'},
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;

                        var columnClass = column.footer().className;
                        if(columnClass != 'non_searchable'){

                          var span = document.createElement("span");
                          $(span).addClass('input-icon input-icon-right');
                          var input = document.createElement("input");

                          var i = document.createElement("i");
                          $(i).addClass('ace-icon fa fa-search');

                          $(span).append($(input));
                          $(span).append($(i)); 
                    

                          $(span).appendTo($(column.footer()).empty());
                          $(input).on('change', function () {
                              column.search($(this).val(), false, false, true).draw();
                          });




                          

                        }

                        
                    });
                    
                },

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

</style>

@endsection