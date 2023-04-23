<?php

use TakeshiYu\Tenantify\Exceptions\TenancyNotInitializedException;
use TakeshiYu\Tenantify\Tenancy;
use TakeshiYu\Tenantify\Tests\Models\TenantTest;

beforeEach(function () {
    Config::set('tenantify.tenant_model', TenantTest::class);
});

test('Tenancy is not initialized', function () {
    $this->get('http://tenantify.test');
    Tenancy::id();
})->throws(TenancyNotInitializedException::class);

test('Load the correct tenant data with tenancy macro', function () {
    $tenant = TenantTest::create(['slug' => 'foo']);

    $response = $this->get('http://'.$tenant->slug.'.tenantify.test');
    $response->assertSee('ok');

    $this->assertEquals($tenant->id, Tenancy::id());
    $this->assertEquals($tenant->slug, Tenancy::slug());
});

test('Load the correct tenant data without tenancy macro', function () {
    $tenant = TenantTest::create(['slug' => 'foo']);

    $response = $this->get('http://'.$tenant->slug.'.tenantify.test/home');
    $response->assertSee('ok');

    $this->assertEquals($tenant->id, Tenancy::id());
    $this->assertEquals($tenant->slug, Tenancy::slug());
});

test('Teannt not found when using tenancy macro', function () {
    $response = $this->get('http://foo.tenantify.test/home');
    $response->assertStatus(404);
});