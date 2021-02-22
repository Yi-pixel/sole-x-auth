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
            if (app()->bound($userModel)) {
                $this->model = get_class(app($userModel));
                return parent::createModel();
            }
        }
        throw new InvalidArgumentException('User Model Not Found!');
    }
}