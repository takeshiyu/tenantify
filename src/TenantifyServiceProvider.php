<?php

namespace Wuhsien\Tenantify;

use Illuminate\Support\ServiceProvider;

class TenantifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tenantify.php', 'tenantify');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/tenantify.php' => config_path('tenantify.php'),
        ], 'config');
    }
}
