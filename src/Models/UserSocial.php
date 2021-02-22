<?php


namespace SoleX\Auth\Models;


use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    protected $table = 'user_social';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}