<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class CreateAccountController extends Controller
{
    public function __invoke(CreateAccountRequest $request): UserResource
    {
        $user = User::create($this->prepareCreateAccountData($request));

        return UserResource::make($user);
    }

    public function prepareCreateAccountData(CreateAccountRequest $request): array
    {
        $data = $request->validated();
        $data['balance'] = $data['initial_balance'];
        unset($data['initial_balance']);

        return $data;
    }
}
