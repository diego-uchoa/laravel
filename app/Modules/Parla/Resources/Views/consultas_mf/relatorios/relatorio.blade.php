@if(isset($tipo))
    @if($tipo == 1)
        @include('parla::consultas_mf.relatorios._tipo1')
    @elseif($tipo == 2)
        @include('parla::consultas_mf.relatorios._tipo2')
    @elseif($tipo == 3)
        @include('parla::consultas_mf.relatorios._tipo3')
    @endif
@endif