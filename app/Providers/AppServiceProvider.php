<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('onlyOneUrl', function($attribute, $value, $parameters, $validator) {
            if (!(substr_count($value, "//") >=  2)) {
                return true;
            }
        }, 'Field accept only one URL');
    }
}
