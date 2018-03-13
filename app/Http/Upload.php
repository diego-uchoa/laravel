<?php

namespace App\Http;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Exception;
use File;

class Upload
{

    /**
     * Método responsável por realizar o upload dos arquivos no Disco e na Pasta informados
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $nomeDisk
     * @param  string $pasta (Opcional)
     * @return Collection [nomeArquivo, caminhoArquivo]
     */
    public static function uploadFile(UploadedFile $file, $nomeDisk, $pasta = '') 
    {
        $nomeArquivo = static::getNomeTratadoArquivo($file);    
        
        $file->storeAs($pasta, $nomeArquivo, $nomeDisk);

        $caminho_disk = Storage::disk($nomeDisk)->getDriver()->getAdapter()->getPathPrefix();

        if ($pasta != '')
        {
            $caminho_disk = $caminho_disk . $pasta . '/';
        }

        return collect(['nome_arquivo' => $nomeArquivo, 'caminho_arquivo' => $caminho_disk]);    
        
    }

    /**
     * Método responsável por gerar um nome novo do arquivo baseado no nome original
     *
     * @param  string $file_path
     * @return string $nomeTratado
     */
    public static function getNomeTratadoArquivo(UploadedFile $file)
    {
        
        $nomeArquivoComExtensao = static::getNomeOriginalArquivo($file);
        $nomeArquivo = File::name($nomeArquivoComExtensao);
        $extensaoArquivo = File::extension($nomeArquivoComExtensao);

        $nomeArquivoTratado =  static::generateID() . '_' . static::trataNomeArquivo($nomeArquivo) . '.' . $extensaoArquivo;
        return $nomeArquivoTratado;

    }

    /**
     * Método responsável por retirar os caracteres especiais do nome do Arquivo
     *
     * @param  string $nomeArquivo
     * @return string $nomeSemCaracteres
     */
    private static function trataNomeArquivo($nomeArquivo)
    {
        return preg_replace('{\W}', '', preg_replace('{ +}', '_', strtr(
            utf8_decode(html_entity_decode($nomeArquivo)),
            utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'),
            'AAAAEEIOOOUUCNaaaaeeiooouucn')));
    }

    /**
     * Método responsável por realizar a exclusão do arquivo na pasta PUBLIC ou STORAGE especificada
     *
     * @param  string $file_path
     */
    public static function deleteFile($file_path) 
    {

        if (File::exists(public_path($file_path)))
        {
        
            unlink(public_path($file_path));
        
        }else{

            if (File::exists(storage_path($file_path)))
            {
                
                unlink(storage_path($file_path));

            }

        }
        
    }

    /**
     * Método responsável por mover um arquivo para outra pasta
     *
     * @param  String caminhoArquivo [SEM O NOME DO ARQUIVO]
     * @param  string $nomeDisk
     * @param  string $caminhoDestino  [SEM O NOME DO ARQUIVO]
     * @param  string $nomeArquivo
     * @return  string $caminhoArquivo     
     */
    public static function moveFile($caminhoArquivo, $nomeDisk, $caminhoDestino, $nomeArquivo) 
    {
        $caminho_disk = Storage::disk($nomeDisk)->getDriver()->getAdapter()->getPathPrefix();
        
        $directories = Storage::directories($caminho_disk . $caminhoDestino);
        
        if (count($directories) == 0){
            File::makeDirectory($caminho_disk . $caminhoDestino, 0777, true, true);
        }
        
        File::move($caminho_disk . $caminhoArquivo . $nomeArquivo, $caminho_disk . $caminhoDestino . $nomeArquivo);      

        return $caminhoDestino . $nomeArquivo;
    }

    /**
     * Método responsável por realizar o upload dos arquivos na pasta STORAGE
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $sistema
     * @param  string $pasta
     * @return string $nomeArquivo
     */
    public static function getNomeOriginalArquivo(UploadedFile $file)
    {

        return $file->getClientOriginalName();

    }

    /**
     * Método responsável por gerar ID dinâmico
     *
     * @return uniqueID
     */
    private static function generateID()
    {
        return uniqid();    
    }
    
}
