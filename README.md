# AdminCrud
[![Packagist](https://img.shields.io/packagist/v/markofly/admincrud.svg)](https://packagist.org/packages/markofly/admincrud)
[![Packagist](https://img.shields.io/packagist/dt/markofly/admincrud.svg)](https://packagist.org/packages/markofly/admincrud)
[![Packagist](https://img.shields.io/packagist/l/markofly/admincrud.svg)](http://choosealicense.com/licenses/mit)

AdminCrud is Laravel 5 package.

## Installation

Using composer

```bash
$ composer require markofly/admincrud "v0.0.2-alpha"
```

Add the service provider to `config/app.php`

```php
'providers' => [
  ...
  Markofly\AdminCrud\AdminCrudServiceProvider::class,
],
```

Publish config, view and form files

```bash
$ php artisan vendor:publish --provider="Markofly\AdminCrud\AdminCrudServiceProvider"
```

## Usage

### Set up Admin crud config

AdminCrud config file is located at `config/markofly/admincrud.php`

Default config looks like this:
```php
<?php

return [
    'path' => base_path('config/markofly/forms/'),
];
```

### Create form config file

Default form config files are located at `config/markofly/forms/`

```php
<?php
return [
    'model' => App\User::class, // Model class for forms
    'route_name' => 'users', // Resource route prefix
    'per_page' => 5, // Per page number for list view
    'create_form' => [...], // Create form fields
    'edit_form' => [...], // Edit form fields
    'list' => [...], // List view fields
];
```

#### Create form fields

```php
[
    'label' => 'Password', // Label for fields
    'type' => 'password', // Field type Currently available: text, password, textarea, checkbox, checkboxes, radio, select
    'multiple_data' => [ // Used only for radio, checkboxes, select
        [
            'label' => 'First label',
            'value' => 'first',
        ],
    ],    
    'name' => 'password', // Field name
    'database_field' => 'password', // false for non database field; Database field name
    'validation_rules' => 'required|min:6|confirmed', //Laravel validation rules
    'storing_method' => function($value) { return bcrypt($value); }, // null for storing same value; function for storing custom value
],
```

#### Edit form fields

```php
[
    'label' => 'Full name', // Label for fields
    'type' => 'text', // Field type Currently available: text, password, textarea, checkbox, checkboxes, radio, select
    'multiple_data' => [ // Used only for radio, checkboxes, select
        [
            'label' => 'First label',
            'value' => 'first',
        ],
    ], 
    'name' => 'name', // Field name
    'database_field' => 'name', // false for non database field; Database field name
    'validation_rules' => 'required', //Laravel validation rules
    'storing_method' => null, // null for storing same value; function for storing custom value
    'editable' => true // Is field disabled or not; Default value is true
],
```

#### List view fields

```php
[
    'label' => 'Full name', // Field label
    'database_field' => 'name', // Database field name
],
```

### Create controller for forms

```bash
$ php artisan make:controller UsersController
```

Basic AdminCrud controller should look something like this:
```php
<?php
namespace App\Http\Controllers;

use Markofly\AdminCrud\AdminCrud;
use Markofly\AdminCrud\AdminCrudTrait;

class UsersController extends Controller
{
    use AdminCrudTrait;

    public function initializeAdminCrud()
    {
        $this->adminCrud = new AdminCrud('users');
        $this->pageTitle = 'Users';
    }
}
```

### Register new routes for controller

```php
Route::resource('users', 'UsersController');
```

### Change default layout file

Default view file is located at `resources/views/vendor/AdminCrud/default.blade.php`

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
