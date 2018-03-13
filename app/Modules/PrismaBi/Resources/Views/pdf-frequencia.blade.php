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
      margin-top: 5px;
      margin-left: 40px;
      margin-right: 40px;
      font-family:Helvetica,Arial, sans-serif;
    }

    .legenda-right {  
      display: inline;
      float: right;
      font-size:17px;
      font-weight: bold;
      color: #0e3455;
    }
    .titulo {  
      margin-top: 0px;
      margin-bottom: 15px;
      display: block;
      font-size:16px;
      font-weight: bold;
      color: #0e3455;
      border-bottom: 3px solid #0e3455;
    }

    .titulo_anual {  
      margin-top: 0px;
      margin-bottom: 5px;
      display: block;
      font-size:16px;
      font-weight: bold;
      color: #0e3455;
      border-bottom: 3px solid #0e3455;
    }

    .tb-espaco {
      padding:10px;
    }
    
    .grafico {
      height: 29%;
      width:  39%;
    }

    .titulo_grafico {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    text-align: left;
    font-weight: bold;
    padding-bottom: 0px;
    } 

    .subtitulo_grafico {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    text-align: right;
    padding-right: 10px;
    } 

    .titulo_grafico2 {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
    text-align: center;
    font-weight: bold;
    } 
    .subtitulo_grafico2 {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    text-align: center;
    } 
    
   .tb_legenda_eixoy {
     text-align: right;
     vertical-align:top;
     padding-top: 20px;
   }

   .legenda_eixoy {
     height: 180px;
     width:  15px;
   }

   .lengenda_eixox{
      width:  25px;
   }

   .legenda_meses1 {
      color: #1f639e;
      background-color: #1f639e;
      height: 5px;
      width:  25px;
   }
   .legenda_meses2 {
      color: #0b2543;
      background-color: #0b2543;
      height: 5px;
      width:  25px;
   }
   .legenda_meses3 {
      color: #98b954;
      background-color: #98b954;
      height: 5px;
      width:  25px;
   }

   .legenda_meses_txt {
     font-family: Arial, Helvetica, sans-serif;
     font-size: 10px;
     padding-left: 50px;
   }

   .rodape {
     font-size:11px;
     font-weight: normal;
     color: #414042;
     text-align:justify;
     margin-top: 200px;
   }
    </style>

</head>

<body>
  
<div>
  <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
</div>

<div class="container">
   <br>
   <div class="titulo" style="margin-bottom: 5px;"> 
      {{trans('prisma-bi::pdf.frequencia')}} - 
      <label style="font-weight: normal;"> {{ trans('prisma-bi::pdf.previsoes-frequencia', ['periodo' => $mes] ) }} 
      </label> 
   </div>

     
  <table>
   <tr>
     <td colspan="2" >
          <div class="titulo_grafico">{{trans('prisma-bi::pdf.arrecadacao_freq')}}</div>
     </td>
     <td style="width:20px">
       <div style="width:20px"></div>
     </td>
     <td colspan="2" > 
          <div class="titulo_grafico">{{trans('prisma-bi::pdf.receita_freq')}}</div>
     </td>
   </tr>

   <tr >
     <td colspan="2">
      <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
    </td>
    <td ></td>
     <td colspan="2">
      <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
    </td>
   </tr>

   <tr>
     <td class="tb_legenda_eixoy" >
       <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy">
     </td>
     <td style="text-align:center">
  	   	<img src="{{ $grafico_arr_m }}" class="grafico">
        
        <table class="legenda_meses_txt">
         <tr>
         <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
         <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
         <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
         </tr>
        </table>

  	 </td>

     <td></td>
     <td class="tb_legenda_eixoy">
         <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy" >
     </td>
  	 <td>
   	    <img src="{{ $grafico_rec_m}}" class="grafico">

        <table class="legenda_meses_txt">
         <tr>
         <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
         <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
         <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
         </tr>
        </table>

  	 </td>
	 </tr>
   
   
   <tr>
         <th class="tb-espaco" colspan="2"> </th>
   </tr>
   
   
       <tr>
         <td colspan="2" >
              <div class="titulo_grafico">{{trans('prisma-bi::pdf.despesa_freq')}}</div>
         </td>
         <td style="width:20px">
           <div style="width:20px"></div>
         </td>
         <td colspan="2" > 
              <div class="titulo_grafico">{{trans('prisma-bi::pdf.resultado_freq')}}</div>
         </td>
       </tr>

       <tr >
         <td colspan="2">
          <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
        </td>
        <td ></td>
         <td colspan="2">
          <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
        </td>
       </tr>

       <tr>
         <td class="tb_legenda_eixoy" >
           <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy">
         </td>
         <td style="text-align:center">
            <img src="{{ $grafico_des_m }}" class="grafico">
            
            <table class="legenda_meses_txt">
             <tr>
             <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
             <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
             <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
             </tr>
            </table>

         </td>

         <td></td>
         <td class="tb_legenda_eixoy">
             <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy" >
         </td>
         <td>
            <img src="{{ $grafico_res_m}}" class="grafico">

            <table class="legenda_meses_txt">
             <tr>
             <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
             <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
             <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
             </tr>
            </table>

         </td>
       </tr>
  </table>

  <div class="rodape"> 
     {{ trans('prisma-bi::pdf.observacao_freq1')}}
     <br>
     {{ trans('prisma-bi::pdf.observacao_freq2')}}
  </div>

  </div>

  <div style="page-break-before:always"></div>

  <div>
    <img src="{{ $path }}/modules/prismabi/imagens/cabecalho.jpg" class="imagem-cabecalho">
  </div>

  <div class="container" style="margin-top: 0px;">
     <br>
     <div class="titulo_anual"> 
        {{trans('prisma-bi::pdf.frequencia')}} - 
        <label style="font-weight: normal;"> {{ trans('prisma-bi::pdf.previsoes-frequencia', ['periodo' => $ano] ) }} 
        </label> 
     </div>

    <table>
     <tr>
       <td colspan="2" >
            <div class="titulo_grafico">{{trans('prisma-bi::pdf.arrecadacao_freq')}}</div>
       </td>
       <td style="width:20px">
         <div style="width:20px"></div>
       </td>
       <td colspan="2" > 
            <div class="titulo_grafico">{{trans('prisma-bi::pdf.receita_freq')}}</div>
       </td>
     </tr>

     <tr >
       <td colspan="2">
        <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
      </td>
      <td ></td>
       <td colspan="2">
        <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
      </td>
     </tr>

     <tr>
       <td class="tb_legenda_eixoy" >
         <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy">
       </td>
       <td style="text-align:center">
          <img src="{{ $grafico_arr_a }}" class="grafico">
          
          <table class="legenda_meses_txt">
           <tr>
           <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
           <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
           <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
           </tr>
          </table>

       </td>

       <td></td>
       <td class="tb_legenda_eixoy">
           <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy" >
       </td>
       <td>
          <img src="{{ $grafico_rec_a}}" class="grafico">

          <table class="legenda_meses_txt">
           <tr>
           <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
           <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
           <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
           </tr>
          </table>

       </td>
     </tr>
    
     <tr>
           <td colspan="2" >
                <div class="titulo_grafico">{{trans('prisma-bi::pdf.despesa_freq')}}</div>
           </td>
           <td style="width:20px">
             <div style="width:20px"></div>
           </td>
           <td colspan="2" > 
                <div class="titulo_grafico">{{trans('prisma-bi::pdf.resultado_freq')}}</div>
           </td>
         </tr>

         <tr >
           <td colspan="2">
            <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
          </td>
          <td ></td>
           <td colspan="2">
            <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.bilhoes') }}</div> 
          </td>
         </tr>

         <tr>
           <td class="tb_legenda_eixoy" >
             <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy">
           </td>
           <td style="text-align:center">
              <img src="{{ $grafico_des_a }}" class="grafico">
              
              <table class="legenda_meses_txt">
               <tr>
               <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
               <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
               <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
               </tr>
              </table>

           </td>

           <td></td>
           <td class="tb_legenda_eixoy">
               <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy" >
           </td>
           <td>
              <img src="{{ $grafico_res_a}}" class="grafico">

              <table class="legenda_meses_txt">
               <tr>
               <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
               <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
               <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
               </tr>
              </table>

           </td>
    </tr>
 

    <tr>
        <td colspan="5" style="padding-left: 200px">
                    <div class="titulo_grafico">{{trans('prisma-bi::pdf.divida_freq')}}</div>
       </td>
    </tr>

    <tr >
        <td colspan="5" style="padding-right: 220px">
                <div class="subtitulo_grafico">{{ trans('prisma-bi::pdf.pib') }}</div> 
        </td>
    </tr>

    <tr>
      <td colspan="5" style="padding-left: 200px">
        <table>
          <tr>
            <td class="tb_legenda_eixoy">
                 <img src="{{ $path }}/modules/prismabi/imagens/{{$legenda_eixoy}}" class="legenda_eixoy">
            </td>
            <td style="text-align:center">
                  <img src="{{ $grafico_div_a }}" class="grafico">
                  
                  <table class="legenda_meses_txt">
                   <tr>
                   <td class="lengenda_eixox"><div class="legenda_meses1"/></td><td>{{$meses[0]}}</td>
                   <td class="lengenda_eixox"><div class="legenda_meses2"/></td><td>{{$meses[1]}}</td>
                   <td class="lengenda_eixox"><div class="legenda_meses3"/></td><td>{{$meses[2]}}</td>
                   </tr>
                  </table>
            </td>
          </tr>
        </table>  
       </td>     
    </tr>         
    </table>
    
    
</div>
</body>

</html>
