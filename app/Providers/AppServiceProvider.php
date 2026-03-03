<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

use Illuminate\Support\ServiceProvider;

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
    /*public function boot(): void
    {
        //
Relation::enforceMorphMap([
        'admin' => 'App\Models\Admins',
        'officer' => 'App\Models\Officer',
        'borrower' => 'App\Models\Borrower',
    ]);
    }*/

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        date_default_timezone_set('Asia/Jakarta');

        if (env('APP_ENV') !== 'local' || isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
        URL::forceScheme('https');
    }
    }
}
