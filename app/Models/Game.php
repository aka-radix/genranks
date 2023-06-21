<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    use HasFactory;

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
}
