# Tenantify

**Tenantify** is a Laravel package designed to make implementing a multi-tenancy architecture easy and efficient. With **Tenantify**, you can quickly set up your application to support multiple tenants using a **single database**, with each tenant being identified by a **unique subdomain**.

### Features

* Automatic subdomain detection and tenant resolution
* Subdomain-based routing with Laravel route macro
* Tenant-aware database connection and query scopes
* Middleware for tenant context and data isolation

### Installation

To install **Tenantify**, follow these simple steps:

1. Install the package via Composer:

```bash
composer require wuhsien/tenantify
```

2. Publish the configuration file:

```bash
php artisan vendor:publish --provider="Wuhsien\Tenantify\TenantifyServiceProvider" --tag="config"
```

### Configuration

After installing **Tenantify**, you can configure it according to your application's requirements. Open the `config/tenantify.php` file and adjust the settings as needed:

```php
return [
    'tenant_domain' => 'tenantify.test',
    'tenant_model' => App\Models\Tenant::class,
    'tenant_column' => 'slug',
];
```

### Usage

In `routes/web.php` file, define your tenant-specific routes using the `tenancy` macro:

```php
Route::tenancy(function () {
    // your tenant routes here ...
});
```

## License

Tenantify is open-sourced software licensed under the [MIT license](LICENSE.md).
