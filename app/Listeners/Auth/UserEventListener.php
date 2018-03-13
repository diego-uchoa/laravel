<?php

namespace App\Listeners\Auth;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @param $event
     */
    public function onLoggedIn($event)
    {
        \Log::info('Usuário logado: '.$event->user->no_usuario);
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Auth\UserLoggedIn::class,
            'App\Listeners\Auth\UserEventListener@onLoggedIn'
        );
        
    }
}
