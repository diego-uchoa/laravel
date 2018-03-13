<!doctype html>
<html>
<head>
  
<style>
  @page { margin: 0px; }
  
  .imagem-cabecalho {
    height: 100%;
    width:  100%;
  }
  .container {
    margin-top: 10px;
    margin-left: 40px;
    margin-right: 40px;
    font-family:Helvetica,Arial, sans-serif;
  }

  .legenda {
    font-size:13px;
    color: #6e6b6e;
    display: inline;
    float: left;
  }

  .legenda-right {  
    display: inline;
    float: right;
    font-size:17px;
    font-weight: bold;
    color: #0e3455;
  }

  .titulo {  
    margin-top: 20px;
    margin-bottom: 15px;
    display: block;
    font-size:24px;
    font-weight: bold;
    color: #0e3455;
  }

  .tabela {
     border-collapse:collapse;
     border-spacing:0;
     border-color:#ffffff;

  }

  .tb-variavel, .tb-variavel-mcurto {
    font-size:16px;
    font-weight: bold;
    color: #ffffff;
    background: #0e3455;
  }

  .tb-variavel {
    padding: 2px 3px 2px 3px;
  }

  .tb-variavel-mcurto {
    padding: 4px 3px 4px 3px;
  }

  .tb-milhoes {
    padding: 5px;
    font-size:12px;
    font-weight: bold;
    color: #ffffff;
    background: #0e3455;
    text-align:right;
  }

  .imagem-var {
    height: 33px;
    width:  33px;
  }

  .tb-var-img {
    text-align:left;
    padding: 2px 0px 2px 10px;
    background: #0f5e96;
  }

  .tb-meses,.tb-meses-mcurto, .tb-meses-mlongo {
    font-size:13px;
    font-weight: bold;
    color: #ffffff;
    background: #0f5e96;
    text-align:center;
  }

  .tb-meses-mcurto {
    padding: 4px 0px 2px 0px;
  }

  .tb-meses-mlongo {
    padding: 2px 0px 2px 0px;
  }


  .tb-mes-ref, .tb-mes-ref-mcurto, .tb-mes-ref-mlongo {
    font-size:11px;
    font-weight: normal;
    color: #ffffff;
    background: #0f5e96;
    text-align:center;
  }

  .tb-mes-ref-mcurto {
    padding: 0px 0px 4px 0px;
  }

  .tb-mes-ref-mlongo {
    padding: 0px 0px 4px 0px;
  }

  .tb-img {
    text-align:center;
    width: 30px;
    border-right: 2px solid #ffffff;
  }

  .tb-img-mcurto {
    text-align:center;
    width: 45px;
    border-right: 2px solid #ffffff;
    background: #e6e7e8;
    padding: 5px 0px 5px 0px;
  }

  .tb-img-mlongo {
    text-align:center;
    width: 100px;
    border-right: 2px solid #ffffff;
    background: #e6e7e8;
    padding: 3px 0px 3px 0px;
  }

 .tb-metrica{
    font-size:11px;
    font-weight: bold;
    color: #0e3455;
    text-align:right;
    border-right: 2px solid #ffffff;
    width: 80px;
    padding: 2px 5px 3px 20px;
   }

  .tb-linha1{
    background: #e6e7e8;
  }
  .tb-linha2{
    background: #f6f6f6;
  }

  .tb-linha-mcurto {
    border-top: 4px solid #0f5e96;
    border-right: 0;
  }

  .tb-linha-mlongo {
    border-top: 2px solid #0f5e96;
    border-right: 0;
  }

  .tb-valor, .tb-valor-anual, .tb-valor-mcurto, .tb-valor-mlongo {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:center;
    width: 80px;
  }

  .tb-valor-anual {
    width: 130px;
  }

  .tb-valor-mcurto {
    width: 98px;
    background: #e6e7e8;
    padding: 5px 0px 5px 0px;
  }

  .tb-valor-mlongo {
    width: 120px;
    background: #e6e7e8;
    padding: 3px 0px 3px 0px;
  }

  .imagem-icon {
    height: 30%;
    width:  30%;
  }

  .imagem-icon-mcurto {
    height: 10px;
    width:  10px;
  }

  .tb-espaco {
    padding:14px;
  }

  .tb-espaco-anual {
    padding:9px;
  }

  .tb-espaco-mcurto {
    padding:18px;
  }

  .tb-espaco-mlongo {
    padding:8px;
  }

  .podium {
     border-collapse:collapse;
     border-spacing:0;
  }

  .tb-podium-col1 {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:left;
    width: 20px;
    padding-left:5px;
  }

  .tb-podium-col3 {
    font-size:11px;
    font-weight: bold;
    color: #0e3455;
    text-align:left;
    padding:7px 5px 7px 5px;
  }

  .tb-podium-col3-mlongo {
    font-size:11px;
    font-weight: bold;
    color: #0e3455;
    text-align:left;
    padding:5px;
  }
  
  .tb-podium-img {
    text-align:center;
    width: 40px;
    border-right: 2px solid #ffffff;
  }

  .imagem-podium {
    height: 20px;
    width:  20px;
  }

</style>

</head>


<body>
  
  <div>
    <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
  </div>

  <div class="container">
     
     <div>
        <div class="legenda"> {{trans('prisma-bi::pdf.coleta').$mes }}  </div>
        <div class="legenda-right ">{{ $mes }}</div> 
     </div>
     <br>
     <div class="titulo"> 
        {{trans('prisma-bi::pdf.relatorio-mensal')}} - 
        <label style="font-weight: normal;"> {{trans('prisma-bi::pdf.previsoes-mensais')}} </label> 
     </div>


  <table class="tabela">
    @foreach(json_decode($dadosPrevMensal, true) as $value)

    <tr>
        <th class="tb-variavel" colspan="6"><label style="padding-left:6px">
        {{ trans('prisma-bi::pdf.'. App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel']) ) }}
        </label></th>
        <th class="tb-milhoes" colspan="4" >{{ trans('prisma-bi::pdf.milhoes') }}</th>
      </tr>
    <tr>
      <td class="tb-var-img" rowspan="2"> 
        <img src="{{ $path }}/modules/prismabi/imagens/{{App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel'])}}.png"  class="imagem-var">
      </td>

      <td class="tb-meses" colspan="3" >{{ $meses[0] }}</td>
      <td class="tb-meses" colspan="3" >{{ $meses[1] }}</td>
      <td class="tb-meses" colspan="3" >{{ $meses[2] }}</td>
    </tr>
    <tr>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.var') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.var') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.var') }}</td>
   </tr>

    <tr>
      <td class="tb-metrica tb-linha1" >{{ trans('prisma-bi::pdf.'. strtolower($value['metrica1'])) }}</td>
        @foreach($value['valorMetrica1'] as $mediana)
          @if(is_array($mediana))
            <td class="tb-img tb-linha1">
               <img src="{{ $path }}/modules/prismabi/imagens/{{$mediana[1]}}.png"  class="imagem-icon">
           
          @else
            <td class="tb-valor tb-linha1">
              {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($mediana) }}
          @endif
            </td>
        @endforeach
    </tr>

    <tr>
    <td class="tb-metrica tb-linha2">{{trans('prisma-bi::pdf.'.strtolower($value['metrica2']))}}</td>
    @foreach($value['valorMetrica2'] as $media)
                  
        @if(is_array($media))
          <td class="tb-img tb-linha2">
              <img src="{{ $path }}/modules/prismabi/imagens/{{$media[1]}}.png" class="imagem-icon">
        @else
          <td class="tb-valor tb-linha2">
              {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($media) }}
        @endif

      </td>
    @endforeach
    </tr>

    <tr>
      <td class="tb-metrica tb-linha1">{{ trans('prisma-bi::pdf.'.str_replace(" ","-",strtolower($value['metrica3'])))}}</td>
        @foreach($value['valorMetrica3'] as $desvio)
                      
            @if(is_array($desvio))
              <td class="tb-img tb-linha1" >
                  <img src="{{ $path }}/modules/prismabi/imagens/{{$desvio[1]}}.png" class="imagem-icon">
            @else
              <td class="tb-valor tb-linha1">
                 {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($desvio) }}
            @endif

          </td>
        @endforeach
      </tr>

      <tr>
      <td class="tb-metrica tb-linha2">{{trans('prisma-bi::pdf.'.strtolower($value['metrica4']))}}</td>
      @foreach($value['valorMetrica4'] as $minimo)
                    
          @if(is_array($minimo))
            <td class="tb-img tb-linha2">
                <img src="{{ $path }}/modules/prismabi/imagens/{{$minimo[1]}}.png" class="imagem-icon">
          @else
            <td class="tb-valor tb-linha2">
               {{  App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($minimo) }}
          @endif

        </td>
      @endforeach
      </tr>

      <tr>
      <td class="tb-metrica tb-linha1">{{ trans('prisma-bi::pdf.'.strtolower($value['metrica5'])) }}</td>
        @foreach($value['valorMetrica5'] as $maximo)
             @if(is_array($maximo))
              <td class="tb-img tb-linha1" >
                 <img src="{{ $path }}/modules/prismabi/imagens/{{$maximo[1]}}.png" class="imagem-icon">
            @else
              <td class="tb-valor tb-linha1">
                  {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($maximo) }}
            @endif
          
          </td>
        @endforeach
      </tr>
      <tr>
        <th class="tb-espaco" colspan="10"> </th>
      </tr>

  @endforeach

  </table> 
</div> <!-- container -->

@if(!is_null($dadosMediaCurto))
<div style="page-break-before:always"></div>

<!-- ****************************** MÉDIA CURTO PRAZO ************************************ -->
  <div>
    <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
  </div>

  <div class="container">
     
    <div>
        <div class="legenda-right ">{{ $mes }}</div> 
    </div>
    <br>
    <div class="titulo"> 
        {{trans('prisma-bi::pdf.media-previsoes')}} - 
        <label style="font-weight: normal;"> {{trans('prisma-bi::pdf.curto-prazo')}} </label> 
    </div>

    @foreach(json_decode($dadosMediaCurto, true) as $value)

      <table class="tabela" style="width:725px;">
        <tr>
            <th class="tb-variavel-mcurto" colspan="6"><label style="padding-left:6px">
            {{ trans('prisma-bi::pdf.'. App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel']) ) }}
            </label></th>
            <th class="tb-milhoes" colspan="3" >{{ trans('prisma-bi::pdf.milhoes') }}</th>
          </tr>
        <tr>
          <td class="tb-meses-mcurto" colspan="3" >{{ $meses[0] }}</td>
          <td class="tb-meses-mcurto" colspan="3" >{{ $meses[1] }}</td>
          <td class="tb-meses-mcurto" colspan="3" >{{ $meses[2] }}</td>
        </tr>
        <tr>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.var') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.var') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
          <td class="tb-mes-ref-mcurto">{{ trans('prisma-bi::pdf.var') }}</td>
        </tr>

        <tr>
         @foreach($value['valor'] as $media)
                      
            @if(is_array($media))
              <td class="tb-img-mcurto">
                  <img src="{{ $path }}/modules/prismabi/imagens/{{$media[1]}}.png" class="imagem-icon-mcurto">
            @else
              <td class="tb-valor-mcurto">
                  {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($media) }}
            @endif

          </td>
        @endforeach
        </tr>
        <tr>
            <th class="tb-linha-mcurto" colspan="9"> </th>
        </tr>
     </table>
     <table class="tabela" style="width:725px;">
        <tr> 
          <td class="tb-podium-col1 tb-linha2" style="border-top: 0">1º </td>
          <td class="tb-podium-img tb-linha2" style="border-top: 0"><img src="{{ $path }}/modules/prismabi/imagens/ouro.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha2" style="border-top: 0">{{ $value['instituicao'][0] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha1">2º </td>
          <td class="tb-podium-img tb-linha1"><img src="{{ $path }}/modules/prismabi/imagens/prata.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha1">{{ $value['instituicao'][1] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha2" style="border-top: 0">3º </td>
          <td class="tb-podium-img tb-linha2" style="border-top: 0"><img src="{{ $path }}/modules/prismabi/imagens/bronze.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha2" style="border-top: 0">{{ $value['instituicao'][2] }}</td>
        </tr>
        <tr>
            <th class="tb-espaco-mcurto" colspan="3"> </th>
        </tr>
     </table>
    @endforeach
</div>
@endif

<div style="page-break-before: always"></div>

<!-- *************************** PREVISÕES ANUAIS ************************************** -->

  <div>
    <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
  </div>

  <div class="container">
     <div>
        <div class="legenda"> {{trans('prisma-bi::pdf.coleta').$mes }} </div>
        <div class="legenda-right ">{{ $mes }}</div> 
     </div>
     <br>
     <div class="titulo" style="margin-top: 15px; margin-bottom: 10px;"> 
        {{trans('prisma-bi::pdf.relatorio-mensal')}} -  
        <label style="font-weight: normal;"> {{trans('prisma-bi::pdf.previsoes-anuais')}} </label> 
     </div>


  <table class="tabela">
    @foreach(json_decode($dadosPrevAnual, true) as $value)

    <tr>
        <th class="tb-variavel" colspan="5"><label style="padding-left:6px">
        {{ trans('prisma-bi::pdf.'. App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel']) ) }}
        </label></th>
  
        @if( strcmp($value['variavel'],'Dívida Bruta do Governo Geral')== 0)
           <th class="tb-milhoes" colspan="2" >{{ trans('prisma-bi::pdf.pib') }}</th>
        @else
           <th class="tb-milhoes" colspan="2" >{{ trans('prisma-bi::pdf.milhoes') }}</th>
        @endif

      </tr>
    <tr>
      <td class="tb-var-img" rowspan="2"> 
        <img src="{{ $path }}/modules/prismabi/imagens/{{App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel'])}}.png"  class="imagem-var">
      </td>

      <td class="tb-meses" colspan="3" >{{ $anos[0] }}</td>
      <td class="tb-meses" colspan="3" >{{ $anos[1] }}</td>
    </tr>
    <tr>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.var') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
      <td class="tb-mes-ref">{{ trans('prisma-bi::pdf.var') }}</td>
    </tr>

    <tr>
      <td class="tb-metrica tb-linha1" >{{ trans('prisma-bi::pdf.'.strtolower($value['metrica1'])) }}</td>
        @foreach($value['valorMetrica1'] as $mediana)
          @if(is_array($mediana))
            <td class="tb-img tb-linha1">
               <img src="{{ $path }}/modules/prismabi/imagens/{{$mediana[1]}}.png"  class="imagem-icon">
           
          @else
            <td class="tb-valor-anual tb-linha1">
              {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($mediana) }}
          @endif
            </td>
        @endforeach
    </tr>

    <tr>
    <td class="tb-metrica tb-linha2">{{trans('prisma-bi::pdf.'.strtolower($value['metrica2']))}}</td>
    @foreach($value['valorMetrica2'] as $media)
                  
        @if(is_array($media))
          <td class="tb-img tb-linha2">
              <img src="{{ $path }}/modules/prismabi/imagens/{{$media[1]}}.png" class="imagem-icon">
        @else
          <td class="tb-valor-anual tb-linha2">
              {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($media) }}
        @endif

      </td>
    @endforeach
    </tr>

    <tr>
      <td class="tb-metrica tb-linha1">{{ trans('prisma-bi::pdf.'.str_replace(" ","-",strtolower($value['metrica3'])))}}</td>
        @foreach($value['valorMetrica3'] as $desvio)
                      
            @if(is_array($desvio))
              <td class="tb-img tb-linha1" >
                  <img src="{{ $path }}/modules/prismabi/imagens/{{$desvio[1]}}.png" class="imagem-icon">
            @else
              <td class="tb-valor-anual tb-linha1">
                 {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($desvio) }}
            @endif

          </td>
        @endforeach
      </tr>

      <tr>
      <td class="tb-metrica tb-linha2">{{trans('prisma-bi::pdf.'.strtolower($value['metrica4']))}}</td>
      @foreach($value['valorMetrica4'] as $minimo)
                    
          @if(is_array($minimo))
            <td class="tb-img tb-linha2">
                <img src="{{ $path }}/modules/prismabi/imagens/{{$minimo[1]}}.png" class="imagem-icon">
          @else
            <td class="tb-valor-anual tb-linha2">
               {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($minimo) }}
          @endif

        </td>
      @endforeach
      </tr>

      <tr>
      <td class="tb-metrica tb-linha1">{{ trans('prisma-bi::pdf.'.strtolower($value['metrica5'])) }}</td>
        @foreach($value['valorMetrica5'] as $maximo)
             @if(is_array($maximo))
              <td class="tb-img tb-linha1" >
                 <img src="{{ $path }}/modules/prismabi/imagens/{{$maximo[1]}}.png" class="imagem-icon">
            @else
              <td class="tb-valor-anual tb-linha1">
                  {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($maximo) }}
            @endif
          
          </td>
        @endforeach
      </tr>
      @if( strcmp($value['variavel'],'Dívida Bruta do Governo Geral')!= 0)
      <tr>
        <th class="tb-espaco-anual" colspan="10"> </th>
      </tr>
      @endif

  @endforeach

  </table>  

</div> <!-- container --> 

@if(!is_null($dadosMediaLongo))

<div style="page-break-before: always"></div>

<!-- *************************** MÉDIA LONGO PRAZO ************************************** -->
  <div>
    <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
  </div>

  <div class="container">
     
    <div>
        <div class="legenda-right ">{{ $mes }}</div> 
    </div>
    <br>
    <div class="titulo" style="margin-top: 15px; margin-bottom: 10px;"> 
       {{trans('prisma-bi::pdf.media-previsoes')}} - 
        <label style="font-weight: normal;"> {{trans('prisma-bi::pdf.longo-prazo')}} </label> 
    </div>

    @foreach(json_decode($dadosMediaLongo, true) as $value)

      <table class="tabela" style="width:725px;">
        <tr>
            <th class="tb-variavel-mcurto" colspan="4"><label style="padding-left:6px">
            {{ trans('prisma-bi::pdf.'. App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel']) ) }}
            </label></th>

            @if( strcmp($value['variavel'],'Dívida Bruta do Governo Geral')== 0)
               <th class="tb-milhoes" colspan="2" >{{ trans('prisma-bi::pdf.pib') }}</th>
            @else
               <th class="tb-milhoes" colspan="2" >{{ trans('prisma-bi::pdf.milhoes') }}</th>
            @endif

          </tr>
        <tr>
          <td class="tb-meses-mlongo" colspan="3" >{{ $anos[0] }}</td>
          <td class="tb-meses-mlongo" colspan="3" >{{ $anos[1] }}</td>
        </tr>
        <tr>
          <td class="tb-mes-ref-mlongo">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
          <td class="tb-mes-ref-mlongo">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
          <td class="tb-mes-ref-mlongo">{{ trans('prisma-bi::pdf.var') }}</td>
          <td class="tb-mes-ref-mlongo">{{ trans('prisma-bi::pdf.mes-atual') }}</td>
          <td class="tb-mes-ref-mlongo">{{ trans('prisma-bi::pdf.mes-anterior') }}</td>
          <td class="tb-mes-ref-mlongo">{{ trans('prisma-bi::pdf.var') }}</td>
        </tr>

        <tr>
         @foreach($value['valor'] as $media)
                      
            @if(is_array($media))
              <td class="tb-img-mlongo">
                  <img src="{{ $path }}/modules/prismabi/imagens/{{$media[1]}}.png" class="imagem-icon-mcurto">
            @else
              <td class="tb-valor-mlongo">
                  {{  App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($media) }}
            @endif

          </td>
        @endforeach
        </tr>
        <tr>
            <th class="tb-linha-mlongo" colspan="6"> </th>
        </tr>
     </table>
     <table class="tabela" style="width:725px;">
        <tr> 
          <td class="tb-podium-col1 tb-linha2" style="border-top:0">1º </td>
          <td class="tb-podium-img tb-linha2"  style="border-top:0"><img src="{{ $path }}/modules/prismabi/imagens/ouro.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3-mlongo tb-linha2" style="border-top:0">{{ $value['instituicao'][0] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha1">2º </td>
          <td class="tb-podium-img tb-linha1"><img src="{{ $path }}/modules/prismabi/imagens/prata.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3-mlongo tb-linha1">{{ $value['instituicao'][1] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha2" style="border-top:0">3º </td>
          <td class="tb-podium-img tb-linha2"  style="border-top:0"><img src="{{ $path }}/modules/prismabi/imagens/bronze.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3-mlongo tb-linha2" style="border-top:0">{{ $value['instituicao'][2] }}</td>
        </tr>
        @if( strcmp($value['variavel'],'Dívida Bruta do Governo Geral')!= 0)
        <tr>
          <th class="tb-espaco-mlongo" colspan="3"> </th>
        </tr>
        @endif
     </table>
    @endforeach
</div>
@endif
</body>

</html>