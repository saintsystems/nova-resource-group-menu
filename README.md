# Nova Resource Group Menu

[![Latest Version on Packagist](https://img.shields.io/packagist/v/saintsystems/nova-resource-group-menu.svg?style=flat-square)](https://packagist.org/packages/saintsystems/nova-resource-group-menu)
[![Total Downloads](https://img.shields.io/packagist/dt/saintsystems/nova-resource-group-menu.svg?style=flat-square)](https://packagist.org/packages/saintsystems/nova-resource-group-menu)

Give large resource groups their own menu pages with sub-groups.

![screenshot](screenshot.png)

![screenshot-2](screenshot-2.png)

## Installation

You can install the package in to a Laravel app that uses [Nova](https://nova.laravel.com) via composer:

```bash
composer require saintsystems/nova-resource-group-menu
```

## Usage

To enable resource group menu pages add the `DisplaysInResourceGroupMenu` trait to your base Nova `Resource`.
```php
// in your app/Nova/Resource.php class
use SaintSystems\Nova\ResourceGroupMenu\DisplaysInResourceGroupMenu;

abstract class Resource extends NovaResource
{
    use DisplaysInResourceGroupMenu;

    //... Removed for brevity

}

```
Then, within your Nova Resources that you want to group and place on their own resource group menu page, ensure the following:

1. Set `$displayInNavigation` to `false`:
```php
// in your Nova Resource classes
public static $displayInNavigation = false;
```

2. Define a group for the resource:
```php
// in your Nova Resource classes
public static $group = 'Master Data';
```
3. Define a sub-group for the resource:
```php
// in your Nova Resource classes
public static $subGroup = 'Vendors';
```

Finally, register the tool in your `NovaServiceProvider` like so:
```php
    use SaintSystems\Nova\ResourceGroupMenu\ResourceGroupMenu;

    /**
    * Get the tools that should be listed in the Nova sidebar.
    *
    * @return array
    */
    public function tools()
    {
        return [
            new ResourceGroupMenu
        ];
    }
```

Optionally, define custom icons to use for each Resource Menu Group

```php
/**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            (new ResourceGroupMenu)->withMeta([
                'group_icons' => [
                    'admin' => '<svg class="sidebar-icon" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="icon-shape"><path fill="var(--sidebar-icon)" d="M11,14.7324356 C11.5978014,14.3866262 12,13.7402824 12,13 C12,11.8954305 11.1045695,11 10,11 C8.8954305,11 8,11.8954305 8,13 C8,13.7402824 8.40219863,14.3866262 9,14.7324356 L9,17 L11,17 L11,14.7324356 Z M13,6 C13,4.34314575 11.6568542,3 10,3 C8.34314575,3 7,4.34314575 7,6 L7,8 L13,8 L13,6 Z M4,8 L4,6 C4,2.6862915 6.6862915,0 10,0 C13.3137085,0 16,2.6862915 16,6 L16,8 L17.0049107,8 C18.1067681,8 19,8.90195036 19,10.0085302 L19,17.9914698 C19,19.1007504 18.1073772,20 17.0049107,20 L2.99508929,20 C1.8932319,20 1,19.0980496 1,17.9914698 L1,10.0085302 C1,8.8992496 1.8926228,8 2.99508929,8 L4,8 Z" id="Combined-Shape"></path></g></g></svg>',
                    'master-data' => '<svg class="sidebar-icon" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="icon-shape"><path fill="var(--sidebar-icon)" d="M10,1 L20,7 L10,13 L0,7 L10,1 Z M16.6666667,11 L20,13 L10,19 L0,13 L3.33333333,11 L10,15 L16.6666667,11 Z" id="Combined-Shape"></path></g></g></svg>',
                    'reports' => '<svg class="sidebar-icon" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="icon-shape"><path fill="var(--sidebar-icon)" d="M19.9506248,11 C19.4489003,16.0533227 15.1853481,20 10,20 C4.4771525,20 0,15.5228475 0,10 C0,4.8146519 3.94667731,0.551099672 9,0.0493752426 L9,11 L19.9506248,11 L19.9506248,11 Z M19.8726884,8.4 C19.1906421,4.15869069 15.8413093,0.809357943 11.6,0.127311599 L11.6,8.4 L19.8726884,8.4 Z" id="Combined-Shape"></path></g></g></svg>',
                ],
            ]),
        ];
    }
```

You can define customize the subGroup width too, by setting the tool width:

```php
/**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            (new ResourceGroupMenu)->width('1/4'),
        ];
    }
```

## Credits

- [Adam Anderly](https://github.com/anderly)
- [Saint Systems](https://github.com/saintsystems)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
