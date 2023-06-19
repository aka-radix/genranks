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
        $users = $event->game->users;

        // Update the user's ELO score
        // Perform the necessary logic to update the ELO based on the completed game
        // ...

        // Save the updated ELO score
    }
}
