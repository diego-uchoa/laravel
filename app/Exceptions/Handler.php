<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
    \Illuminate\Auth\AuthenticationException::class,
    \Illuminate\Auth\Access\AuthorizationException::class,
    \Symfony\Component\HttpKernel\Exception\HttpException::class,
    \Illuminate\Database\Eloquent\ModelNotFoundException::class,
    \Illuminate\Session\TokenMismatchException::class,
    \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //Verificando se a requisição é AJAX para retornar um erro customizado
        if ($request->ajax())
        {
            try{
                $detalhes_mensagem = json_encode($exception->validator->errors()->getMessages());
                return response()->json(['success' => false, 'detail' => (string) $detalhes_mensagem], 422);  
            }catch(Exception $e){
                return response(['msg' => "Não foi possível realizar a operação.", 'detail' => $exception->getMessage(), 'status' => 'error']);
            }
        }

        //Verifica os demais erros
        if ($exception->getCode() == 403) {

           $messagesExceptions = [
           'exception' => 'Erro 403: ', 
           'message_exception' => 'Usuário não autorizado.'
           ];

           return redirect()->back()->with($messagesExceptions,403);

       }

       if ($exception->getCode() == 405) {
        $messagesExceptions = [
        'exception' => 'Erro 405: ', 
        'message_exception' => 'Não existe uma rota para o método HTTP solicitado.'
        ];
        
        return redirect()->back()->with($messagesExceptions,403);
        
    }

    if ($exception->getCode() == 503) {

        $messagesExceptions = [
        'exception' => 'Erro2: ', 
        'message_exception' => $exception->getMessage()
        ];

        return redirect()->back()->with($messagesExceptions,503);

    }

        /*************************************************************
        /* ERROS DE BANCO DE DADOS
        /*
        /*************************************************************/

        $verificaBD = self::verificaErroBancoDados($exception);

        if ($verificaBD) {

            //dd($exception);

            $messagesExceptions = [
            'exception' => $verificaBD, 
            'message_exception' => $exception->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions,500);

        }

        /*************************************************************
        /* FIM ERROS DE BANCO DE DADOS
        /*
        /*************************************************************/
        if ($exception instanceof ModelNotFoundException) {

            $messagesExceptions = [
            'exception' => 'ModelNotFoundException', 
            'message_exception' => $exception->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions,503);

        }

        if ($exception instanceof NotFoundHttpException) {

            $messagesExceptions = [
            'exception' => 'NotFoundHttpException', 
            'message_exception' => $exception->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions,503);

        }

        if ($exception instanceof FatalErrorException) {

            $messagesExceptions = [
            'exception' => 'FatalErrorException', 
            'message_exception' => $exception->getMessage()
            ];
            
            return redirect()->back()->with($messagesExceptions,503);

        }

        //return response()->view('errors.exception', ['exception'=>'Erro Desconhecido: ','message'=>'Teste'], 503);

        return parent::render($request, $exception);
        
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }



    public function verificaErroBancoDados(\Exception $exception)
    {

       switch ($exception->getCode()) {
           case '23502':
           return "ERROR_NOT_NULL";
           case '23503':
           return "ERROR_FOREIGN_KEY_CONSTRAINT";
           case '23505':
           return "ERROR_DUPLICATE_KEY";
           case '42601':
           return "ERROR_SYNTAX";
           case '42702':
           return "ERROR_NON_UNIQUE_FIELD_NAME";
           case '42703':
           return "ERROR_BAD_FIELD_NAME";
           case '42P01':
           return "ERROR_UNKNOWN_TABLE";
           case '42P07':
           return "ERROR_TABLE_ALREADY_EXISTS";
           case '7':
           // In some case (mainly connection errors) the PDO exception does not provide a SQLSTATE via its code.
           // The exception code is always set to 7 here.
           // We have to match against the SQLSTATE in the error message in these cases.
           if (strpos($exception->getMessage(), 'SQLSTATE[08006]') !== false) {
               return "ERROR_ACCESS_DENIED";
           }
           break;
       }
       return false;
   }
}
