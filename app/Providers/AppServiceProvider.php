<?php

namespace App\Providers;

use App\Models\ConsumableInbound;
use App\Models\ConsumableOutbound;
use App\Observers\ConsumableInboundObserver;
use App\Observers\ConsumableOutboundObserver;
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
        // Daftarkan observer untuk update stok otomatis.
        ConsumableInbound::observe(ConsumableInboundObserver::class);
        ConsumableOutbound::observe(ConsumableOutboundObserver::class);
    }
}
