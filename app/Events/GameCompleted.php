<?php

namespace App\Events;

use App\Models\Game;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameCompleted
{
    use Dispatchable, SerializesModels;

    public $game;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->game = $game;
    }
}
