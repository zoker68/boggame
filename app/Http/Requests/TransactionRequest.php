<?php

namespace App\Http\Requests;

use App\Enums\GameType;
use App\Exceptions\TransactionDuplicateException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class TransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'transaction_id' => ['required', 'unique:transactions'],
            'user_id' => ['required', 'exists:users,id'],
            'bet_amount' => ['required', 'decimal:0,2', 'min:0'],
            'game_type' => ['required', Rule::enum(GameType::class)],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (isset($validator->failed()['transaction_id']['Unique'])) {
                    throw new TransactionDuplicateException($this->request->get('transaction_id'));
                }
            },
        ];
    }
}
