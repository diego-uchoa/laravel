@permission('parla::respostas_mf.create')
	<a href="#" class="btn btn-sm btn-primary insert" data-url="{{route('parla::respostas_mf.create',['id'=>$proposicao->id_proposicao])}}">
	    <i class="ace-icon fa glyphicon-plus bigger-110"></i>
	    Nova Resposta
	</a>
@endpermission

<br>
<br>

<div id="table-container-respostas" class="table-container">
    @include('parla::respostas_mf._tabela')
</div>