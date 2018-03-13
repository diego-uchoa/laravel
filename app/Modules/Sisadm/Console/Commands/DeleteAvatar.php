<?php

namespace App\Modules\Sisadm\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteAvatar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sisadm:delete:avatar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleta as imagens (avatar) não associadas a usuários.';

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
        $resultado = DB::select("select ds_foto
                            from spoa_portal.siape_dado_pessoal
                            where ds_foto is not null");

        $arquivos = $this->_montaArray($resultado);

        $path = Storage::disk('public_SISADM')->getDriver()->getAdapter()->getPathPrefix();
        $diretorio = dir($path);
        while($arquivo = $diretorio->read()){
            if (!in_array($arquivo, $arquivos)){
                if (!\File::isDirectory($path.'/'.$arquivo)){
                    unlink($path.'/'.$arquivo);    
                }
            }
        }
    }

    private function _montaArray($resultado)
    {
        $arquivosArray = array();
        foreach ($resultado as $key => $value) {
            array_push($arquivosArray, $value->ds_foto);
        }
        return $arquivosArray;
    }
}
