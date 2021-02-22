<?php


namespace SoleX\Auth\Models;


use Illuminate\Database\Eloquent\Model;

class UserBlack extends Model
{
    protected $table = 'user_black';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}