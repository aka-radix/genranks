<?php

namespace App\Listeners;

use App\Events\GameCompleted;

class UpdateUserElo
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GameCompleted $event): void
    {
        $game = $event->game;

        $game->UpdateUserElo();
    }
}
