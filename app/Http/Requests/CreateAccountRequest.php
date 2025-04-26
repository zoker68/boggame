<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'initial_balance' => ['required', 'decimal:0,2', 'min:0'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
