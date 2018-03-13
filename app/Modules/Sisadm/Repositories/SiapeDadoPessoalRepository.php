<?php
namespace App\Modules\Sisadm\Repositories;

use App\Repositories\AbstractRepository;
use App\Modules\Sisadm\Models\SiapeDadoPessoal;
use MaskHelper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;

class SiapeDadoPessoalRepository extends AbstractRepository
{
    protected $model;

    public function __construct(SiapeDadoPessoal $model)
    {
        $this->model = $model;
    }

    /**
    * Grava dados pessoais da pessoa recuperados do WebService do SIAPE na BD
    * @param  string $id_usuario
    * @param  string $cpf
    * @param  array $siapeDadoPessoalWS
    * @return SiapeDadoPessoal
    */
    public function store($id_usuario, $cpf, $siapeDadoPessoalWS)
    {
        if ($siapeDadoPessoalWS){
            
            $pessoaBD = $this->findPessoaByCPF($cpf);
            $array_SiapeDadoPessoal = $this->__SiapeDadoPessoaltoArray($id_usuario, $cpf, $siapeDadoPessoalWS);
            
            if (!$pessoaBD->isEmpty()){

                $pessoaBD[0]->update($array_SiapeDadoPessoal);
                return $pessoaBD[0];

            }else{
                
                return SiapeDadoPessoal::create($array_SiapeDadoPessoal);

            }
        }

        return null;
    }    

    /**
    * Transforma o retorno do WS em formato de array
    * @param  string $id_usuario
    * @param  string $cpf
    * @param  array $siapeDadoPessoalWS
    * @return array
    */
    private function __SiapeDadoPessoaltoArray($id_usuario, $cpf, $siapeDadoPessoalWS)
    {
        return [
            'id_usuario' => $id_usuario ? $id_usuario : null,
            'nr_cpf' => $cpf,
            'no_pessoa' => $siapeDadoPessoalWS->nome,
            'dt_nascimento' => $this->_formataDataNascimento($siapeDadoPessoalWS->dataNascimento),
            'in_estado_civil' => $siapeDadoPessoalWS->nomeEstadoCivil,
            'no_mae' => $siapeDadoPessoalWS->nomeMae,
            'no_pai' => $siapeDadoPessoalWS->nomePai,
            'in_sexo' => $siapeDadoPessoalWS->codSexo,
            'sg_uf_nascimento' => $siapeDadoPessoalWS->ufNascimento,
            'no_municipio_nascimento' => $siapeDadoPessoalWS->nomeMunicipNasc,
            'nr_pis_pasep' => $siapeDadoPessoalWS->numPisPasep,
        ];
    }

    /**
    * Recuperar dados da pessoa no BD
    * @param  string $cpf
    * @return Array
    */
    public function findPessoaByCPF($cpf)
    {
        $cpf_sem_mascara = MaskHelper::removeMascaraCpf($cpf);
        $pessoa = $this->findBy([['nr_cpf', '=' , $cpf_sem_mascara]]);
        return $pessoa;
    }

    /**
    * Atualiza foto do servidor no BD
    * @param  string $cpf
    * @param  string $photo
    * @return SiapeDadoPessoal
    */
    public function updatePhoto($cpf, $photo)
    {
        $arrayFoto = [];
        $cpf_sem_mascara = MaskHelper::removeMascaraCpf($cpf);

        $splited = explode(',', substr($photo, 5 ), 2);
        $mime = $splited[0];
        $data = $splited[1];

        $mime_split_without_base64 = explode(';', $mime,2);
        $mime_split = explode('/', $mime_split_without_base64[0],2);
        
        if (count($mime_split) == 2)
        {
           $extension = $mime_split[1];
           if($extension == 'jpeg') $extension='jpg';
        }

        $nomeArquivo = $this->_generateId($cpf_sem_mascara, 4) .'.'. $extension;
        Storage::disk('public_SISADM')->put($nomeArquivo, base64_decode($data));

        $pessoa = $this->findPessoaByCPF($cpf_sem_mascara);
        
        $pessoa[0]->update(['ds_foto' => $nomeArquivo]);

        return $pessoa[0];
    }

    /**
     * Funcionalidade responsável por gerar uma id para foto do servidor
     * @return String
    */
    private function _generateId($cpf_sem_mascara, $qtd)
    { 
        $Caracteres = '0123456789'; 
        $QuantidadeCaracteres = strlen($Caracteres); 
        $QuantidadeCaracteres--; 

        $Hash = NULL; 
        
        for ($x=1;$x<=$qtd;$x++){ 
            $Posicao = rand(0,$QuantidadeCaracteres); 
            $Hash .= substr($Caracteres,$Posicao,1); 
        } 

        return $cpf_sem_mascara . '_' . $Hash; 
    }


    /**
    * Método responsável por formatar a data de nascimento da pessoa
    * @param  String dataNascimento
    */
    private function _formataDataNascimento($value)
    {   
        $dia = substr($value, 0, 2);
        $mes = substr($value, 2, 2);
        $ano = substr($value, 4, 4);
        
        return $ano .'-'. $mes .'-'. $dia;
    }

}