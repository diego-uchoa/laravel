<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use MaskHelper;
use App\Helpers\UtilHelper;

use App\Events\Auth\UserLoggedIn;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
    * Override the username method used to validate login
    *
    * @return string
    */
    public function username()
    {
        return 'nr_cpf';
    }

    protected function credentials(Request $request) {

        $request['nr_cpf'] = MaskHelper::removeMascaraCpf($request['nr_cpf']);

        return $request->only($this->username(), 'password');
    }

    protected function authenticated(Request $request, $user)
    {
        event(new UserLoggedIn($user));

        if ( $user->sn_externo ) {
            return redirect('prisma');
        }
        
    }

    public function logout(Request $request)
    {
        $user = UtilHelper::getUsuario();

        if ( $user->sn_externo ) {
            $redirect = '/prisma/login';
        }
        else{
            $redirect = '/'; 
        }
    
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect($redirect);

    }

}
