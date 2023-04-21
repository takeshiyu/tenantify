<?php

namespace Wuhsien\Tenantify\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Wuhsien\Tenantify\Tenancy;

trait HasTenancy
{
    /**
     * Get the tenant that owns the resource.
     */
    public function tenant()
    {
        return $this->belongsTo(Config::get('tenantify.tenant_model'));
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootHasTenancy()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (! App::runningInConsole()) {
                return;
            }

            $builder->where(
                sprintf('%s.%s', Config::get('tenantify.tenant_model'), Config::get('tenantify.tenant_key')),
                Tenancy::id()
            );
        });

        static::creating(function ($model) {
            if (! App::runningInConsole()) {
                return;
            }

            if (! $model->{Config::get('tenantify.tenant_key')}) {
                $model->{Config::get('tenantify.tenant_key')} = Tenancy::id();
            }
        });
    }
}
