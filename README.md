# mandantencockpit-api

| Branch    | PHP                                         | Code Coverage                                        |
|-----------|---------------------------------------------|------------------------------------------------------|
| `master`  | [![PHP][build-status-master-php]][actions]  | [![Code Coverage][coverage-status-master]][codecov]  |

## Usage

### Installation

```bash
composer require datana-gmbh/mandantencockpit-api
```

### Setup

```php
use Datana\Mandantencockpit\Api\MandantencockpitClient;

$baseUri = 'https://....';
$secret = '...';

$client = new MandantencockpitClient($baseUri, $secret);
```

## Dateneingaben

In your code you should type-hint to `Datana\Mandantencockpit\Api\AktenApiInterface`

### Send Notification for Dateneingabe

Status Codes:
 * ``200``
 * ``201``
 * ``400``
 * ``500``

```php
use Datana\Mandantencockpit\Api\DateneingabenApi;
use Datana\Mandantencockpit\Api\MandantencockpitClient;

$client = new MandantencockpitClient(/* ... */);

$dateneingabenApi = new DateneingabenApi($client);
$response = $dateneingabenApi->sendNotificationForDateneingabe(/* ... */);
```

### Send Reminder for Dateneingabe

Status Codes:
 * ``200``
 * ``201``
 * ``400``
 * ``500``

```php
use Datana\Mandantencockpit\Api\DateneingabenApi;
use Datana\Mandantencockpit\Api\MandantencockpitClient;

$client = new MandantencockpitClient(/* ... */);

$dateneingabenApi = new DateneingabenApi($client);
$response = $dateneingabenApi->sendReminderForDateneingabe(/* ... */);
```

### Purge Dateneingaben Cache

Status Codes:
* ``200``
* ``201``

```php
use Datana\Mandantencockpit\Api\DateneingabenApi;
use Datana\Mandantencockpit\Api\MandantencockpitClient;

$client = new MandantencockpitClient(/* ... */);

$dateneingabenApi = new DateneingabenApi($client);
$dateneingabenApi->purgeCache();
```

[build-status-master-php]: https://github.com/datana-gmbh/mandantencockpit-api/workflows/PHP/badge.svg?branch=master
[coverage-status-master]: https://codecov.io/gh/datana-gmbh/mandantencockpit-api/branch/master/graph/badge.svg

[actions]: https://github.com/datana-gmbh/mandantencockpit-api/actions
[codecov]: https://codecov.io/gh/datana-gmbh/mandantencockpit-api
