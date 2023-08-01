<?php

namespace App\Providers;

use App\Services\ApiService;
use App\Services\TotalBalanceService;
use App\Services\TransactionPaginateService;
use App\Services\TransferService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind('apiService', ApiService::class);
        $this->app->bind('totalBalance', TotalBalanceService::class);
        $this->app->bind('paginateTransaction', TransactionPaginateService::class);
        $this->app->bind('transferService', TransferService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
