<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Braintree\Gateway;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Gateway::class, function($app){
            return new Gateway(
                [
                    'environment' => 'sandbox',
                    'merchantId' => 'm6cftqk6gyd7gnfq',
                    'publicKey' => 'kbsstgtbzb95535x',
                    'privateKey' => '794c7c81220a1d5c8fd407bb1685a159'
                ]
            );
        });
    }
}
