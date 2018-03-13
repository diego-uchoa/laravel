<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        if($request->input('_token')) {
            if ( \Session::token() != $request->input('_token')) {
                \Log::error("Token expirado. Redirecionando para tela de login.");
                return redirect()->guest('/');
            }
        }

        return parent::handle($request, $next);
    }
}
