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
    margin-top: 15px;
    margin-bottom: 10px;
    display: block;
    font-size:24px;
    font-weight: bold;
    color: #0e3455;
  }

  .tabela {
     border-collapse:collapse;
     border-spacing:0;
     border-color:#ffffff;
     width:725px;
  }

  .tb-variavel {
    padding: 4px 3px 4px 3px;
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
    padding: 2px 0px 2px 10px;
    background: #0f5e96;
  }

  .tb-meses {
    font-size:13px;
    font-weight: bold;
    color: #ffffff;
    background: #0f5e96;
    text-align:center;
    padding: 2px 0px 2px 0px;
  }

  .tb-mes-ref {
    font-size:11px;
    font-weight: normal;
    color: #ffffff;
    background: #0f5e96;
    text-align:center;
    padding: 0px 0px 2px 0px;
  }

  .tb-img {
    text-align:center;
    width: 100px;
    border-right: 2px solid #ffffff;
    background: #e6e7e8;
    padding: 3px 0px 3px 0px;
  }

  .tb-valor {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:center;
    width: 120px;
    background: #e6e7e8;
    padding: 3px 0px 3px 0px;
  }

  .imagem-icon {
    height: 10px;
    width:  10px;
  }
  .tb-linha {
    border-top: 2px solid #0f5e96;
    border-right: 0;
  }
  .tb-espaco {
    padding:10px;
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
    color: #414042;
    text-align:left;
    padding:5px 5px 5px 5px;
  }
  .tb-linha1 {
    background: #f6f6f6;
    border-top: 0;
  }
  .tb-linha2 {
    background: #e6e7e8;;
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
        <div class="legenda-right ">{{ $mes }}</div> 
    </div>
    <br>
    <div class="titulo"> 
       {{trans('prisma-bi::pdf.media-previsoes')}} - 
        <label style="font-weight: normal;"> {{trans('prisma-bi::pdf.longo-prazo')}} </label> 
    </div>

    @foreach(json_decode($dadosMensais, true) as $value)

      <table class="tabela">
        <tr>
            <th class="tb-variavel" colspan="4"><label style="padding-left:6px">
            {{ trans('prisma-bi::pdf.'. App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel']) ) }}
            </label></th>

            @if( strcmp($value['variavel'],'Dívida Bruta do Governo Geral')== 0)
               <th class="tb-milhoes" colspan="2" >{{ trans('prisma-bi::pdf.pib') }}</th>
            @else
               <th class="tb-milhoes" colspan="2" >{{ trans('prisma-bi::pdf.milhoes') }}</th>
            @endif

          </tr>
        <tr>
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
         @foreach($value['valor'] as $media)
                      
            @if(is_array($media))
              <td class="tb-img">
                  <img src="{{ $path }}/modules/prismabi/imagens/{{$media[1]}}.png" class="imagem-icon">
            @else
              <td class="tb-valor">
                  {{  App\Modules\PrismaBi\Http\Controllers\PdfController::formataNum($media) }}
            @endif

          </td>
        @endforeach
        </tr>
        <tr>
            <th class="tb-linha" colspan="6"> </th>
        </tr>
     </table>
     <table class="tabela" >
        <tr> 
          <td class="tb-podium-col1 tb-linha1">1º </td>
          <td class="tb-podium-img tb-linha1"><img src="{{ $path }}/modules/prismabi/imagens/ouro.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha1">{{ $value['instituicao'][0] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha2">2º </td>
          <td class="tb-podium-img tb-linha2"><img src="{{ $path }}/modules/prismabi/imagens/prata.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha2">{{ $value['instituicao'][1] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha1">3º </td>
          <td class="tb-podium-img tb-linha1"><img src="{{ $path }}/modules/prismabi/imagens/bronze.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha1">{{ $value['instituicao'][2] }}</td>
        </tr>
        @if( strcmp($value['variavel'],'Dívida Bruta do Governo Geral')!= 0)
        <tr>
          <th class="tb-espaco" colspan="3"> </th>
        </tr>
        @endif
     </table>
    @endforeach


</div>

</body>

</html>