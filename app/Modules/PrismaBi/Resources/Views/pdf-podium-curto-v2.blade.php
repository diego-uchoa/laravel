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
    font-size:25px;
    font-weight: bold;
    color: #0e3455;
  }

  .tabela {
     border-collapse:collapse;
     border-spacing:0;
     border-color:#ffffff;
     width:735px;
  }

  .tb-variavel {
    padding: 4px 3px 4px 3px;
    font-size:17px;
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
    padding: 4px 0px 2px 0px;
  }

  .tb-mes-ref {
    font-size:11px;
    font-weight: normal;
    color: #ffffff;
    background: #0f5e96;
    text-align:center;
    padding: 0px 0px 4px 0px;
  }

  .tb-img {
    text-align:center;
    width: 45px;
    border-right: 2px solid #ffffff;
    background: #e6e7e8;
    padding: 5px 0px 5px 0px;
  }

  .tb-valor {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:center;
    width: 98px;
    background: #e6e7e8;
    padding: 5px 0px 5px 0px;
  }

  .imagem-icon {
    height: 10px;
    width:  10px;
  }
  .tb-linha {
    border-top: 4px solid #0f5e96;
    border-right: 0;
  }
  .tb-espaco {
    padding:12px;
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
    padding-left:5px;
    width: 2%;
  }

  .tb-podium-img {
    text-align:center;
    border-right: 2px solid #ffffff;
    width:  5%;
  }

  .tb-podium-col3 {
    font-size:11px;
    font-weight: bold;
    color: #414042;
    text-align:left;
    padding:7px 5px 7px 5px;
    border-right: 2px solid #ffffff;
  }

  .tb-podium-col4 {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:center;
    width: 10%;
  }

  .tb-podium-col3-demais {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:right;
  }


  .tb-linha1 {
    background: #e6e7e8;
    border-top: 0;
  }
  .tb-linha2 {
    background: #f6f6f6;
  }

  .tb-linha3 {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:center;
    width: 10%;
  }

  .tb-podium-posicao {
    font-size:12px;
    font-weight: normal;
    color: #ffffff;
    background: #0f5e96;
    text-align:left;
    padding: 4px 0px 2px 5px;
  }
  .imagem-podium {
    height: 22px;
    width:  22px;
  }

  .rodape {
    font-size:11px;
    font-weight: normal;
    color: #414042;
    text-align:justify;
  }
</style>

</head>


<body>
  
  <div>
    <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
  </div>

  <div class="container">
     
    <div>
        <div class="legenda-right ">{{ $periodo }}</div> 
    </div>
    <br>
    <div class="titulo"> 
        Podium - 
        <label style="font-weight: normal;"> {{trans('prisma-bi::pdf.curto-prazo')}} </label> 
    </div>

   @foreach(json_decode($dados, true) as $value)

      <table class="tabela">
        <tr>
            <th class="tb-variavel" colspan="4" ><label style="padding-left:6px">
            {{ trans('prisma-bi::pdf.'. App\Modules\PrismaBi\Http\Controllers\PdfController::getNomeImg($value['variavel']) ) }}
            </label></th>
        </tr>
        <tr> 
          <td class="tb-podium-posicao" colspan="2">{{trans('prisma-bi::pdf.colocacao')}}</td>
          <td class="tb-podium-posicao">{{trans('prisma-bi::pdf.instituicao')}}</td>
          <td class="tb-podium-posicao" style="text-align:center">{{trans('prisma-bi::pdf.erro')}}</td>
        </tr>

        <tr> 
          <td class="tb-podium-col1 tb-linha1">1º </td>
          <td class="tb-podium-img tb-linha1"><img src="{{ $path }}/modules/prismabi/imagens/ouro.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha1">{{ $value['instituicao'][0] }}</td>
          <td class="tb-podium-col4 tb-linha1">{{ $value['valor'][0] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha2">2º </td>
          <td class="tb-podium-img tb-linha2"><img src="{{ $path }}/modules/prismabi/imagens/prata.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha2">{{ $value['instituicao'][1] }}</td>
          <td class="tb-podium-col4 tb-linha2">{{ $value['valor'][1] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col1 tb-linha1">3º </td>
          <td class="tb-podium-img tb-linha1"><img src="{{ $path }}/modules/prismabi/imagens/bronze.png" class="imagem-podium"/></td>
          <td class="tb-podium-col3 tb-linha1">{{ $value['instituicao'][2] }}</td>
          <td class="tb-podium-col4 tb-linha1">{{ $value['valor'][2] }}</td>
        </tr>
        <tr> 
          <td class="tb-podium-col3-demais" colspan='3'>{{ trans('prisma-bi::pdf.demais-instituicoes')}}</td>
          <td class="tb-podium-col4">{{ $value['valor'][3] }}</td>
        </tr>
        <tr>
            <th class="tb-espaco" colspan="4"> </th>
        </tr>
     </table>
    @endforeach
    <div class="rodape"> 
       {{ trans('prisma-bi::pdf.observacao')}}
      <!-- <span style="color:#0000ff; text-decoration: underline;">https://www.spe.fazenda.gov.br/prisma-fiscal</span>. -->
    </div>
    

</div>

</body>

</html>