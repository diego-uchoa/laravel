<table id="dynamic-table" class="table table-striped table-bordered table-hover">
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
           @php ($cores = ['#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF','#EFF3F8','#FFF'])
           @php($i = 0)           
                

           @foreach($ciclos as $ciclo)
               
               @foreach($ciclo->atestados->sortBy('id_atestado') as $atestado)
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
               @php ($i++)
            @endforeach
            @foreach($cancelados as $cicloCancelado)
                @foreach($cicloCancelado->atestados->sortBy('id_atestado') as $atestado)
                  @if($atestado->in_situacao == 'X')
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
                           -
                              
                        </td>
                    </tr>
                  @endif
                @endforeach
                @php ($i++)
            @endforeach
           </tbody>
       </table>

       <br><br><br><br><br><br><br><br>