# Get information on the position of the sun

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/sun.svg?style=flat-square)](https://packagist.org/packages/spatie/sun)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/spatie/sun/run-tests?label=tests)](https://github.com/spatie/sun/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/sun.svg?style=flat-square)](https://packagist.org/packages/spatie/sun)

This package can determine several things on the position of the sun.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/sun.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/sun)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/sun
```

## Usage

When instantiating `Spatie\Sun\Sun` you should pass it coordinates.

```php
$coordinatesOfAntwerp = ['lat' => 51.260197, 'lng' => 4.402771];

$sun = new Sun($coordinatesOfAntwerp['lat'], $coordinatesOfAntwerp['lng']);
```

### Get the time of sunrise

You can get the time of the sunrise.

```php
$sun->sunrise(); // returns an instance of \Carbon\Carbon
```

You can get the time of the sunrise on a specific date by passing in instance of `Carbon\Carbon` to `sunrise`

```php
$sun->sunrise($carbon); // returns an instance of \Carbon\Carbon
```

### Get the time of zenith

You can get the time of the zenith.

```php
$sun->zenith(); // returns an instance of \Carbon\Carbon
```

You can get the time of the zenith on a specific date by passing in instance of `Carbon\Carbon` to `zenith`

```php
$sun->zenith($carbon); // returns an instance of \Carbon\Carbon
```

### Get the time of sunset

You can get the time of the sunset.

```php
$sun->sunset(); // returns an instance of \Carbon\Carbon
```

You can get the time of the sunset on a specific date by passing in instance of `Carbon\Carbon` to `sunset`

```php
$sun->sunset($carbon); // returns an instance of \Carbon\Carbon
```

### Determine if the sun is up

This is how you can determine if the sun is up:

```php
$sun->sunIsUp(); // returns a boolean
```


You can get determine if the sun is up at a specific moment by passing in instance of `Carbon\Carbon` to `sunIsUp`

```php
$sun->sunIsUp($carbon); // returns a boolean
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
