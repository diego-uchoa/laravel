@extends('sisadm::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sisadm::auditoria.search') !!}

@endsection

<?php $helper = app('App\Helpers\UtilHelper'); ?>

@section('content')
    
    @section('page-header')
        Auditoria
    @endsection  
    
    <div class="row">
            {{ Form::open(array('route' => 'sisadm::auditoria.search', 'class' => 'form-horizontal', 'method'=>'get')) }}
                {{ Form::token() }}
                <div class="form-group">
                    {{ Form::label('id_usuario', 'Usuário', array('class' => 'col-sm-2 control-label')) }}
                    <div class="col-sm-10"> 
                        {!! Form::select('id_usuario', $usuarios, $user_id, ['data-placeholder' => 'Selecione ...', 'class' => 'chosen-select form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {{  Form::label('dt_inicio', 'Data Início', array('class' => 'col-sm-2 control-label ')) }}
                    <div class="col-sm-10">
                        {{ Form::text('dt_inicio', null, array('class' => 'form-control date-picker', 'placeholder' => 'Data Início')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{  Form::label('dt_fim', 'Data Fim', array('class' => 'col-sm-2 control-label')) }}
                    <div class="col-sm-10">
                        {{ Form::text('dt_fim', null, array('class' => 'form-control date-picker', 'placeholder' => 'Data Fim')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('no_sistema', 'Sistema', array('class' => 'col-sm-2 control-label')) }}
                    <div class="col-sm-10"> 
                        {!! Form::select('no_sistema', $sistemas, null, ['data-placeholder' => 'Selecione ...', 'class' => 'chosen-select form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10"> 
                        <button type="submit" class="btn btn-default">Pesquisar</button>
                    </div>
                </div>
            {{ Form::close() }}
    </div>
    <br/>
    
    <div class="row">
        <div class="panel-heading text-center">
            @if (!empty($auditorias) && count($auditorias) > 0)
                <h4 class="panel-title">Resultados de Auditoria ({{ $auditorias->total() }} encontrados)</h4>
            @else
                <h4 class="panel-title">Resultados de Adutorias</h4>
            @endif
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th width="10%">Data</th>
                    <th width="10%">Usuário</th>
                    <th width="5%">Evento</th>
                    <th width="5%">IP</th>
                    <th width="10%">URL / Modelo</th>
                    <th width="5%">Audit. ID</th>
                    <th width="25%">Valor Anterior</th>
                    <th width="25%">Valor Novo</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($auditorias) && count($auditorias) > 0)
                    @foreach($auditorias as $audit)
                    <tr>
                        <td>{{ $audit->created_at }}</td>
                        @if(isset($audit->usuario))
                            <td>{{ $audit->usuario->nr_cpf }} <br> ({{ $audit->usuario->no_usuario }})</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{{ $audit->event }}</td>
                        <td>{{ $audit->ip_address }}</td>
                        <td>{{ $audit->url }} <br> ({{ $audit->auditable_type }})</td>
                        <td>{{ $audit->auditable_id }}</td>
                        <td>
                            <ul>
                                {{ $audit->old_values }}                                
                            </ul>
                        </td>
                        <td>
                            <ul>
                                {{ $audit->new_values }}                                
                            </ul>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">Sem auditorias</td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        <!-- Pagination -->
        {{ $auditorias->links() }}
    </div>
@endsection

@section('script-end')

    @parent

    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/select.js') }}"></script>

    <script type="text/javascript">
        $.fn.data_picker = function() {
            //Métodos responsáveis pela funcionalidade de Data (Calendário)
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd/mm/yyyy',                
                language: 'pt-BR'
            })
        };

        $.fn.data_picker();
        $.fn.chosen_select();
    </script>
@endsection