---
layout: blog
title: "Eager loading roles with users in Spatie Laravel permissions"
date: 2023-05-11
thumbnail: "/assets/img/acl.png"
categories: laravel
---
> Error: Class name must be a valid object or a string in file ... HasRelationships.php

# TL;DR?
in `config/auth.php` add this to the `guards` array
```php
'sanctum' => [
  'driver' => 'sanctum',
  'provider' => 'users'
],
```
# Explanation
This error occurs when attempting to eager load roles with their assigned users from [Spatie's laravel-permissions](https://spatie.be/docs/laravel-permission/v5/introduction) library like this
```php
<?php

use Spatie\Permission\Models\Role;

Role::with('users')->get();
```
What can be more confusing is that this code works fine in the Laravel [PsySH](https://psysh.org/) powered Repl [Tinker](https://laravel.com/docs/artisan#tinker), see this [StackOverflow post](https://stackoverflow.com/q/66521909/5581565)

The problem is that if you're using the first party [Sanctum package](https://laravel.com/docs/sanctum), its service provider sets an authentication guard with a `null` value for the provider, [see source code here](https://github.com/laravel/sanctum/blob/3.x/src/SanctumServiceProvider.php#L26)

```php
class SanctumServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'auth.guards.sanctum' => array_merge([
                'driver' => 'sanctum',
                'provider' => null, // <=== This is the issue
            ], config('auth.guards.sanctum', [])),
        ]);

        if (! app()->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__.'/../config/sanctum.php', 'sanctum');
        }
    }
```
This causes Laravel-Permission's `getModelForGuard()` helper function [here](https://github.com/spatie/laravel-permission/blob/main/src/helpers.php#L7#L12)
```php
function getModelForGuard(string $guard)
{
    return collect(config('auth.guards'))
        ->map(fn ($guard) => isset($guard['provider']) ? config("auth.providers.{$guard['provider']}.model") : null)
        ->get($guard);
}
```
to return nothing when middleware requires the Sanctum guard to be authenticated, hence the eager load fails [here](https://github.com/spatie/laravel-permission/blob/main/src/Models/Role.php#L78)
```php
<?php
/**
 * A role belongs to some users of the model associated with its guard.
 */
public function users(): BelongsToMany
{
    return $this->morphedByMany(
        // Error occurs here
        getModelForGuard($this->attributes['guard_name'] ?? config('auth.defaults.guard')),
        'model',
        config('permission.table_names.model_has_roles'),
        app(PermissionRegistrar::class)->pivotRole,
        config('permission.column_names.model_morph_key')
    );
}
```
After manually inserting the guard in `auth/config.php` with a proper provider, eager loading works again
```php
'guards' => [
    ...

    'sanctum' => [
        'driver' => 'sanctum',
        'provider' => 'users'
    ]
],
```