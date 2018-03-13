@extends('gescon::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('gescon::contratos.index') !!}

@endsection

@section('content')
        
    @section('page-header')
        Contratos
    @endsection
    

    <a href="#" class="btn btn-sm btn-primary insert">
        <i class="ace-icon fa glyphicon-plus bigger-110"></i>
        Novo
    </a>

    <br>
    <br>

    <div class="table-container">
        @include('gescon::contratos._tabela')
    </div> 

    <div class="formulario-container">
        @include('gescon::contratos._modal')
    </div> 

    <!--MODAL RESPONSÁVEL POR MOSTRAR O FORMULÁRIO DE ENCERRAMENTO DO CONTRATO-->
    @include('gescon::contratos._modal_encerramento')

@endsection

@section('script-end')
    
    @parent

    <script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    
    <script type="text/javascript">
        jQuery(function($) {                
            $.fn.dinamic_table = function() {
                var oTable = $('#dynamic-table').DataTable({
                    language: {
                      url: "{!! asset('modules/sisadm/Portuguese-Brasil.json') !!}", //Arquivo tradução para português
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('gescon::contratos.records') !!}',
                    columns: [//Configura os campos da datatable com os campos enviados pelo Controller. Cada linha a baixo é uma linha da table do html, tem que ter a mesma quantidade de <th>
                        { data: 'nr_contrato', name: 'nr_contrato', width: '15%' },
                        { data: 'in_tipo', name: 'in_tipo', width: '20%' },
                        { data: 'ds_objeto', name: 'ds_objeto', width: '40%' },
                        { data: 'dt_cessacao', name: 'dt_cessacao', width: '15%' },
                        { data: 'operacoes', name: 'operacoes', width: '10%' }
                    ],
                    drawCallback: function(settings) {
                        $("[data-rel=tooltip]").tooltip();
                    }
                });
            };

            $.fn.data_picker = function() {
                //Métodos responsáveis pela funcionalidade de Data (Calendário)
                $('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    endDate: '0' //data nao pode ser superior ao dia atual
                });
            };

            $(document).ready(function() {
                $.fn.data_picker();
                $.fn.dinamic_table(); 
            });

            $(document).on('click','.insert', function(event) {
                $('#modal-create').modal('show');
            });

            //Função responsável por excluir dados do registro selecionado
            $(document).on('click','.delete', function() {
                var url_destroy = $(this).data("url");
                var id_registro = $(this).data("id");
                
                bootbox.confirm("Deseja realmente excluir o registro?", function(result){
                    if(result){
                        
                        $.ajax({
                            url: url_destroy,
                            type: 'GET',
                            beforeSend: function() {
                                dialogDelete = bootbox.dialog({
                                    title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                                    message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                                    closeButton: true
                                });
                            },
                            success: function( data ) {
                                dialogDelete.init(function(){
                                    if (data.status == "success"){
                                        dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                                        dialogDelete.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                                        
                                        //Reload Tabela
                                        $('.table-container').html(data.html);
                                        $.fn.dinamic_table();   

                                        setTimeout(function(){
                                            dialogDelete.modal('hide');
                                        }, 3000);
                                    }else{
                                        dialogDelete.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                                        var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                                        if (typeof data.detail != "undefined"){
                                            aviso = aviso + '<ul class="list-unstyled spaced">';    
                                            aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                                            aviso = aviso + '</ul>';    
                                        }
                                        dialogDelete.find('.bootbox-body').html(aviso);
                                    }
                                });
                            },
                            error: function(data) {
                                if (typeof data.responseJSON == "undefined"){
                                    var erro = '<ul class="list-unstyled spaced">';    
                                    erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.statusText + '</li>';
                                    erro = erro + '</ul>';    
                                }else{
                                    var result = $.parseJSON(data.responseJSON.detail);
                                    var erro = '<ul class="list-unstyled spaced">';
                                    $.each(result, function(i, field){
                                        erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
                                    });
                                    erro = erro + '</ul>';    
                                }

                                dialogCreate.init(function(){
                                    dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                                    dialogCreate.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
                                }); 
                            }
                        });
                    }
                });
            });

            //Função responsável carregar a Modal responsável pelo Encerrar um Contrato
            $(document).on('click','.modal_encerrar', function(event) {
                
                var url_create = $(this).data('url');

                dialogCreate = bootbox.dialog({
                    message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                    closeButton: true
                });

                $.get(url_create, function (data) {
                    dialogCreate.modal('hide');
                    $('.formulario-container').html(data.html);
                    $('#modal-encerrar').modal('show');
                    
                    //Método responsável por adicionar o estilo ao select e a mascara, se necessário
                    $('#modal-encerrar').on('shown.bs.modal', function () {
                        $.fn.carregarFuncoes();
                    });
                })

            });

            $.fn.carregarFuncoes = function() {
                $.fn.data_picker();
            };

            //Função responsável por excluir dados do registro selecionado
            $(document).on('click','.encerrar_contrato', function() {
                var url = document.getElementById("formulario_data").action;
                
                var form = new FormData();

                //Recuperando os dados do formulário
                var formData = $('#formulario_data').serializeArray();    
                jQuery.each( formData, function( i, field ) {
                    form.append(field.name, field.value);   
                });

                $('.encerrar_contrato').prop("disabled",true);
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form,
                    dataType: 'json',
                    contentType: false, 
                    processData: false,
                    
                    beforeSend: function() {
                        dialogCreate = bootbox.dialog({
                            title: '<i class="ace-icon fa fa-exchange"></i> Enviando',
                            message: '<p class="text-center"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-2x fa-fw blue"></i>Aguarde...</p>',
                            closeButton: true
                        });
                    },
                    success: function(data) {
                        dialogCreate.init(function(){
                            if (data.status == "success"){
                                dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-thumbs-o-up"></i> Resultado:');
                                dialogCreate.find('.bootbox-body').html('<p class="text-center"><i class="ace-icon fa fa-check fa-2x fa-fw green"></i>'+ data.msg +'</p>');
                                
                                //Reload Tabela
                                $('.table-container').html(data.html);
                                $.fn.dinamic_table();   

                                setTimeout(function(){
                                    $('#modal-encerrar').hide();
                                    dialogCreate.modal('hide');
                                }, 3000);
                            }else{
                                dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                                var aviso = '<p class="text-left"><i class="ace-icon fa fa-exclamation fa-2x fa-fw red"></i>'+ data.msg +'</p>';
                                if (typeof data.detail != "undefined"){
                                    aviso = aviso + '<ul class="list-unstyled spaced">';    
                                    aviso = aviso + '<li>Erro:'+ data.detail + '</li>';
                                    aviso = aviso + '</ul>';        
                                }
                                dialogCreate.find('.bootbox-body').html(aviso);
                            }
                        });    

                        $('.encerrar_contrato').prop("disabled",false); 
                    },
                    error: function(data){
                        if (typeof data.responseJSON == "undefined"){
                            var erro = '<ul class="list-unstyled spaced">';    
                            erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ data.statusText + '</li>';
                            erro = erro + '</ul>';    
                        }else{
                            var result = $.parseJSON(data.responseJSON.detail);
                            var erro = '<ul class="list-unstyled spaced">';
                            $.each(result, function(i, field){
                                erro = erro + '<li><i class="ace-icon fa fa-exclamation-triangle red"></i>'+ field[0] + '</li>';
                            });
                            erro = erro + '</ul>';    
                        }

                        dialogCreate.init(function(){
                            dialogCreate.find('.modal-title').html('<i class="ace-icon fa fa-bullhorn"></i> Alerta:');
                            dialogCreate.find('.bootbox-body').html('<p class="text-center">'+ erro +'</p>');
                        });    
                        
                        $('.encerrar_contrato').prop("disabled",false);
                    }
                }).done(function() {
                    $("#formulario_data")[0].reset();
                });
                return false;
            });

        });

    </script>

@endsection