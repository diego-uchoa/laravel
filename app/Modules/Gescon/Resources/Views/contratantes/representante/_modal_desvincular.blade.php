<div class="modal fade" id="modal-desvincular" role="dialog" data-toggle="modal">
  
  <div class="modal-dialog">

    <div class="modal-content">

      {!! Form::open(['route'=>['gescon::contratante_representante.destroy_representante'], 'id'=>'formulario_data']) !!}
        {!! Form::hidden('id_contratante', isset($id_contratante) ? $id_contratante : '', ['class' => 'form-control', 'id' => 'id_contratante']) !!}
        {!! Form::hidden('id', isset($id) ? $id : '', ['class' => 'form-control', 'id' => 'id']) !!}
        
        <div class="modal-header">
          <a class="close" data-dismiss="modal">&times;</a>
          <h4>Favor informar a data de desligamento do representante da UASG!</h4>
        </div>  
        <div class="modal-body">
            <div class="form-group">
              <div class="input-group">
                  {!! Form::text('dt_fim', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_fim']) !!}
                  <span class="input-group-addon">
                      <i class="fa fa-calendar bigger-110"></i>
                  </span>
              </div>
            </div>
        </div>
            
            <div class="modal-footer">
          {!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary delete_representante', 'id' => 'btnFormSalvarAJAX']) !!}
        </div>

          {!! Form::close() !!}
      
          <div id='snippet'>
         
      </div>

    </div>

  </div>

</div>