# Tenantify

`Tenantify` is a Laravel package designed to make implementing a multi-tenancy architecture easy and efficient. With `Tenantify`, you can quickly set up your application to support multiple tenants using a **single database**, with each tenant being identified by a **unique subdomain**.

### Features

* Automatic subdomain detection and tenant resolution
* Subdomain-based routing with Laravel route macro
* Tenant-aware database connection and query scopes
* Middleware for tenant context and data isolation

### Installation

To install `Tenantify`, follow these simple steps:

1. Install the package via Composer:

```bash
composer require wuhsien/tenantify
```

2. Publish the configuration file:

```bash
php artisan vendor:publish --provider="Wuhsien\Tenantify\TenantifyServiceProvider" --tag="config"
```

## License

Tenantify is open-sourced software licensed under the [MIT license](LICENSE.md).
