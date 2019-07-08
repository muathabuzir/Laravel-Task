<?php

namespace App\Providers;

use App\Services\Google;
use Illuminate\Support\ServiceProvider;

class sp_mawdoo3_laravel extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton(Google::class, function () {
            return new Google(config('services.sp_mawdoo3_laravel'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }

}
