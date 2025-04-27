<?php

namespace App\Models;

use App\Enums\GameType;
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'bet_amount',
        'game_type',
        'status',
    ];

    protected $casts = [
        'bet_amount' => 'decimal:2',
        'game_type' => GameType::class,
        'status' => TransactionStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
