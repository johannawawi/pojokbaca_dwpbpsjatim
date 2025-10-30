<?php

namespace App\Providers;

use Illuminate\pagination\paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('VERCEL', false)) {
            config([
                'logging.default' => 'stderr',   // log ke console, bukan file
                'cache.default' => 'array',      // cache tidak di file
                'session.driver' => 'array',     // session tidak di file
            ]);
        }
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
