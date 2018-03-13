<!doctype html>
<html>
<head>

  <style>
    @page { 
      margin-top: 5px; 
      font-family:Arial, sans-serif;
      font-size:12px;
    }

    body {
      background: rgb(255,255,255);
      font-family:Arial, sans-serif;
      font-size:12px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      font-size: 80%;
    }
    table th {
      background-color: #2679b5;
      color: white;
      text-align: center;
    }
    th,
    td {
      border: 1px solid #fff;
      text-align: left;
    }

  .header {
    padding-top: 5px;
    text-align: center;
    border: 2px solid red;
    background-color: red;
    color: white;
    text-align: left;
    font-weight:bold;
    font-size: 14px; 
  }

  .table  {border-collapse:collapse;border-spacing:0;}
  .table td{font-family:Arial, sans-serif;font-size:12px;padding:5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
  .table th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}

  .table .table-cabecalho{vertical-align:top; text-align: left; font-weight:bold;}
  .table .table-titulo{vertical-align:top; text-align: center; font-weight:bold; padding-top: 50px; padding-bottom: 50px;}
  .table .table-parametros{border-bottom: 1px solid #000; border-top: 1px solid #000;}
  .table .table-destaque{background-color:#a0a0a0;vertical-align:top;text-align: center; padding: 10px; font-weight: bold;}
  .table .table-destaque_l{background-color:#a0a0a0;vertical-align:top;text-align: left; padding: 10px; font-weight: bold;}
  
  .table .table-coluna-2{vertical-align:top; text-align: center;text-align: left; padding-left: 10px}
  .table .table-coluna-1-header{background-color:#c0c0c0;vertical-align:top;text-align: center;}
  .table .table-coluna-2-header{background-color:#c0c0c0;vertical-align:top;text-align: left; padding-left: 10px}



  .table-interna  {border-collapse:collapse;border-spacing:0;}
  .table-interna td{font-family:Arial, sans-serif;font-size:12px;padding:5px 0px;border-style:solid;border-width:1px;border-color: #000;overflow:hidden;word-break:normal;}
  .table-interna th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 0px;border-style:solid;border-width:1px;overflow:hidden;}
  .table-interna .table-coluna-1{vertical-align:top; text-align: center;}
  .table-interna .table-coluna-2{vertical-align:top; text-align: center;text-align: left; padding-left: 10px}
  .table-interna .table-coluna-1-header{background-color:#c0c0c0;vertical-align:top;text-align: center;}
  .table-interna .table-coluna-2-header{background-color:#c0c0c0;vertical-align:top;text-align: left; padding-left: 10px}

  </style>
    
</head>


<body>
  
<div class="container">


  <div class="header">SISMED</div>

  <table class="table">

    <tr>
      <td class="table-cabecalho" colspan="2">
        SERVIÇO DE ATENÇÃO À SAÚDE/GESPE/SAMF-DF
      </td>
    </tr>

    <tr>
      <td class="table-titulo" colspan="2">
        <u>RELATÓRIO DE ESTATÍSTICAS DE ATESTADOS</u>
      </td>
    </tr>

    <tr>
      <td class="table-parametros" colspan="2">
        Período: 01/01/2017 - 31/01/2017
      </td>
    </tr>

    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>

    <tr>
      <td class="table-destaque">ATESTADOS</td>
      <td class="table-destaque">{{$atestados}} cadastrados</td>
    </tr>

    <tr><td></td><td></td></tr>
    <tr><td></td><td></td></tr>

    <table class="table-interna">
    <tr>
      <td class="table-coluna-1-header">Situação</td>
      <td class="table-coluna-2-header">Qtd</td>
    </tr>
    <tr>
      <td class="table-coluna-1">Concluído<br></td>
      <td class="table-coluna-2">{{$situacaoConcluido}}</td>
    </tr>
    <tr>
      <td class="table-coluna-1">Pendente<br></td>
      <td class="table-coluna-2">{{$situacaoPendente}}</td>
    </tr>
    <tr>
      <td class="table-coluna-1">A Periciar<br></td>
      <td class="table-coluna-2">{{$situacaoApericiar}}</td>
    </tr>
    <tr>
      <td class="table-coluna-1-header">Área de Atendimento<br></td>
      <td class="table-coluna-2-header">Qtd.</td>
    </tr>
    <tr>
      <td class="table-coluna-1">Odontológica</td>
      <td class="table-coluna-2">{{$areaOdontologica}}</td>
    </tr>
    <tr>
      <td class="table-coluna-1">Médica</td>
      <td class="table-coluna-2">{{$areaMedica}}</td>
    </tr>
    <tr>
      <td class="table-coluna-1-header">Tipo de Afastamento</td>
      <td class="table-coluna-2-header">Qtd<br></td>
    </tr>
    <tr>
      <td class="table-coluna-1">Próprio</td>
      <td class="table-coluna-2">{{$afastamentoProprio}}</td>
    </tr>
    <tr>
      <td class="table-coluna-1">Acompanhamento</td>
      <td class="table-coluna-2">{{$afastamentoAcompanhamento}}</td>
    </tr>
    </table>

  </table>
  <br>
  <br>

</div>

</body>

</html>




