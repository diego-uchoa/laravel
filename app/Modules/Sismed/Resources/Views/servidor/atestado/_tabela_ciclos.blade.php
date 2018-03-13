<div class="tabbable tabs-below">
  <div class="tab-content">

  @php ($cores = ['#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF'])
  @php($i = 1)
  @foreach($ciclosAgrupados as $ciclo)  


    <div id="{{$i}}" 
      @if($i == 1) 
      class="tab-pane active"
      @else 
      class="tab-pane"
      @endif 
    >

    


    <b>Ciclo: {{$ciclo['dataInicioAcumulado']}} - {{$ciclo['dataFimAcumulado']}}</b> - Acumulado: {{$ciclo['acumulado']}} dias
    <br>
    <br>

    <table  class="table table-striped table-bordered table-hover">
           <thead>
               <th>Área de Atendimento</th>
               <th>Tipo de Afastamento</th>
               <th>Tipo de Perícia</th>
               <th>Prazo</th>           
               <th>Início</th>
               <th>Fim</th>
               <th>Arquivos</th>
               <th>Situação</th>
               <th>Observação</th>
               <th>Data de Registro</th>
               <th>Opções</th>
           </thead>
           <tbody>
               @foreach($ciclo['ciclo']->atestados->sortBy('id_atestado') as $atestado)
                   <tr style="background-color: {{$cores[$i]}}">
                       <td>{{$atestado->areaAtendimento() }}</td>
                       <td>{{$atestado->tipoAfastamento() }}</td>
                       <td>
                          @foreach($atestado->pericias as $pericia)
                            {{$pericia->tipoPericia() }} <br>
                          @endforeach
                       </td>
                       <td>{{$atestado->te_prazo }}</td>
                       <td>{{$atestado->dt_inicio_afastamento }}</td>
                       <td>{{$atestado->dt_fim_afastamento }}</td>
                       
                       <td>

                          @if($atestado->no_atestado_fisico)
                          <a href="/uploads/sismed/{{$servidor->co_prontuario}}/{{ $atestado->no_atestado_fisico }}" class="btn btn-xs btn-yellow" target="_blank" 
                          data-rel="tooltip" data-placement="top" title="" data-original-title="Atestado">
                              <i class="ace-icon fa fa-plus-square"></i>
                          </a>
                          @endif
                          @if($atestado->no_laudo_fisico)
                          <a href="/uploads/sismed/{{$servidor->co_prontuario}}/{{ $atestado->no_laudo_fisico }}" class="btn btn-xs btn-yellow" target="_blank" 
                          data-rel="tooltip" data-placement="top" title="" data-original-title="Laudo">
                              <i class="ace-icon fa fa-stethoscope"></i>
                          </a>
                          @endif
                       </td>
                       <td>{{$atestado->situacao() }}</td>
                       <td>
                          @if($atestado->tx_observacao)
                              <a class="btn btn-xs btn-warning" href="#" data-rel="tooltip" data-placement="top" data-original-title="{{$atestado->tx_observacao}}">
                                  <i class='ace-icon fa fa-exclamation-circle' ></i>
                              </a>
                              
                          @endif
                       </td>
                       <td>{{$atestado->created_at->format('d/m/Y')}}</td>
                        <td>
                          <a href="{{route('sismed::atestado.emitir',['id'=>$atestado->id_atestado])}}" class="btn btn-xs btn-default"
                          data-rel="tooltip" data-placement="top" data-original-title="Emitir Recibo">
                              <i class="ace-icon fa fa-file-text-o"></i>
                          </a>

                          @permission('sismed::atestado.edit')
                          <a href="{{route('sismed::atestado.edit',['id'=>$atestado->id_atestado])}}" data-url="{{route('sismed::atestado.edit',['id'=>$atestado->id_atestado])}}" class="btn btn-xs btn-info"
                          data-rel="tooltip" data-placement="top" data-original-title="Editar Atestado">
                            <i class="ace-icon fa fa-pencil"></i>
                          </a>
                          @endpermission
                          
                          @permission('sismed::atestado.destroy')
                          <a href="#" data-id="{{$atestado->id_atestado}}" data-url="{{route('sismed::atestado.destroy')}}" class="btn btn-xs btn-danger delete-justificativa" 
                          data-rel="tooltip" data-placement="top" data-original-title="Excluir Atestado">
                            <i class="ace-icon fa fa-trash-o"></i>
                          </a>
                          @endpermission

                          @permission('sismed::atestado.cancelar')
                          <a href="{{route('sismed::atestado.cancelar.alertar',['id'=>$atestado->id_atestado])}}" class="btn btn-xs btn-inverse"
                          data-rel="tooltip" data-placement="top" title="" data-original-title="Cancelar Atestado">
                            <i class="ace-icon fa fa-ban"></i>
                          </a>
                          @endpermission

                             
                       </td>
                   </tr>
               @endforeach
           </tbody>
       </table>


    </div>

  @php($i++)
  @endforeach


  </div>

  

  <ul class="nav nav-tabs" id="myTab2">

    @php($j = 1)
      @while ($j<=($i-1))
          <li id="{{$i}}" 
              @if($j == 1) 
              class=" active"
              @endif 
          >
            <a data-toggle="tab" href="#{{$j}}" aria-expanded="false">{{$j}}</a>
          </li>

          @php($j++)
      @endwhile

    </ul>

</div>


<br><br>



