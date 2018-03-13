<?php
namespace App\Modules\Sishelp\Services;

use App\Modules\Sishelp\Models\AjudaArquivo;

use Illuminate\Http\Request;

use Storage;

class AjudaArquivoService {

    const PASTA_SISTEMA = '/Sishelp';

    public function addAjudaArquivo(Request $request) {
        if ($request->hasFile('file')) {

            $nomeArquivo = $request->file('file')->getClientOriginalName();

            $nomeArquivoFisico = time() . '.' . $request->file('file')->getClientOriginalExtension();

            $request->file('file')->move(public_path(). "/uploads". self::PASTA_SISTEMA , $nomeArquivoFisico);

            AjudaArquivo::create(array('id_sistema' => $request->get('id_sistema'), 'no_ajuda_arquivo' => $request->get('no_ajuda_arquivo'),'no_ajuda_arquivo_original' => $nomeArquivo,'no_ajuda_arquivo_fisico' => $nomeArquivoFisico));
        }
        else
            AjudaArquivo::create($request->all());
    }

    public function updateAjudaArquivo(Request $request, AjudaArquivo $arquivo)
    {
        if ($request->hasFile('file')) {

            $nomeArquivo = $request->file('file')->getClientOriginalName();

            $nomeArquivoFisico = time() . '.' . $request->file('file')->getClientOriginalExtension();

            $request->file('file')->move(public_path(). "/uploads". self::PASTA_SISTEMA, $nomeArquivoFisico);            
            
            $arquivo->update(array('id_sistema' => $request->get('id_sistema'), 'no_ajuda_arquivo' => $request->get('no_ajuda_arquivo'), 'no_ajuda_arquivo_original' => $nomeArquivo, 'no_ajuda_arquivo_fisico' => $nomeArquivoFisico));
        }
        else
            $arquivo->update($request->all());
    }

    public function getAjudaArquivo($arquivo){

        $ajudaArquivo = AjudaArquivo::where('no_ajuda_arquivo_original', '=', $arquivo)->firstOrFail();

        $file = Storage::disk('local')->get($ajudaArquivo->no_ajuda_arquivo_fisico);

        dd($file);
        /*
        return (new Response($file, 200))
        ->header('Content-Type', $ajudaArquivo->mime);
        */
    }
}