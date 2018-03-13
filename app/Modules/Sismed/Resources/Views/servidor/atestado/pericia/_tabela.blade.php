@if(isset($pericias))

<table class="table table-striped table-bordered table-hover">
       <thead>
           <th>Tipo de Perícia</th>
           <th>Prazo</th>           
           <th>Início</th>
           <th>Fim</th>
           <th>Perícia</th>
           <th>Situação</th>
           <th>Laudo</th>
           <th>Opções</th>
       </thead>

       <tbody>
          @foreach($pericias as $pericia)
               <tr>
                   <td>{{$pericia->tipoPericia()}}</td>
                   <td>{{$pericia->te_prazo}}</td>
                   <td>{{$pericia->dt_inicio_afastamento}}</td>
                   <td>{{$pericia->dt_fim_afastamento}}</td>
                   <td>{{$pericia->dt_pericia}}</td>
                   <td>{{$pericia->situacao()}}</td>
                   <td>
                   @if($pericia->no_laudo_fisico)
                   <a href="/uploads/sismed/{{$servidor->co_prontuario}}/{{ $pericia->no_laudo_fisico }}" class="btn btn-xs btn-yellow" target="_blank" 
                   data-rel="tooltip" data-placement="top" title="" data-original-title="Laudo">
                       <i class="ace-icon fa fa-stethoscope"></i>
                   </a>
                   @endif
                   </td>
                   <td> 
                    <a href="#" data-url="{{route('sismed::atestado.pericia.edit',['id'=>$pericia->id_pericia])}}" class="btn btn-xs btn-info update-pericia">
                        <i class="ace-icon fa fa-pencil"></i>
                    </a>
                   </td>
               </tr>
          @endforeach 
       </tbody>
       
   </table>

@endif
