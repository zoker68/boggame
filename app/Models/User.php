<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Exceptions\NotEnoughBalanceException;
use App\Exceptions\TransactionDuplicateException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'balance',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function makeBet(array $transactionData): Transaction
    {
        $this->hasEnoughBalance($transactionData['bet_amount']);

        \DB::beginTransaction();

        try {
            sleep(1);

            $this->decreaseBalance($transactionData['bet_amount']);

            $transaction = Transaction::create($transactionData);
            \DB::commit();

        } catch (UniqueConstraintViolationException $e) {
            \DB::rollBack();
            throw new TransactionDuplicateException($transactionData['transaction_id']);
        }

        return $transaction;
    }

    public function hasEnoughBalance(float $bet_amount): void
    {
        if ($this->balance < $bet_amount) {
            throw new NotEnoughBalanceException;
        }
    }

    public function decreaseBalance($bet_amount): void
    {
        try {
            $this->decrement('balance', $bet_amount);
        } catch (QueryException $e) {
            throw new NotEnoughBalanceException;
        }
    }
}
