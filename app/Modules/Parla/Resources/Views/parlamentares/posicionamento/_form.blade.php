<!-- Observações Field -->
<div class="form-group">
    {!! Form::label('in_posicionamento', 'Posicionamento') !!}
    {!! Form::select('in_posicionamento', ['B' => 'Base','O' => 'Oposição','I' => 'Indefinido'],null, ['class' => 'form-control']) !!}
</div>
