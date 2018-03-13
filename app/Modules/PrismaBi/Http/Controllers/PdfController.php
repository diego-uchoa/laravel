<?php

namespace App\Modules\PrismaBi\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

use PDF;

use Log;

use Charts;

use App;

use DateTime;

class PdfController extends Controller
{
    public function exportar(Request $request)
    {
        $dados = $request['dados'];
        
        $dados = json_decode($dados);
        
        $relatorio = $dados->relatorio;

        $locale = $dados->locale;

        App::setLocale($locale);
         
        Log::info($relatorio);
        Log::info(App::getLocale());

        if ($relatorio == 'RelatorioMensal') {
            return $this->_exportarRelatorioMensal($dados);
        } else if ($relatorio == 'PodiumCurtoPrazo' or $relatorio == 'PodiumLongoPrazo' or $relatorio == 'PodiumMelhoresCurto'){
            return $this->_exportarPodium($dados);
        } else if ($relatorio == 'Frequencia') {
            return $this->_exportarFrequencia($dados);
        }

     }

    public function _exportarRelatorioMensal($dados) {
        $mes= $this->_transformaMesCompleto($dados->mes);

        /**************** DADOS PARA PREVISÕES MENSAIS ***************************/
        $prevMensal = $dados->PrevisaoMensal;
        foreach ($prevMensal->dadosMensais as $value) {
             
             $value->valorMetrica1 = $this->_criaPosicaoVariacao($value->valorMetrica1);
             $value->valorMetrica1[2] = $this->_verificaVariacao($value->valorMetrica1[0],$value->valorMetrica1[1]);
             $value->valorMetrica1[5] = $this->_verificaVariacao($value->valorMetrica1[3],$value->valorMetrica1[4]);
             $value->valorMetrica1[8] = $this->_verificaVariacao($value->valorMetrica1[6],$value->valorMetrica1[7]);

             $value->valorMetrica2 = $this->_criaPosicaoVariacao($value->valorMetrica2);
             $value->valorMetrica2[2] = $this->_verificaVariacao($value->valorMetrica2[0],$value->valorMetrica2[1]);
             $value->valorMetrica2[5] = $this->_verificaVariacao($value->valorMetrica2[3],$value->valorMetrica2[4]);
             $value->valorMetrica2[8] = $this->_verificaVariacao($value->valorMetrica2[6],$value->valorMetrica2[7]);

             $value->valorMetrica3 = $this->_criaPosicaoVariacao($value->valorMetrica3);
             $value->valorMetrica3[2] = $this->_verificaVariacao($value->valorMetrica3[0],$value->valorMetrica3[1]);
             $value->valorMetrica3[5] = $this->_verificaVariacao($value->valorMetrica3[3],$value->valorMetrica3[4]);
             $value->valorMetrica3[8] = $this->_verificaVariacao($value->valorMetrica3[6],$value->valorMetrica3[7]);

             $value->valorMetrica4 = $this->_criaPosicaoVariacao($value->valorMetrica4);
             $value->valorMetrica4[2] = $this->_verificaVariacao($value->valorMetrica4[0],$value->valorMetrica4[1]);
             $value->valorMetrica4[5] = $this->_verificaVariacao($value->valorMetrica4[3],$value->valorMetrica4[4]);
             $value->valorMetrica4[8] = $this->_verificaVariacao($value->valorMetrica4[6],$value->valorMetrica4[7]);

             $value->valorMetrica5 = $this->_criaPosicaoVariacao($value->valorMetrica5);
             $value->valorMetrica5[2] = $this->_verificaVariacao($value->valorMetrica5[0],$value->valorMetrica5[1]);
             $value->valorMetrica5[5] = $this->_verificaVariacao($value->valorMetrica5[3],$value->valorMetrica5[4]);
             $value->valorMetrica5[8] = $this->_verificaVariacao($value->valorMetrica5[6],$value->valorMetrica5[7]);


        }
        $meses=$this->_transformaArrayMesConmpleto($prevMensal->meses);
        $dadosPrevMensal = json_encode($prevMensal->dadosMensais);
        
        /**************** DADOS PARA PREVISÕES ANUAIS ***************************/
        $prevAnual = $dados->PrevisaoAnual;
        foreach ($prevAnual->dadosAnuais as $value) {
                
            $value->valorMetrica1 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica1);
            $value->valorMetrica1[2] = $this->_verificaVariacao($value->valorMetrica1[0],$value->valorMetrica1[1]);
            $value->valorMetrica1[5] = $this->_verificaVariacao($value->valorMetrica1[3],$value->valorMetrica1[4]);
            
            $value->valorMetrica2 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica2);
            $value->valorMetrica2[2] = $this->_verificaVariacao($value->valorMetrica2[0],$value->valorMetrica2[1]);
            $value->valorMetrica2[5] = $this->_verificaVariacao($value->valorMetrica2[3],$value->valorMetrica2[4]);
            
            $value->valorMetrica3 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica3);
            $value->valorMetrica3[2] = $this->_verificaVariacao($value->valorMetrica3[0],$value->valorMetrica3[1]);
            $value->valorMetrica3[5] = $this->_verificaVariacao($value->valorMetrica3[3],$value->valorMetrica3[4]);
            
            $value->valorMetrica4 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica4);
            $value->valorMetrica4[2] = $this->_verificaVariacao($value->valorMetrica4[0],$value->valorMetrica4[1]);
            $value->valorMetrica4[5] = $this->_verificaVariacao($value->valorMetrica4[3],$value->valorMetrica4[4]);
            
            $value->valorMetrica5 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica5);
            $value->valorMetrica5[2] = $this->_verificaVariacao($value->valorMetrica5[0],$value->valorMetrica5[1]);
            $value->valorMetrica5[5] = $this->_verificaVariacao($value->valorMetrica5[3],$value->valorMetrica5[4]);

        }
        $anos=$prevAnual->anos;
        $dadosPrevAnual = json_encode($prevAnual->dadosAnuais);        


        /**************** DADOS PARA MÉDIA CURTO PRAZO ***************************/
        $mediaCurto = $dados->MediaPodiumCurto;
        $mesesTeste = $mediaCurto->meses[0];
        if (strcmp($mesesTeste,"-")==0){ // OS dados do grafico estão vazios
           $dadosMediaCurto = null;
        } else {
        
            foreach ($mediaCurto->dadosMensais as $value) {
                    
                $value->valor = $this->_criaPosicaoVariacao($value->valor);
                $value->valor[2] = $this->_verificaVariacao($value->valor[0],$value->valor[1]);
                $value->valor[5] = $this->_verificaVariacao($value->valor[3],$value->valor[4]);
                $value->valor[8] = $this->_verificaVariacao($value->valor[6],$value->valor[7]);
            
            }
            $dadosMediaCurto = json_encode($mediaCurto->dadosMensais);
        }

        /**************** DADOS PARA MÉDIA LONGO PRAZO ***************************/
        $mediaLongo = $dados->MediaPodiumLongo;

        $anosTeste = $mediaLongo->anos[0];
        if (strcmp($anosTeste,"-")==0){ // OS dados do grafico estão vazios
           $dadosMediaLongo = null;
        } else {
            foreach ($mediaLongo->dadosMensais as $value) {
                        
                $value->valor = $this->_criaPosicaoVariacaoAnual($value->valor);
                $value->valor[2] = $this->_verificaVariacao($value->valor[0],$value->valor[1]);
                $value->valor[5] = $this->_verificaVariacao($value->valor[3],$value->valor[4]);
                        
            }
            $dadosMediaLongo = json_encode($mediaLongo->dadosMensais);
        }
        /******************************************************************************************/
        $path = public_path();

        $pdf = PDF::loadView('prisma-bi::pdf-rel-mensal', compact('mes','meses','anos','dadosPrevMensal','dadosPrevAnual','dadosMediaCurto','dadosMediaLongo','path'));

        return response(['pdf' => base64_encode($pdf->stream()), 'status' => 'success']); 

        /** teste **/
        //return $pdf->download('relatorio_mensal.pdf');


    }
 /*   public function _exportarMensal($dados)
    {
                 
        foreach ($dados->dadosMensais as $value) {
             
             $value->valorMetrica1 = $this->_criaPosicaoVariacao($value->valorMetrica1);
             $value->valorMetrica1[2] = $this->_verificaVariacao($value->valorMetrica1[0],$value->valorMetrica1[1]);
             $value->valorMetrica1[5] = $this->_verificaVariacao($value->valorMetrica1[3],$value->valorMetrica1[4]);
             $value->valorMetrica1[8] = $this->_verificaVariacao($value->valorMetrica1[6],$value->valorMetrica1[7]);

             $value->valorMetrica2 = $this->_criaPosicaoVariacao($value->valorMetrica2);
             $value->valorMetrica2[2] = $this->_verificaVariacao($value->valorMetrica2[0],$value->valorMetrica2[1]);
             $value->valorMetrica2[5] = $this->_verificaVariacao($value->valorMetrica2[3],$value->valorMetrica2[4]);
             $value->valorMetrica2[8] = $this->_verificaVariacao($value->valorMetrica2[6],$value->valorMetrica2[7]);

             $value->valorMetrica3 = $this->_criaPosicaoVariacao($value->valorMetrica3);
             $value->valorMetrica3[2] = $this->_verificaVariacao($value->valorMetrica3[0],$value->valorMetrica3[1]);
             $value->valorMetrica3[5] = $this->_verificaVariacao($value->valorMetrica3[3],$value->valorMetrica3[4]);
             $value->valorMetrica3[8] = $this->_verificaVariacao($value->valorMetrica3[6],$value->valorMetrica3[7]);

             $value->valorMetrica4 = $this->_criaPosicaoVariacao($value->valorMetrica4);
             $value->valorMetrica4[2] = $this->_verificaVariacao($value->valorMetrica4[0],$value->valorMetrica4[1]);
             $value->valorMetrica4[5] = $this->_verificaVariacao($value->valorMetrica4[3],$value->valorMetrica4[4]);
             $value->valorMetrica4[8] = $this->_verificaVariacao($value->valorMetrica4[6],$value->valorMetrica4[7]);

             $value->valorMetrica5 = $this->_criaPosicaoVariacao($value->valorMetrica5);
             $value->valorMetrica5[2] = $this->_verificaVariacao($value->valorMetrica5[0],$value->valorMetrica5[1]);
             $value->valorMetrica5[5] = $this->_verificaVariacao($value->valorMetrica5[3],$value->valorMetrica5[4]);
             $value->valorMetrica5[8] = $this->_verificaVariacao($value->valorMetrica5[6],$value->valorMetrica5[7]);


        }

        $mes= $this->_transformaMesCompleto($dados->mes);
        $meses=$this->_transformaArrayMesConmpleto($dados->meses);
        $dadosMensais = json_encode($dados->dadosMensais);
        
   
        $path = public_path();

        $pdf = PDF::loadView('prisma-bi::pdf-mensal-v2', compact('mes','meses','dadosMensais','path'));

        return response(['pdf' => base64_encode($pdf->stream()), 'status' => 'success']); 

    }

    public function _exportarAnual($dados)
    {
            
        foreach ($dados->dadosAnuais as $value) {
                
            $value->valorMetrica1 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica1);
            $value->valorMetrica1[2] = $this->_verificaVariacao($value->valorMetrica1[0],$value->valorMetrica1[1]);
            $value->valorMetrica1[5] = $this->_verificaVariacao($value->valorMetrica1[3],$value->valorMetrica1[4]);
            
            $value->valorMetrica2 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica2);
            $value->valorMetrica2[2] = $this->_verificaVariacao($value->valorMetrica2[0],$value->valorMetrica2[1]);
            $value->valorMetrica2[5] = $this->_verificaVariacao($value->valorMetrica2[3],$value->valorMetrica2[4]);
            
            $value->valorMetrica3 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica3);
            $value->valorMetrica3[2] = $this->_verificaVariacao($value->valorMetrica3[0],$value->valorMetrica3[1]);
            $value->valorMetrica3[5] = $this->_verificaVariacao($value->valorMetrica3[3],$value->valorMetrica3[4]);
            
            $value->valorMetrica4 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica4);
            $value->valorMetrica4[2] = $this->_verificaVariacao($value->valorMetrica4[0],$value->valorMetrica4[1]);
            $value->valorMetrica4[5] = $this->_verificaVariacao($value->valorMetrica4[3],$value->valorMetrica4[4]);
            
            $value->valorMetrica5 = $this->_criaPosicaoVariacaoAnual($value->valorMetrica5);
            $value->valorMetrica5[2] = $this->_verificaVariacao($value->valorMetrica5[0],$value->valorMetrica5[1]);
            $value->valorMetrica5[5] = $this->_verificaVariacao($value->valorMetrica5[3],$value->valorMetrica5[4]);

        }
    
        $mes= $this->_transformaMesCompleto($dados->mes);
        $anos=$dados->anos;
        $dadosAnuais = json_encode($dados->dadosAnuais);        
        $path = public_path();

        $pdf = PDF::loadView('prisma-bi::pdf-anual-v2', compact('mes','anos','dadosAnuais','path'));

        return response(['pdf' => base64_encode($pdf->stream()), 'status' => 'success']); 

    }

    public function _exportarMediaPodiumCurto($dados)
    {

        foreach ($dados->dadosMensais as $value) {
                
            $value->valor = $this->_criaPosicaoVariacao($value->valor);
            $value->valor[2] = $this->_verificaVariacao($value->valor[0],$value->valor[1]);
            $value->valor[5] = $this->_verificaVariacao($value->valor[3],$value->valor[4]);
            $value->valor[8] = $this->_verificaVariacao($value->valor[6],$value->valor[7]);
    
        }

        
        $mes= $this->_transformaMesCompleto($dados->mes);
        $meses=$this->_transformaArrayMesConmpleto($dados->meses);
        $dadosMensais = json_encode($dados->dadosMensais);
        $path = public_path();

        $pdf = PDF::loadView('prisma-bi::pdf-mp-curto-v2', compact('mes','meses','dadosMensais','path'));

        return response(['pdf' => base64_encode($pdf->stream()), 'status' => 'success']); 
             
 
         }


    public function _exportarMediaPodiumLongo($dados)
    {

        foreach ($dados->dadosMensais as $value) {
                    
            $value->valor = $this->_criaPosicaoVariacaoAnual($value->valor);
            $value->valor[2] = $this->_verificaVariacao($value->valor[0],$value->valor[1]);
            $value->valor[5] = $this->_verificaVariacao($value->valor[3],$value->valor[4]);
                    
        }

            
        $mes=$this->_transformaMesCompleto($dados->mes);
        $anos=$dados->anos;
        $dadosMensais = json_encode($dados->dadosMensais);
        $path = public_path();

        $pdf = PDF::loadView('prisma-bi::pdf-mp-longo-v2', compact('mes','anos','dadosMensais','path'));

        return response(['pdf' => base64_encode($pdf->stream()), 'status' => 'success']); 
  
    }
    */

    public function _exportarPodium($dados)
    {

        $periodo=$this->_transformaPeriodo($dados->periodo);
        $relatorio = $dados->relatorio;
        $dados = json_encode($dados->dados);
        $path = public_path();
        
        $nome_pdf;
        if ($relatorio == 'PodiumCurtoPrazo'){
            $nome_pdf = 'prisma-bi::pdf-podium-curto-v2';
        } else if ($relatorio == 'PodiumLongoPrazo'){
            $nome_pdf = 'prisma-bi::pdf-podium-longo-v2';
        } else if ($relatorio == 'PodiumMelhoresCurto') {
            $nome_pdf = 'prisma-bi::pdf-podium-melhores-v2';
        }

        $pdf = PDF::loadView($nome_pdf, compact('periodo','dados','path'));

        return response(['pdf' => base64_encode($pdf->stream()), 'status' => 'success']); 
                 
         /** teste **/
        //return $pdf->download('spe-prisma-relatorio.pdf');

    }

    public function _exportarFrequencia($dados)
    {
       Log::info('Relatorio Frequencia');
       
       $path = public_path();

       $mes=$this->_transformaMesCompleto($dados->mes);
       $ano=$dados->ano;
       $meses =$this->_transformaMes($dados->meses);

       $grafico_arr_m = $dados->grafico_arr_m;
       $grafico_rec_m = $dados->grafico_rec_m;
       $grafico_des_m = $dados->grafico_des_m;
       $grafico_res_m = $dados->grafico_res_m;

        $grafico_arr_a = $dados->grafico_arr_a;
        $grafico_rec_a = $dados->grafico_rec_a;
        $grafico_des_a = $dados->grafico_des_a;
        $grafico_res_a = $dados->grafico_res_a;
        $grafico_div_a = $dados->grafico_div_a;
               
        $legenda_eixoy="";
        if (strcmp(App::getLocale(),'en') == 0){
             $legenda_eixoy="legenda_eixoy_en.png";
        }else{
            $legenda_eixoy="legenda_eixoy_pt.png";
        }
         

        $pdf = PDF::loadView('prisma-bi::pdf-frequencia',
                             compact('mes','ano', 'meses',
                                 'grafico_arr_m','grafico_rec_m','grafico_des_m','grafico_res_m',
                                 'grafico_arr_a','grafico_rec_a','grafico_des_a','grafico_res_a','grafico_div_a','path','legenda_eixoy'));

       return response(['pdf' => base64_encode($pdf->stream()), 'status' => 'success']); 
            
        /** teste **/
      // return $pdf->download('spe-prisma-frequencia.pdf');
       

    }


    public function _verificaVariacao($valorA_txt, $valorB_txt){
        $valorA = floatval(str_replace(',', '.', str_replace('.', '', $valorA_txt)));
        $valorB = floatval(str_replace(',', '.', str_replace('.', '', $valorB_txt)));

        if($valorA > $valorB){
            return ['imagem','seta-sobe'];
        }
        else if ($valorA < $valorB){
            return ['imagem','seta-desce'];
        }
        else{
            return ['imagem','igual'];
        }

    }

    public function _criaPosicaoVariacao($array){
        $array[6] = $array[4];
        $array[7] = $array[5];
        $array[4] = $array[3];
        $array[3] = $array[2];
        return $array;
    }

    public function _criaPosicaoVariacaoAnual($array){
        $array[4] = $array[3];
        $array[3] = $array[2];
        return $array;
    }

    public function _transformaPeriodo($periodo){
        $pos = strpos($periodo, ' a ');

        if ($pos === false) {
            $periodo_completo = $periodo;
        } else {
            $periodo1 = substr($periodo,0,$pos);
            $periodo2 = substr($periodo,$pos+3);

            $periodo1 = $this->_transformaMesCompleto($periodo1);
            $periodo2 = $this->_transformaMesCompleto($periodo2);
         
            $a = ' a ';
            if ( strcmp(App::getLocale(),'en') == 0 ){
              $a = ' to ';
            }
            $periodo_completo =   $periodo1.$a.$periodo2;
        }
           
       return  $periodo_completo;
    }

    public function _transformaMesCompleto($mes){
        if (strlen($mes) == 8 ) {
            $mes = str_replace('jan','janeiro',$mes);
            $mes = str_replace('fev','fevereiro',$mes);
            $mes = str_replace('mar','março',$mes);
            $mes = str_replace('abr','abril',$mes);
            $mes = str_replace('mai','maio',$mes);
            $mes = str_replace('jun','junho',$mes);
            $mes = str_replace('jul','julho',$mes);
            $mes = str_replace('ago','agosto',$mes);
            $mes = str_replace('set','setembro',$mes);
            $mes = str_replace('out','outubro',$mes);
            $mes = str_replace('nov','novembro',$mes);
            $mes = str_replace('dez','dezembro',$mes);
        }

        $token1 = strtok($mes,"/");
        $token2 = strtok("/");
        

        //Converte para a lingua
        return trans( 'prisma-bi::pdf.'.$token1 ) . '/'.$token2 ;;
    }

    public function _transformaMes($array) {
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
           $periodo = $array[$i];
           $periodo = $this->_transformaMesCompleto($periodo);
           $token1 = strtok($periodo,"/");
           $token2 = strtok("/");

           $token1 = substr ($token1,0,3);
           $periodo_completo =  $token1.'/'.$token2;
           $array[$i] = $periodo_completo;
        }
        return $array;

    }

    public function _transformaArrayMesConmpleto($array){
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
           $periodo = $array[$i];
           $periodo = $this->_transformaMesCompleto($periodo);
           $token1 = strtok($periodo,"/");
           $token2 = strtok("/");

           $de = ' de ';
           if ( strcmp(App::getLocale(),'en') == 0 ){
              $de = ' ';
           }
           $periodo_completo =  $token1.$de.$token2;
           $array[$i] = $periodo_completo;
        }
        return $array;
    }

    public static function getNomeImg($variavel)
    {
        $token1 = strtolower(strtok($variavel," "));

        $img = preg_replace('/[áàãâä]/ui', 'a', $token1);
        $img = preg_replace('/[éèêë]/ui', 'e', $img);
        $img = preg_replace('/[íìîï]/ui', 'i', $img);
        $img = preg_replace('/[óòõôö]/ui', 'o', $img);
        $img = preg_replace('/[úùûü]/ui', 'u', $img);
        $img = preg_replace('/[ç]/ui', 'c', $img);
        
        return $img ;
    }

    public static function formataNum($valor)
    {
       if( strcmp(App::getLocale(),'en') == 0 ){
         $valor = str_replace(',', '*', $valor);
         $valor = str_replace('.', ',', $valor);
         $valor = str_replace('*', '.', $valor);

       }
        
        return $valor ;
    }
   
   
    public function exportarTeste()
    {  
       // $dados = Teste::_exportarFrequenciaMensalTeste();
       // $dados = Teste::_exportarRelatorioMensalTeste();
        $dados = Teste::_exportarPodiumCurtoTeste();

        $locale = $dados->locale;

        App::setLocale($locale);

       // return $this->_exportarFrequenciaTeste($dados);    
        //return $this->_exportarRelatorioMensal($dados);    
        return $this->_exportarPodium($dados);    
    }



}
