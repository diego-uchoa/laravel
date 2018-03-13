 <div id="graficos-composicao-comissao">   
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <i class="ace-icon fa fa-bar-chart"></i>
                Posicionamento
            </h5>

            <div class="widget-toolbar no-border">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#titulares">Titulares</a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#suplentes">Suplentes</a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#todos">Todos</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="tab-content">
                    <div id="titulares" class="tab-pane in active">
                        {!! $titulares->render() !!}
                    </div>
                    <div id="suplentes" class="tab-pane">
                        {!! $suplentes->render() !!}
                    </div>
                    <div id="todos" class="tab-pane">
                        {!! $membros->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>