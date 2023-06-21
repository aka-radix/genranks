<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const GAMESPLAYEDTHREASHOLD = 10;

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

            // Check if generated user to put them correctly on the ranks
            if ($user->hasRank) {
                $curElo = (int)$user->elo;
                $user->elo = 1500;
                if ($curElo > 1500) {
                    $user->addElo($curElo - 1500, true);
                } elseif ($curElo <= 1500) {
                    $user->removeElo(1500 - $curElo, true);
                }
            }
        });
    }

    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExcludeUnranked($query)
    {
        return $query->where('games_played', '>', static::GAMESPLAYEDTHREASHOLD);
    }

    public function addElo(int $addElo, bool $newUser = false): void
    {
        $this->changeElo($addElo, $newUser);
    }

    public function removeElo(int $removeElo, bool $newUser = false): void
    {
        $this->changeElo(-$removeElo, $newUser);
    }

    private function changeElo(int $newElo, bool $newUser): void
    {
        $oldElo = $this->elo;
        $this->elo = $oldElo + $newElo;

        if ($newUser) {
            $this->newUserRank();
        } else {
            $this->save();

            if ($this->hasRank) {
                $this->adjustRanks($oldElo, $this->elo);
            }
        }
    }

    private function newUserRank(): void
    {
        // Retrieve the current user's Elo score
        $userElo = $this->elo;

        // Find the Elo score of the user with the lowest rank among those who just finished their games
        $lowestRankUserElo = self::excludeUnranked()->min('elo');

        if(!$lowestRankUserElo) {
            $this->rank = 1;
            return;
        } elseif ($lowestRankUserElo > $userElo) {
            $this->rank = self::excludeUnranked()->max('rank') + 1;
            return;
        }

        // Find all users with Elo scores below the user elo and increment their ranks
        self::excludeUnranked()
            ->where('elo', '<=', $userElo)
            ->increment('rank');

        // Set the current user's rank to the rank of the player with the lowest rank among those who just got pushed down
        $this->rank = self::excludeUnranked()
            ->where('elo', '<=', $userElo)
            ->min('rank') - 1;
    }

    /**
     * Adjust ranks based on Elo score.
     */
    private function adjustRanks(int $oldElo, int $newElo): void
    {
        // Determine the ELO range for updates
        $startElo = min($oldElo, $newElo);
        $endElo = max($oldElo, $newElo);

        // Get all users within the desired rank range
        $usersToUpdate = self::whereBetween('elo', [$startElo, $endElo])
            ->excludeUnranked()
            ->whereNot('id', $this->id)
            ->get();

        dump($oldElo, $newElo, $startElo, $endElo, $usersToUpdate->pluck('nickname'));

        // Extract the user IDs to be updated
        $userIdsToUpdate = $usersToUpdate->pluck('id')->toArray();

        // Increment or decrement the ranks of users within the desired rank range
        if (!$userIdsToUpdate) {
            dump('No rank change!');
        } elseif ($newElo > $oldElo) {
            // Set the current user's rank to the highest rank among those who just got pushed down
            self::whereIn('id', $userIdsToUpdate)->increment('rank');
            $this->rank = $this->rank - count($userIdsToUpdate);
        } elseif ($newElo < $oldElo) {
            // Set the current user's rank to the lowest rank among those who just got pushed up
            self::whereIn('id', $userIdsToUpdate)->decrement('rank');
            $this->rank = $this->rank + count($userIdsToUpdate);
        }

        $this->save();
    }

    public function route()
    {
        return route('profile.show', ['user' => $this]);
    }

    /**
     * Determine if the user has achieved a rank.
     */
    public function getHasRankAttribute(): bool
    {
        return $this->games_played > $this::GAMESPLAYEDTHREASHOLD;
    }

    /**
     * Search for users based on a given search term.
     *
     * @param  string|null  $search The search term.
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
