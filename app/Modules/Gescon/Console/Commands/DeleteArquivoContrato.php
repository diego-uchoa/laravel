<?php

namespace App\Modules\Gescon\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteArquivoContrato extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gescon:delete:arquivo:contrato';
    protected $array_arquivos = [];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleta todos os arquivos que não estão mais vinculados a Contratos.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $resultado = DB::select("select tx_arquivo_modalidade as arquivo
                            from spoa_portal_gescon.contrato
                            where tx_arquivo_modalidade is not null
                            union 
                                select tx_arquivo_contrato
                            from spoa_portal_gescon.contrato
                            where tx_arquivo_contrato is not null");
        $arquivosBD = $this->_montaArray($resultado);
        
        $path = Storage::disk('public_GESCON')->getDriver()->getAdapter()->getPathPrefix();
        $this->_buscaArquivos($path);
            
        foreach ($this->array_arquivos as $arquivo) {
            $array_explode = explode("//", $arquivo);
            if (!in_array($array_explode[1], $arquivosBD)){
                unlink($path . $array_explode[1]);
            }
        }
    }

    protected function _buscaArquivos($path)
    {
        if (($path != ".") && ($path != "..")){
            if (is_dir($path)){
                $subs = scandir($path);
                foreach ($subs as $sub) {
                    if (($sub != ".") && ($sub != "..")){
                        if (is_dir($path . "/" . $sub)){
                            $this->_buscaArquivos($path . "/" . $sub);
                        }else{
                            array_push($this->array_arquivos, $path . "/" . $sub);
                        }
                    }
                }
            }
        }   
    }

    private function _montaArray($resultado)
    {
        $arquivosArray = array();
        foreach ($resultado as $key => $value) {
            array_push($arquivosArray, $value->arquivo);
        }
        return $arquivosArray;
    }
}
