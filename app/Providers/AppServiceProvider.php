<?php

namespace App\Providers;

use App\Services\Auth\LoginService;
use App\Services\Auth\RegistrationService;
use App\Services\Interfaces\Auth\LoginInterface;
use App\Services\Interfaces\Auth\RegistrationInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public array $bindings = [
        RegistrationInterface::class => RegistrationService::class,
        LoginInterface::class => LoginService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // TODO: или здесь привязку делать правильней?

//        $this->app->bind(RegistrationInterface::class, function () {
//            return new RegistrationService();
//        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
