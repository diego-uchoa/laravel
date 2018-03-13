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
    margin-bottom: 0px;

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

  .tb-variavel {
    padding: 2px 3px 2px 3px;
    font-size:16px;
    font-weight: bold;
    color: #ffffff;
    background: #0e3455;
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
    padding: 1px 0px 1px 10px;
    background: #0f5e96;
  }

  .tb-meses {
    font-size:13px;
    font-weight: bold;
    color: #ffffff;
    background: #0f5e96;
    text-align:center;
  }

  .tb-mes-ref {
    font-size:11px;
    font-weight: normal;
    color: #ffffff;
    background: #0f5e96;
    text-align:center;
  }

  .tb-img {
    text-align:center;
    width: 30px;
    border-right: 2px solid #ffffff;
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

  .tb-valor {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:center;
    width: 130px;
  }

  .imagem-icon {
    height: 30%;
    width:  30%;
  }
  .tb-espaco {
    padding:10px;
  }

</style>

</head>


<body>
  
  <div>
    <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
  </div>

  <div class="container">
     
     <div>
        <div class="legenda"> {{trans('prisma-bi::pdf.coleta').strtolower($mes) }} </div>
        <div class="legenda-right ">{{ $mes }}</div> 
     </div>
     <br>
     <div class="titulo"> 
        {{trans('prisma-bi::pdf.relatorio-mensal')}} -  
        <label style="font-weight: normal;"> {{trans('prisma-bi::pdf.previsoes-anuais')}} </label> 
     </div>


  <table class="tabela">
    @foreach(json_decode($dadosAnuais, true) as $value)

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
              <td class="tb-valor tb-linha1">
                  {{ App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($maximo) }}
            @endif
          
          </td>
        @endforeach
      </tr>
      @if( strcmp($value['variavel'],'Dívida Bruta do Governo Geral')!= 0)
      <tr>
        <th class="tb-espaco" colspan="10"> </th>
      </tr>
      @endif

  @endforeach

  </table>
  
</div>

</body>

</html>