<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Models\User;

class CreateAccountController extends Controller
{
    public function __invoke(CreateAccountRequest $request)
    {
        $user = User::create($this->prepareCreateAccountData($request));

    }

    public function prepareCreateAccountData(CreateAccountRequest $request): mixed
    {
        $data = $request->validated();
        $data['balance'] = $data['initial_balance'];
        unset($data['initial_balance']);

        return $data;
    }
}
