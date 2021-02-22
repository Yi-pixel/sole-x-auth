<?php


namespace SoleX\Auth;


use SoleX\Auth\Models\User;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        Auth::provider('blog_eloquent', function ($app, $config) {
            return $this->app->make(UserProvider::class, [
                'model' => $config['model'],
            ]);
        });
    }

    public function provides()
    {
        return ['auth'];
    }

    public function boot()
    {
        config([
            'auth.providers.users' => [
                'driver' => 'blog_eloquent',
                'model'  => User::class,
            ],
        ]);
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}