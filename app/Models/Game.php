<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

    private const ELO_FACTOR = 10;

    protected $fillable = [
        'map',
        'winner_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->using(GameUser::class)
            ->withPivot(GameUser::FIELDS)
            ->withTimestamps();
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id', 'id');
    }

    public function getHasWinnerAttribute(): bool
    {
        return $this->winner_id ? true : false;
    }

    /**
     * Calculates the probability of a player winning.
     */
    private function getProbability(int $rating1, int $rating2): float
    {
        return 1.0 / (1 + pow(10, ($rating1 - $rating2) / 400));
    }

    /**
     * Calculates and updates userA and userB's ELO rating.
     */
    public function UpdateUserElo()
    {
        // Currently this function accepts only two users as arguments and a winning
        // indication factor. This function can be extended to accept more than two
        // and handle the deciding which player won and which lost.

        // If there is no winner, do nothing
        if (!$this->getHasWinnerAttribute()) {
            return;
        }

        $winner = $this->winner();
        $users = $this->users();

        $userA = null;
        $userB = null;

        foreach ($users as $user) {
            if ($userA === null) {
                $userA = $user;
            } else {
                $userB = $user;
            }
        }

        // Get each user's ELO rating
        $userAElo = $userA->elo;
        $userBElo = $userB->elo;

        // Calculate the probability of winning for each user
        $winProbabilityForB = $this::getProbability($userAElo, $userBElo);
        $winProbabilityForA = $this::getProbability($userBElo, $userAElo);

        // Calculate the final ELO rating
        if ($winner == $userA) {
            $userA->addElo($this::ELO_FACTOR * (1 - $winProbabilityForA));
            $userB->removeElo($this::ELO_FACTOR * (0 - $winProbabilityForB));
        } else {
            $userB->addElo($this::ELO_FACTOR * (1 - $winProbabilityForB));
            $userA->removeElo($this::ELO_FACTOR * (0 - $winProbabilityForA));
        }
    }
}
