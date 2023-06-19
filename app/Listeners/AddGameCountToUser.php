<?php

namespace App\Listeners;

use App\Events\GameCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddGameCountToUser
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
        $users = $event->game->users;
        foreach ($users as $user) {
            // Update the user's game played count
            $user->games_played++;
    
            // Save the updated game played count
            $user->save();
        }
    }
}
