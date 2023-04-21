<?php

namespace Wuhsien\Tenantify;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Wuhsien\Tenantify\Exceptions\TenancyNotInitializedException;

class TenancyManager
{
    /**
     * Create a new session table command instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @param  array  $config
     * @param  \Illuminate\Database\Eloquent\Model|null  $tenant
     *
     * @return void
     */
    public function __construct(
        protected Application $app,
        protected array $config,
        protected ?Model $tenant = null
    ){}

    /**
     * Resolve the tenant via request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function resolve(Request $request): void
    {
        $currentTenant = $request->tenant;

        $this->tenant = $currentTenant;
    }

    /**
     * Get the ID for the currently tenant.
     *
     * @return int
     */
    public function id(): int
    {
        return $this->tenant()->id;
    }

    /**
     * Get the slug for the currently tenant.
     *
     * @return string
     */
    public function slug(): string
    {
        $attribute = $this->config['tenant_slug'];

        return $this->tenant->$attribute;
    }

    /**
     * Get the currently resolved tenant.
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Wuhsien\Tenantify\Exceptions\TenancyNotInitializedException
     */
    public function tenant(): Model
    {
        if (!$this->tenant) {
            throw new TenancyNotInitializedException;
        }

        return $this->tenant;
    }
}