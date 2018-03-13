@extends('sisfone::layouts.master-modal')

@section('content')

@section('page-header')
<i class="ace-icon fa fa-question-circle orange"></i> Ajuda
@endsection

<div class="row">

<div class="col-md-8 col-md-offset-2">

  <div class="widget-box transparent" id="recent-box">
    <div class="widget-header">
      <div class="widget-toolbar no-border">
        <ul class="nav nav-tabs" id="recent-tab">
          <li class="active">
            <a data-toggle="tab" href="#geral-tab">Visão Geral</a>
          </li> 
          <li>
            <a data-toggle="tab" href="#faq-tab">FAQ</a>
          </li> 
          <li>
            <a data-toggle="tab" href="#manual-tab">Manuais</a>
          </li>            
      </ul>
    </div>
  </div>

  <div class="widget-body">
    <div class="widget-main padding-4">
      <div class="tab-content padding-8">

        <div id="geral-tab" class="tab-pane active">

            <?php
            /*  Visão Geral do Sistema
            */
            ?>

            <div class="panel panel-default">
                <div class="panel-body">
                  <p>
                  @if(isset($geral->tx_ajuda_geral))
                     {!! $geral->tx_ajuda_geral !!}
                  @endif
                  </p>
                </div>              
            </div>            
       

        </div> <!-- geral-tab -->

        <div id="faq-tab" class="tab-pane">

          <div id="faq-list" class="panel-group accordion-style1 accordion-style2">
            <?php
            /*  Listar Perguntas Frequentes do Sistema
            */
            ?>
            @foreach($faqs as $faq)

            <div class="panel panel-default">
              <div class="panel-heading">
                <a href="#faq-{{$faq->id_ajuda_faq}}" data-parent="#faq-list" data-toggle="collapse" class="accordion-toggle collapsed">
                  <i class="ace-icon fa fa-plus smaller-80" data-icon-hide="ace-icon fa fa-minus" data-icon-show="ace-icon fa fa-plus"></i>&nbsp;
                  {{ $faq->tx_pergunta }}
                </a>
              </div>

              <div class="panel-collapse collapse" id="faq-{{$faq->id_ajuda_faq}}">
                <div class="panel-body">
                  {{ $faq->tx_resposta }}
                </div>
              </div>
            </div>            
          
          @endforeach                             
        
         </div> <!-- faq-list -->

        </div> <!-- faq-tab -->

        <div id="manual-tab" class="tab-pane">

          <ul class="list-unstyled spaced2">

            <?php
            /*  Listar Arquivos de Ajuda do Sistema
            */
            ?>

            @foreach($manuais as $manual)

            <li>
              <i class="ace-icon fa fa-file blue"></i>
              <a href="/uploads/Sishelp/{{ $manual->no_ajuda_arquivo_fisico }}">{{$manual->no_ajuda_arquivo}}</a> 
              
            </li>

            @endforeach

          </ul>

        </div> <!-- manual-tab -->

      </div>
    </div><!-- /.widget-main -->
  </div><!-- /.widget-body -->
</div><!-- /.widget-box -->
</div><!--/.cols -->
</div><!-- /.row --> 

@endsection
