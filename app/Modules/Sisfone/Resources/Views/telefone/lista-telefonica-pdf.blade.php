<!doctype html>
<html>
<head>

<style>
  table {
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: left;
  }
  tr:nth-child(even) {
    background-color: #eee;
  }
  tr:nth-child(odd) {
    background-color: #fff;
  }            
</style>
    
</head>
<body>
<div class="container">

    <header class="row">
        
    </header>

    <div id="main" class="row">

           <table>
            <tr>
              <th>Usuário</th>
              <th>Nº Telefone</th>
              <th>Tipo</th>
              <th>Principal</th>          
              <th>Orgão</th>            
            </tr>
            @foreach($telefones as $telefone)
            <tr>
              <td>{{$telefone->usuario->no_usuario}}</td>
              <td>{{$telefone->tx_telefone}}</td>
              <td>{{$telefone->tipo->no_tipo_telefone}}</td>
              <td>
               @if($telefone->sn_principal)
               Principal
               @else
               -
               @endif
             </td>
             <td>{{$telefone->usuario->orgao->sg_orgao}}</td>                 
           </tr>
           @endforeach
           </table>

    </div>

    <footer class="row">
        
    </footer>

</div>
</body>
</html>