<?php


namespace SoleX\Auth;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use SoleX\Auth\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        Auth::provider('blog_eloquent', function ($app, $config) {
            return $this->app->make(UserProvider::class, [
                'model' => $config['model'],
            ]);
        });
    }

    public function boot()
    {
        config([
            'auth.guards.blog'    => [
                'driver'   => 'session',
                'provider' => 'blog',
            ],
            'auth.providers.blog' => [
                'driver' => 'blog_eloquent',
                'model'  => User::class,
            ],
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}