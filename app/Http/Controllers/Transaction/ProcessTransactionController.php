<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\User;

class ProcessTransactionController extends Controller
{
    public function __invoke(TransactionRequest $request)
    {
        $transactionData = $request->validated();

        $user = User::find($transactionData['user_id']);

        $transaction = $user->makeBet($transactionData);

        return $this->success([
            'status' => 'success',
            'message' => 'Transaction processed successfully',
            'transaction_id' => $transaction->transaction_id,
            'user_balance' => $transaction->user->balance,
        ]);
    }
}
