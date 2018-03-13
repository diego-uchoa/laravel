<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use MaskHelper;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Auth\PasswordBrokerPortal;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Método sobrescrito responsável por enviar o link para resetar a senha ao usuário
     *
     * @param  array  $credentials
     * @return string
     */

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['nr_cpf' => 'required|cpf|max:14']);

        $usuario['nr_cpf'] = MaskHelper::removeMascaraCpf($request['nr_cpf']);
        
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $usuario
        );
        
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

}
