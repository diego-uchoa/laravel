<div class="form-group">
    {!! Form::label('nome', 'Nome em relatórios:') !!}
    {!! Form::text('no_relatorio', null, ['class'=>'form-control', 'id'=>'no_relatorio']) !!}
</div>

@section('script-end')
    @parent

    
    <script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}"></script>

@endsection

