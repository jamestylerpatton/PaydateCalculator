# Returns the specified number of paydates based on an initial paydate

## Installation

You can install the package via composer:

```bash
composer require devxyz/challenge
```

## Usage

``` php
$paydateCalulator = new PaydateCalculator('MONTHLY');
// Returns array of 10 next paydates after today
return $paydateCalulator->calculatePaydates(date('Y-m-d'), 10);
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jamestylerpatton@gmail.com instead of using the issue tracker.

## Credits

- [Tyler Patton](https://github.com/jamestylerpatton)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
