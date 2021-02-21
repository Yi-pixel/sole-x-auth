<?php


namespace SoleX\Auth;


use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;

class UserModel implements \Illuminate\Contracts\Auth\Access\Authorizable
{

    use Authorizable;
    use Authenticatable;

    protected $table = 'user';

}