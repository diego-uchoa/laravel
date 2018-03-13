<div class="modal fade" id="modal-encerrar" role="dialog" data-toggle="modal">
  
  <div class="modal-dialog">

    <div class="modal-content">

      {!! Form::open(['route'=>['gescon::contratos.encerramento'], 'id'=>'formulario_data']) !!}
        {!! Form::hidden('id_contrato', isset($id_contrato) ? $id_contrato : '', ['class' => 'form-control', 'id' => 'id_contrato']) !!}
        
        <div class="modal-header">
          <a class="close" data-dismiss="modal">&times;</a>
          <h4>Favor informar a data de encerramento do contrato e uma justificativa!</h4>
        </div>  
        <div class="modal-body">
            <div class="row">
              <div class="col-xs-6 col-sm-6">
                <div class="form-group">
                  {!! Form::label('dt_encerramento', 'Data de Encerramento:') !!}
                  <div class="input-group">
                      {!! Form::text('dt_encerramento', null, ['class'=>'form-control date-picker', 'data-date-format' => 'dd/mm/yyyy', 'id' => 'dt_encerramento']) !!}
                      <span class="input-group-addon">
                          <i class="fa fa-calendar bigger-110"></i>
                      </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                  <div class="input-group">
                      {!! Form::label('ds_justificativa', 'Justificativa:') !!}
                      {!! Form::textarea('ds_justificativa', null, ['class' => 'form-control limited', 'id' => 'ds_justificativa', 'size' => '40x3', 'maxlength' => '255']) !!}
                  </div>
                </div>    
              </div>
            </div>
        </div>
            
            <div class="modal-footer">
          {!! Form::button('Salvar', ['class'=>'btn btn-sm btn-primary encerrar_contrato', 'id' => 'btnFormSalvarAJAX']) !!}
        </div>

          {!! Form::close() !!}
      
          <div id='snippet'>
         
      </div>

    </div>

  </div>

</div>