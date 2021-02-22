<?php


namespace SoleX\Auth\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Carbon;

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{

    use Authorizable;
    use Authenticatable;

    protected $table = 'users';

    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function social(): HasMany
    {
        return $this->hasMany(UserSocial::class);
    }

    public function blackList(): HasMany
    {
        return $this->hasMany(UserBlack::class)->where('locked_at', '>', Carbon::now());
    }
}