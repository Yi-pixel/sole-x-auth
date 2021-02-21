<?php


namespace SoleX\Auth;


use Illuminate\Support\Facades\Auth;

/**
 * Class BlogUser
 *
 * @package SoleX\Auth
 * @mixin Auth
 */
class BlogUser
{
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([Auth::guard('blog'), $name], $arguments);
    }
}