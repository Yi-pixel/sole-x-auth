<?php


namespace SoleX\Auth;


use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use InvalidArgumentException;
use SoleX\Auth\Models\User as AuthUser;

class UserProvider extends EloquentUserProvider
{
    public const USER_MODELS = [AuthUser::class, User::class];

    public function createModel()
    {
        $userModels = self::USER_MODELS;
        foreach ($userModels as $userModel) {
            if (class_exists($userModel)) {
                return app($userModel);
            }
        }
        throw new InvalidArgumentException('User Model Not Found!');
    }
}