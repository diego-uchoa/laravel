@extends('sismed::layouts.master')

@section('script-head')
	{!! Charts::assets() !!}

<script type="text/javascript">


</script>
@endsection


@section('breadcrumbs-page')

    {!! Breadcrumbs::render('sismed::inicio') !!}

@endsection

@include('errors.errors')

@section('page-header')
    Dashboard
@endsection

@section('content')

    <div class="col-sm-11">

        <div class="infobox-container">
            <div class="infobox infobox-grey" style="width: 140px">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-user"></i>
                </div>

                <div class="infobox-data" style="min-width: 50px">
                    <span class="infobox-data-number">{{$servidores}}</span>
                    <div class="infobox-content">Prontuários</div>
                </div>

                
            </div>

            <div class="infobox infobox-red" style="width: 140px">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-plus-square"></i>
                </div>

                <div class="infobox-data" style="min-width: 50px">
                    <span class="infobox-data-number">{{$atestados}}</span>
                    <div class="infobox-content">Atestados</div>
                </div>

            </div>

            <div class="infobox infobox-blue" style="min-width: 230px">
                <div class="infobox-icon">
                    <i class="ace-icon fa fa-calendar-plus-o"></i>
                </div>

                <div class="infobox-data">
                    <span class="infobox-data-number">{{$pericias}}</span>
                    <div class="infobox-content">Perícias
                    </div>
                </div>
                <div class="badge badge-danger"> {{ $apericiar }} A periciar</div>
                <div class="badge badge-success" style="margin-top: 20px">{{ $concluidas }} Concluídos</div>
                
            </div>


        </div>



        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Estatísticas
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            {{$ano}}
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a href="{{route('sismed::inicio')}}?ano=2017" class="blue">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    2017
                                </a>
                            </li>

                            <li>
                                <a href="{{route('sismed::inicio')}}?ano=2016" class="blue">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    2016
                                </a>
                            </li>

                            <li>
                                <a href="{{route('sismed::inicio')}}?ano=2015" class="blue">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    2015
                                </a>
                            </li>

                            <li>
                                <a href="{{route('sismed::inicio')}}?ano=2014" class="blue">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    2014
                                </a>
                            </li>

                            <li>
                                <a href="{{route('sismed::inicio')}}?ano=2013" class="blue">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    2013
                                </a>
                            </li>

                        </ul>

                        
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div class="col-sm-6">
                        {!! $graficoAtestado->render() !!}
                    </div>

                    <div class="col-sm-6">
                        {!! $graficoLaudo->render() !!}
                    </div>    

                    

                    <div class="clearfix">
                        
                    </div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->




    </div>


@endsection 