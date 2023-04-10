<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUserOnOrderCreated
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
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->getOrder();
        $user = User::find($order->user->id);
        $user->notify(new \App\Notifications\OrderCreated($order));
    }
}
