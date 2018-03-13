<!doctype html>
<html>
<head>

  <style>
    @page { margin-top: 0px; }
  
    body {
      background: rgb(255,255,255);
    }

    table {
      border-collapse: collapse;
      width: 100%;
      font-size: 80%;
    }
    table th {
      background-color: #FFF;
      color: #000;
      text-align: center;
    }
    th,
    td {
      border: 0px solid #FFF;
      text-align: left;
    }

    .header {
      padding-top: 0px;
      text-align: center;
      border: 0px solid #ddd;
    }
    .imagem {
      height: 65px;
    }
    .tabela-interna{
      border: 1px solid #000;
    }
    .tabela-interna tr td{
      border: 1px solid #000;
      padding-left: 2px;
    }
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{font-family:Arial, sans-serif;font-size:12px;padding:5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
    .tg th{font-family:Arial, sans-serif;font-size:12px;font-weight:normal;padding:5px 0px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
    .tg .tg-yw4l{vertical-align:top; text-align: center;}
    .tg .tg-l{vertical-align:top; text-align: left;}
    .tg .tg-l .font{font-size:10px;}
  </style>
    
</head>


<body>
  
<div class="container">


  <div class="header">

    <img src="{{ $path }}/modules/sismed/imagens/brasao.png" class="imagem">

      
  </div>

  <table class="tg">
    <tr>
      <td class="tg-yw4l">
        SUPERINTENDÊNCIA DE ADMINISTRAÇÃO DO MINISTÉRIO DA FAZENDA NO DF
        <br>GERÊNCIA DE GESTÃO DE PESSOAS
        <br>SERVIÇO DE ATENÇÃO À SAÚDE
        
        <br><br><b>RECIBO DE ENTREGA DE ATESTADO MÉDICO/ODONTOLÓGICO</b>
        
      </td>
    </tr>

    <tr>
      <td class="tg-l"><br><br>Senhor(a) Chefe,<br></td>
    </tr>
    <tr>
      <td class="tg-l">
        Comunico que o servidor(a) <b>{{ $servidor->no_servidor }}</b> entregou o atestado <b>{{ $atestado->areaAtendimento() }}</b> de <b>{{ $atestado->te_prazo }}</b> dias a partir de <b>{{ $atestado->dt_inicio_afastamento }}</b> e deverá comparecer, <b>mediante agendamento</b>, à perícia oficial em saúde {{ $textoPericia }}
        <br>
          
      </td>
    </tr>
    <tr>
      <td class="tg-yw4l">

      <table class="tabela-interna">
        <tr>
          <th colspan="2"><b>Dados do Servidor</b></th>  
        </tr>
        <tr>
          <td>CPF</td>
          <td>{{ $servidor->nr_cpf }}</td>
        </tr>
        <tr>
          <td>E-mail</td>
          <td>{{ $servidor->ds_email }}</td>
        </tr>
        <tr>
          <td>Unidade de exercício</td>
          <td>{{ $servidor->no_unidade_exercicio }}</td>
        </tr>
        <tr>
          <td>Telefone Unidade de exercício</td>
          <td>{{ $servidor->tx_telefone_unidade }}</td>
        </tr>
        <tr>
          <td>Telefone Celular</td>
          <td>{{ $servidor->tx_telefone_celular }}</td>
        </tr>
        <tr>
          <td>Telefone Residencial</td>
          <td>{{ $servidor->tx_telefone_residencial }}</td>
        </tr>
        <tr>
          <td>Regine Jurídico</td>
          <td>{{ $servidor->regimeJuridico() }}</td>
        </tr>
      </table>

      </td>
    </tr>
    <tr>
      <td class="tg-l font">
        <br><b>OBSERVAÇÕES:</b><br>
      </td>
    </tr>
    <tr>
      <td class="tg-l font">- Ao receber este Recibo de Entrega, o(a) servidor(a) declara-se ciente de que ele(a) ou a pessoa da família <u>será convocado(a) para a perícia oficial</u> e que, o não comparecimento, injustificado, constitui infração administrativa passível de até 15 (quinze) dias de suspensão nos termos do disposto no § 1º, do artigo 130, da Lei nº 8.112/1990.
      </td>
    </tr>
    <tr>
      <td class="tg-l font">- O(a) servidor(a) deverá comparecer à perícia munido de documentos comprobatórios de seu (ou do familiar) estado de saúde e do tratamento, como exemplo: exames, laudos e prescrição de medicamentos.</td>
    </tr>
    <tr>
      <td class="tg-l font"><br>Atestado entregue em: {{ $atestado->dt_cadastro }} </td>
    </tr>
    
    <tr>
      <td class="tg-yw4l">
      <br>________________________________________________
        <br>SERVIÇO DE ATENÇÃO À SAÚDE/GESPE/SAMF-DF 
        <br>(61) 3412-2100/ 3412-2101/ 3412-2102
        <br>Email: saudedoservidor.df.samf@fazenda.gov.br
      </td>
    </tr>
    <tr>
      <td class="tg-l">
        <br><br><br>Declaro que recebi o original.
      </td>
    </tr>
    <tr>
      <td class="tg-l">
        Data: ________/________/________
      </td>
    </tr>
    <tr>
      <td class="tg-l">
        Matrícula Siape:________________
      </td>
    </tr>
    <tr>
      <td class="tg-l">
        Assinatura por <b>extenso<b>:________________________________________________
      </td>
    </tr>
  </table>
  <br>
  <br>

</div>

</body>

</html>