<?php

namespace App\Listeners;

use App\Events\GameCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AdjustRanksAfterGameCompletion
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
            if ($user->hasRank) {
                $user->adjustRanks();
            }
        }
    }
}
