@permission('parla::consultasMf.create')
	<a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('parla::consultasMf.create',['id'=>$proposicao->id_proposicao])}}">
	    <i class="ace-icon fa glyphicon-plus bigger-110"></i>
	    Nova Consulta
	</a>
@endpermission

<br>
<br>

<div id="table-container-consultas" class="table-container">
    @include('parla::consultas_mf._tabela')
</div>