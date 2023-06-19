<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $gamesPlayedThreshold = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rank',
        'elo',
    ];

    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($user) {
            // Get the user with the highest rank
            $userWithHighestRank = self::orderByDesc('rank')->first();
    
            // Determine the new rank for the user being created
            $newRank = $userWithHighestRank ? $userWithHighestRank->rank + 1 : 1;
    
            // Set the new rank for the user being created
            $user->rank = $newRank;
        });
    }

    /**
     * Adjust ranks based on Elo score.
     *
     * @return void
     */
    public function adjustRanks(): void
    {
        // Retrieve the current user's Elo score
        $userElo = $this->elo;

        // Find the Elo score of the user with the lowest rank among those who just finished their games
        $lowestRankUserElo = self::where('games_played', '>=', $this->gamesPlayedThreshold)
            ->where('elo', '>', $userElo)
            ->min('elo');

        // Find all users with Elo scores below the lowestRankUserElo and increment their ranks
        self::where('elo', '<', $lowestRankUserElo)
            ->increment('rank');

        // Set the current user's rank to the rank of the player with the lowest rank among those who just got pushed down
        $this->ranks = self::where('elo', $lowestRankUserElo)->min('rank');
        $this->save();
    }

    /**
     * Determine if the user has achieved a rank.
     *
     * @return bool
     */
    public function getHasRankAttribute(): bool
    {
        return $this->games_played > $this->gamesPlayedThreshold;
    }
    
    /**
     * The games that belong to the user.
     */
    public function games()
    {
        return $this->belongsToMany(Game::class)
            ->using(GameUser::class)
            ->withPivot(GameUser::FIELDS)
            ->withTimestamps();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
