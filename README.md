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

## Notifications

In your code you should type-hint to `Datana\Mandantencockpit\Api\AktenApiInterface`

### Notify Dateneingabe

```php
use Datana\Mandantencockpit\Api\NotificationsApi;
use Datana\Mandantencockpit\Api\MandantencockpitClient;

$client = new MandantencockpitClient(/* ... */);

$notificationsApi = new NotificationsApi($client);
$response = $notificationsApi->notifyDateneingabe(/* ... */);
```

### Remind Dateneingabe

```php
use Datana\Mandantencockpit\Api\NotificationsApi;
use Datana\Mandantencockpit\Api\MandantencockpitClient;

$client = new MandantencockpitClient(/* ... */);

$notificationsApi = new NotificationsApi($client);
$response = $notificationsApi->remindDateneingabe(/* ... */);
```

[build-status-master-php]: https://github.com/datana-gmbh/mandantencockpit-api/workflows/PHP/badge.svg?branch=master
[coverage-status-master]: https://codecov.io/gh/datana-gmbh/mandantencockpit-api/branch/master/graph/badge.svg

[actions]: https://github.com/datana-gmbh/mandantencockpit-api/actions
[codecov]: https://codecov.io/gh/datana-gmbh/mandantencockpit-api
