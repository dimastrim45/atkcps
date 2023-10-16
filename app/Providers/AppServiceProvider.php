<?php

namespace App\Providers;
use App\Rules\NoSpaces;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator; // Import the Validator facade

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
        Paginator::useBootstrap();

        Validator::extend('no_spaces', function ($attribute, $value, $parameters, $validator) {
            return (new NoSpaces)->passes($attribute, $value);
        });

        Validator::extend('future_or_today', function ($attribute, $value, $parameters, $validator) {
            // Convert the input value to a Carbon date
            $date = \Carbon\Carbon::parse($value);
    
            // Check if the date is greater than or equal to today
            return $date >= \Carbon\Carbon::today();
        });
    }
}
