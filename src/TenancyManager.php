<?php

namespace TakeshiYu\Tenantify;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use TakeshiYu\Tenantify\Exceptions\TenancyNotInitializedException;

class TenancyManager
{
    /**
     * Create a new manager instance.
     *
     * @return void
     */
    public function __construct(
        protected Application $app,
        protected array $config,
        protected ?Model $tenant = null
    ) {
    }

    /**
     * Resolve the tenant via request.
     */
    public function resolve(Request $request): void
    {
        $currentTenant = $request->tenant instanceof Model
            ? $request->tenant
            : $this->resolveTenantFromSubdomain($request);

        $this->tenant = $currentTenant;
    }

    /**
     * Get the ID for the currently tenant.
     */
    public function id(): int
    {
        return $this->tenant()->id;
    }

    /**
     * Get the slug for the currently tenant.
     */
    public function slug(): string
    {
        $attribute = $this->config['tenant_slug'];

        return $this->tenant->$attribute;
    }

    /**
     * Get the currently resolved tenant.
     *
     * @throws \Wuhsien\Tenantify\Exceptions\TenancyNotInitializedException
     */
    public function tenant(): Model
    {
        if (! $this->tenant) {
            throw new TenancyNotInitializedException;
        }

        return $this->tenant;
    }

    /**
     * Resolve tenat from subdomain
     */
    protected function resolveTenantFromSubdomain(Request $request): null|Model
    {
        $subdomain = explode('.', $request->getHost())[0];

        return $this->config['tenant_model']::where($this->config['tenant_slug'], $subdomain)->first();
    }
}
