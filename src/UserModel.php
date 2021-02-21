<?php


namespace SoleX\Auth;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class UserModel extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{

    use Authorizable;
    use Authenticatable;

    protected $table = 'user';

}