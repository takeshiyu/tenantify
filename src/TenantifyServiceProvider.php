<?php

namespace Wuhsien\Tenantify;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Wuhsien\Tenantify\Middleware\ResolveTenant;

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

        $this->registerRouteMacro();
    }

    protected function registerRouteMacro()
    {
        Route::macro('tenancy', function ($groups) {
            Route::domain(sprintf('{tenant}.%s', Config::get('tenantify.tenant_domain')))
                ->middleware([
                    ResolveTenant::class,
                ])
                ->group($groups);
        });

        Route::model('tenant', Config::get('tenantify.tenant_model'));
    }
}
