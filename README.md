# Tenantify

<a href="https://github.com/takeshiyu/tenantify/actions"><img alt="GitHub Workflow Status" src="https://img.shields.io/github/actions/workflow/status/takeshiyu/tenantify/test.yml"></a>
<a href="https://packagist.org/packages/takeshiyu/tenantify"><img alt="Packagist License" src="https://img.shields.io/packagist/l/takeshiyu/tenantify?style=flat-square"></a>
<a href="https://packagist.org/packages/takeshiyu/tenantify"><img alt="Latest Version" src="https://img.shields.io/packagist/v/takeshiyu/tenantify?style=flat-square"></a>
<a href="https://packagist.org/packages/takeshiyu/tenantify"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/takeshiyu/tenantify?style=flat-square"></a>

**Tenantify** is a Laravel package designed to make implementing a multi-tenancy architecture easy and efficient. With **Tenantify**, you can quickly set up your application to support multiple tenants using a **single database**, with each tenant being identified by a **unique subdomain**.

### Features

* Automatic subdomain detection and tenant resolution
* Subdomain-based routing with Laravel route macro
* Tenant-aware query scopes
* Middleware for tenant context and data isolation

### Installation

To install **Tenantify**, follow these simple steps:

1. Install the package via Composer:

```bash
composer require takeshiyu/tenantify
```

2. Publish the configuration file and model:

```bash
php artisan vendor:publish --provider="TakeshiYu\Tenantify\TenantifyServiceProvider"
```

### Configuration

After installing **Tenantify**, you can configure it according to your application's requirements. Open the `config/tenantify.php` file and adjust the settings as needed:

```php
return [
    'tenant_domain' => 'tenantify.test',
    'tenant_model' => App\Models\Tenant::class,
    'tenant_column' => 'slug',
    'tenant_key' => 'tenant_id',
];
```

### Custom Model

If you want to use your custom model and use it for route binding, Make sure that your custom model use the `TakeshiYu\Tenantify\Concerns\Tenantable` trait:

```php
use TakeshiYu\Tenantify\Concerns\Tenantable;

class YourCustomModel extends Model
{
    use Tenantable;
}
```

### Query Scopes 

To scope your queries correctly, apply the `TakeshiYu\Tenantify\Concerns\HasTenancy` trait on your models:

```php
use TakeshiYu\Tenantify\Concerns\HasTenancy;

class YourModel extends Model
{
    use HasTenancy;
}
```

### Usage

In `routes/web.php` file, define your tenant-specific routes using the `tenancy` macro:

```php
Route::tenancy(function () {
    // your tenant routes here ...
});
```

or, assign `TakeshiYu\Tenantify\Middleware\ResolveTenant` middleware to your routes or groups:

```php
Route::get('/', fn () => 'ok')->middleware('tenantify.resolve');
```

### Current Tenant

There are several methods available to work with current tenant:

```php
use TakeshiYu\Tenantify\Tenancy;

Tenancy::tenant();  // returns current tenant instance
Tenancy::id();      // returns current tenant id
Tenancy::slug();    // returns current tenant slug
```

If no tenant is found, it will throw the `TenancyNotInitializedException`.

### Testing 

You can run the package's tests:

```bash
composer test
```

## License

Tenantify is open-sourced software licensed under the [MIT license](LICENSE.md).
