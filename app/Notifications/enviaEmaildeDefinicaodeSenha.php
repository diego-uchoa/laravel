<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class enviaEmaildeDefinicaodeSenha extends Notification
{
    use Queueable;

    protected $usuario;
    protected $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $usuario)
    {
        $this->usuario = $usuario; 
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Verifica se o usuário solicitante é cadastrado no LDAP, caso seja, a mensagem será outra, visto que não é possível alterar a senha do usuário LDAP
        if (!$this->usuario->sn_ldap){
            return (new MailMessage)
                        ->subject('Portal de Sistemas - Redefinição de Senha')
                        ->greeting('Olá '. $this->usuario->no_usuario .',')
                        ->line('Você está recebendo esse email porque houve um pedido de redefinição de senha para a sua conta.')
                        ->action('Resetar senha', url('password/reset', $this->token))
                        ->line('Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.');
        }else{
            return (new MailMessage)
                        ->error()
                        ->subject('Portal de Sistemas - Redefinição de Senha')
                        ->greeting('Olá '. $this->usuario->no_usuario .',')
                        ->line('Você está recebendo esse email porque houve um pedido de redefinição de senha para a sua conta.')
                        ->line('Para realizar a alteração de senha, favor abrir uma demanda no serviço "Suporte Técnico" :: "Troca de Senha".')
                        ->line('Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
