<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Leaderboard extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.leaderboard', [
            'leaderboard' => User::orderBy('rank', 'asc')
                ->select('elo', 'rank', 'nickname', 'games_played')
                ->paginate(10),
        ]);
    }
}
