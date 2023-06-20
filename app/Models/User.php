<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
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

    public function addElo(int $addElo): void
    {
        $this->changeElo($addElo);
    }

    public function removeElo(int $removeElo): void
    {
        $this->changeElo(-$removeElo);
    }

    private function changeElo(int $newElo): void
    {
        $oldElo = $this->elo;
        $this->elo = $oldElo + $newElo;

        $this->save();

        if ($this->hasRank)
            $this->adjustRanks($oldElo, $newElo);
    }

    /**
     * Adjust ranks based on Elo score.
     *
     * @param int $oldElo
     * @param int $newElo
     * @return void
     */
    private function adjustRanks(int $oldElo, int $newElo): void
    {
        // Determine the ELO range for updates
        $startElo = min($oldElo, $newElo);
        $endElo = max($oldElo, $newElo);

        // Get all users within the desired rank range
        $usersToUpdate = self::whereBetween('elo', [$startElo, $endElo])->get();

        // Extract the user IDs to be updated
        $userIdsToUpdate = $usersToUpdate->pluck('id')->toArray();

        // Increment or decrement the ranks of users within the desired rank range
        if ($newElo > $oldElo) {
            self::whereIn('id', $userIdsToUpdate)->update(['rank' => DB::raw('rank + 1')]);

            // Set the current user's rank to the highest rank among those who just got pushed down
            $highestRank = $usersToUpdate->min('rank');
            $this->rank = $highestRank;
        } elseif ($newElo < $oldElo) {
            self::whereIn('id', $userIdsToUpdate)->update(['rank' => DB::raw('rank - 1')]);

            // Set the current user's rank to the lowest rank among those who just got pushed up
            $lowestRank = $usersToUpdate->max('rank');
            $this->rank = $lowestRank;
        }

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
     * Search for users based on a given search term.
     *
     * @param string|null $search The search term.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function search(?string $search)
    {
        return empty($search) ? static::query()
            : static::query()->whereLike(['nickname'], $search);
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
