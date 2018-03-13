<?php

namespace App\Helpers;
use Auth;
use Request;
use URL;
use Log;

class UtilHelper
{
    public static function getSistema()
    {
        if (Request::route()==null) {
            return "PORTAL";
        }

        //Retira a barra antes do sistema
        $sistema =  Request::route()->getPrefix();
        $sistema = strtoupper(ltrim($sistema, '/'));

        return $sistema;
    }

    public static function getSistemaModulo($sistema)
    {
        $modulo = strtolower($sistema);
        return $modulo;
    }

    public static function getSistemaRoute()
    {
        if (Request::route()==null) {
            return "portal";
        }

        $sistema =  Request::route()->getPrefix();
        $sistema = strtolower(ltrim($sistema, '/'));

        return $sistema;
    }

    public static function getUsuario()
    {
        $usuario =  Auth::user();
        
        return $usuario;
    }

    public static function getUsername()
    {
        $username = Auth::user()->nr_cpf;

        //Retira pontos e hifens
        $username = self::removeMascaraCpf($username);
        
        return $username;
    }

    static function get_string_between($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    static function getRotaBase() 
    {
        return URL::to('/');
    }

    static function inverteData($data)
    {
        if(count(explode("/",$data)) > 1){
            return implode("-",array_reverse(explode("/",$data)));
        }elseif(count(explode("-",$data)) > 1){
            return implode("/",array_reverse(explode("-",$data)));
        }
    }

    static function makeMessageLogError($message, $acao)
    {
        $retorno = [];
        $retorno["Usuário"] = Auth::user()->nr_cpf;
        $retorno["Ação"] = $acao;
        $retorno["Mensagem"] = $message;

        Log::error($retorno);
    }

    static function removeMascaraCpf($cpf)
    {
        $cpf = str_replace("." , "" , $cpf); // remove os pontos
        $cpf = str_replace("-" , "" , $cpf); // remove o hifen

        return $cpf;
    }
}
