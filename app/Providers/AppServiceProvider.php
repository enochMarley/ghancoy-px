<?php

namespace App\Providers;

use App\Models\Personnel;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\User;
use App\Observers\PersonnelObserver;
use App\Observers\SaleObserver;
use App\Observers\StockObserver;
use App\Observers\UserObserver;
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
    public function boot(): void
    {
        // register observers
        User::observe(UserObserver::class);
        Personnel::observe(PersonnelObserver::class);
        Sale::observe(SaleObserver::class);
        Stock::observe(StockObserver::class);
    }
}
