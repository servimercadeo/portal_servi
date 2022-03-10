<?php

namespace App\Listeners;

use App\Events\loguinEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;


class lastLoguinListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\loguinEvent  $event
     * @return void
     */
    public function handle(loguinEvent $event)
    {
        $user = User::find($event->user_id, ['id', 'last_loguin']);
        $user->last_loguin = $event->time;
        $user->save();
    }
}
