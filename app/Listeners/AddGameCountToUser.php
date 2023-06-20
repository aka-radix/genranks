<?php

namespace App\Listeners;

use App\Events\GameCompleted;
use App\Models\User;
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

        // Get the user IDs
        $userIds = $users->pluck('id')->toArray();
    
        // Increment the games played count for the selected users
        User::whereIn('id', $userIds)->increment('games_played');
    }
}
