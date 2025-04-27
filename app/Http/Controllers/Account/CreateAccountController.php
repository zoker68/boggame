<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class CreateAccountController extends Controller
{
    public function __invoke(CreateAccountRequest $request): UserResource
    {
        return new UserResource(User::create($this->prepareCreateAccountData($request)));
    }

    public function prepareCreateAccountData(CreateAccountRequest $request): array
    {
        $data = $request->validated();
        $data['balance'] = $data['initial_balance'];
        unset($data['initial_balance']);

        return $data;
    }
}
