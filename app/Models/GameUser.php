<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GameUser extends Pivot
{
    protected $table = 'game_user';

    protected $fillable = [
        'game_id',
        'user_id',
        'additional_data',
    ];

    protected $casts = [
        'additional_data' => 'json',
    ];

    public const FIELDS = 'additional_data';

    /**
     * Get the game associated with the game-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Get the user associated with the game-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
