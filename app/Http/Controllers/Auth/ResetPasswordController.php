<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Modules\Sisadm\Services\UserService;
use MaskHelper;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected $userService;
    protected $redirectTo = '/portal';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * Método sobrescrito responsável por retornar a View para resetar a senha
     *
     * Se nenhum token estiver presente, exibe o formulário de solicitação de link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $cpf = $this->_recuperaCpfPorToken($token);
        if ($cpf)
        {
            return view('auth.passwords.reset')->with(
                ['token' => $token, 'nr_cpf' => $cpf]
            );    
        }else{
            return view('auth.passwords.reset')->with(
                ['token' => $token]
            );    
        }
        
    }

    /**
     * Método responsável por recuperar o CPF associado ao Token
     *
     * @param String $token
     * @return String $cpf
     */
    private function _recuperaCpfPorToken($token)
    {
        $registro = DB::table('spoa_portal.password_resets')
                        ->where('token', '=', $token)
                        ->get();
        
        return sizeof($registro) > 0
                    ? $registro[0]->nr_cpf
                    : null;
    }

    /**
     * Método sobrescrito responsável validar as regras dos campos
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'nr_cpf' => 'required|cpf',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Método sobrescrito responsável por recuperar os campos do formulário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $registros = $request->only(
            'nr_cpf', 'password', 'password_confirmation', 'token'
        );

        $registros['nr_cpf'] = MaskHelper::removeMascaraCpf($request['nr_cpf']);
        return $registros;
    }

    /**
     * Método sobrescrito responsável por redirecionar para a página principal com a mensagem de alteração de senha
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
                            ->with('status_senha', trans($response));
    }

    

    /**
     * Método sobrescrito responsável por resetar a senha do usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(ResetPasswordRequest $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($response)
                    : $this->sendResetFailedResponse($request, $response);
    }
}
