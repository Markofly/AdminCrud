# AdminCrud
Laravel crud

## Installation

Using composer

```bash
$ composer require markofly/admincrud
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

## Samples

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
