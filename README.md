# CSVToRedirects

CSVToRedirects is a PHP library used to create redirects from CSV file, and compatible with PHP **7.4**.

It allows the creation of hundreds of redirects with ease using CSV files.

You must use Composer to install this library.

## Requirements

CSVToRedirects works with PHP >7 and Composer.

## Installation

Installation is easy using Composer. Just run the following on the
command line:
```
composer require alisal1992/csvtoredirects
```

If you don't use a framework such as Drupal, Laravel, Symfony, Yii etc.,
you may have to manually include Composer's autoloader file in your PHP
script:
```php
require_once __DIR__ . 'vendor/autoload.php';
```

## Example Usage

```php
use AliSal\Csvtoredirects;
$redirects = new Csvtoredirects('redirects.csv');
$redirects->start();
```

redirects.csv content:

| from  | to | operator | type |
| --- | --- | --- | --- |
| https://www.mywebsite.com | https://www.myotherwebsite.com | = | 302 |
| mywebsite.com/somepage/ | https://www.myotherwebsite.com/somepage/  | contains | 301 |
| mywebsite.com/somepage/index.php | https://www.myotherwebsite.com/somepage/index.php | contains | 301 |

if the current URL matches any redirect in the csv, the redirect will start. 

## Help & Support

For questions and bug reports, please use the GitHub issues page.

## License

This program is distributed under the OSL License. For more information see the [./LICENSE.md](./LICENSE.md) file.

Copyright 2021 by Ali Alsalti
