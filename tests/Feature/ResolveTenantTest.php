<?php

use Tests\Models\TenantTest;
use Wuhsien\Tenantify\Exceptions\TenancyNotInitializedException;
use Wuhsien\Tenantify\Tenancy;

beforeEach(function () {
    Config::set('tenantify.tenant_model', TenantTest::class);
});

test('Tenancy is not initialized', function () {
    $this->get('http://tenantify.test');
    Tenancy::id();
})->throws(TenancyNotInitializedException::class);

test('Load the correct tenant data based on the subdomain', function () {
    $tenant = TenantTest::create(['slug' => 'foo']);

    $response = $this->get('http://'.$tenant->slug.'.tenantify.test');
    $response->assertSee('ok');

    $this->assertEquals($tenant->id, Tenancy::id());
    $this->assertEquals($tenant->slug, Tenancy::slug());
});
