<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
// use Telegram\Bot\Api;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('UserService', function ($app) {
            return new UserService();
        });
    }
}
