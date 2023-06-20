<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Leaderboard extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.leaderboard', [
            'users' => User::search($this->search)
                ->excludeUnranked()
                ->orderBy('rank', 'asc')
                ->select('elo', 'rank', 'nickname', 'games_played')
                ->paginate(10),
        ]);
    }
}
