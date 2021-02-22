<?php


namespace SoleX\Auth;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use SoleX\Auth\Models\User;

class UserProvider extends EloquentUserProvider
{
    public function updateRememberToken(UserContract $user, $token)
    {
    }

    public function retrieveByToken($identifier, $token)
    {
    }

    public function createModel()
    {
        return app(User::class);
    }


}