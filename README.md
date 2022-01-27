# datapool-api

| Branch    | PHP                                         | Code Coverage                                        |
|-----------|---------------------------------------------|------------------------------------------------------|
| `master`  | [![PHP][build-status-master-php]][actions]  | [![Code Coverage][coverage-status-master]][codecov]  |

## Usage

### Installation

```bash
composer require datana-gmbh/datapool-api
```

### Setup
```php
use Datana\Datapool\Api\DatapoolClient;

$baseUri = 'https://....';
$username = '...';
$password = '...';

$client = new DatapoolClient($baseUri, $username, $password);

// you can now request any endpoint which needs authentication
$client->request('GET', '/api/something', $options);
```

## Akten

In your code you should type-hint to `Datana\Datapool\Api\AktenApiInterface`

### Search by string (`string`)

```php
use Datana\Datapool\Api\AktenApi;
use Datana\Datapool\Api\DatapoolClient;

$client = new DatapoolClient(/* ... */);

$aktenApi = new AktenApi($client);
$response = $aktenApi->search('MySearchTerm');
```

### Get by Aktenzeichen (`string`)

```php
use Datana\Datapool\Api\AktenApi;
use Datana\Datapool\Api\DatapoolClient;
use Datana\Datapool\Api\Domain\Value\DatapoolId;

$client = new DatapoolClient(/* ... */);

$aktenApi = new AktenApi($client);
$response = $aktenApi->getByAktenzeichen('9zku4b-4524-4528-Winter');

/*
 * to get the DatapoolId transform the response to array
 * and use the 'id' key.
 */
$akten = $response->toArray();
$datapoolId = DatapoolId::fromInt($akte['id']);
```

### Get one by Aktenzeichen (`string`) or get an exception

```php
use Datana\Datapool\Api\AktenApi;
use Datana\Datapool\Api\DatapoolClient;
use Datana\Datapool\Api\Domain\Value\DatapoolId;

$client = new DatapoolClient(/* ... */);

$aktenApi = new AktenApi($client);

// is an instance of AktenResponse
$result = $aktenApi->getOneByAktenzeichen('9zku4b-4524-4528-Winter');
/*
 * $response->toArray():
 *   [
 *     'id' => 123,
 *     ...
 *   ]
 *
 * or use the dedicated getter methods like
 *  - getId(): DatapoolId
 * etc.
 */
```

### Get by ID (`Datana\Datapool\Api\Domain\Value\DatapoolId`)

```php
use Datana\Datapool\Api\AktenApi;
use Datana\Datapool\Api\DatapoolClient;
use Datana\Datapool\Api\Domain\Value\DatapoolId;

$client = new DatapoolClient(/* ... */);

$aktenApi = new AktenApi($client);

$id = DatapoolId::fromInt(123);

$aktenApi->getById($id);
```

### Get KT Akten Info (`Datana\Datapool\Api\Domain\Value\DatapoolId`)

```php
use Datana\Datapool\Api\AktenApi;
use Datana\Datapool\Api\DatapoolClient;
use Datana\Datapool\Api\Domain\Value\DatapoolId;

$client = new DatapoolClient(/* ... */);

$aktenApi = new AktenApi($client);

$id = DatapoolId::fromInt(123);

// is an instance of KtAktenInfoResponse
$result = $aktenApi->getKtAktenInfo($id);
/*
 * $response->toArray():
 *   [
 *     'id' => 123,
 *     'url' => 'https://projects.knowledgetools.de/rema/?tab=akten&akte=4528',
 *     'instance' => 'rema',
 *     'group' => 'GARA',
 *   ]
 *
 * or use the dedicated getter methods like
 *  - getId()
 *  - getUrl()
 *  - getInstance()
 *  - getGroup()
 * etc.
 */
```

### Get E-Termin Info (`Datana\Datapool\Api\Domain\Value\DatapoolId`)

```php
use Datana\Datapool\Api\AktenApi;
use Datana\Datapool\Api\DatapoolClient;
use Datana\Datapool\Api\Domain\Value\DatapoolId;

$client = new DatapoolClient(/* ... */);

$aktenApi = new AktenApi($client);

$id = DatapoolId::fromInt(123);

// is an instance of ETerminResponse
$response = $aktenApi->getETerminInfo($id);
/*
 * $response->toArray():
 *   [
 *     'service_id' => 123,
 *     'service_url' => 'https://www.etermin.net/Gansel-Rechtsanwaelte/serviceid/123',
 *   ]
 *
 * or use the dedicated getter methods like
 *  - getServiceId()
 *  - getServiceUrl()
 * etc.
 */
```

### Set value "Nutzer Mandantencockpit" (`bool`)

```php
use Datana\Datapool\Api\AktenApi;
use Datana\Datapool\Api\DatapoolClient;
use Datana\Datapool\Api\Domain\Value\DatapoolId;

$client = new DatapoolClient(/* ... */);

$aktenApi = new AktenApi($client);

$id = DatapoolId::fromInt(123);

$aktenApi->setValueNutzerMandantencockpit($id, true); // or false
```

## Aktenzeichen

In your code you should type-hint to `Datana\Datapool\Api\AktenzeichenApiInterface`

### Get a new one

```php
use Datana\Datapool\Api\AktenzeichenApi;
use Datana\Datapool\Api\DatapoolClient;

$client = new DatapoolClient(/* ... */);

$aktenzeichenApi = new AktenzeichenApi($client);
$aktenzeichenApi->new(); // returns sth like "6GU5DCB"
```

## AktenEventLog

In your code you should type-hint to `Datana\Datapool\Api\AktenEventLogInterface`

### Create a new log

```php
use Datana\Datapool\Api\AktenEventLogApi;
use Datana\Datapool\Api\DatapoolClient;

$client = new DatapoolClient(/* ... */);

$aktenEventLog = new AktenEventLogApi($client);
$aktenEventLog->log(
    '1234/12',                // Aktenzeichen
    'E-Mail versendet',       // Info-Text
    new \DateTimeImmutable(), // Zeitpunkt des Events
    'Mein Service',           // Ersteller des Events
);
```

## ChatProtocol

In your code you should type-hint to `Datana\Datapool\Api\ChatProtocolApiInterface`

### Save a new chat protocol

```php
use Datana\Datapool\Api\ChatProtoclApi;
use Datana\Datapool\Api\DatapoolClient;

$client = new DatapoolClient(/* ... */);

$chatProtocol = new ChrtProtocolApi($client);
$chatProtocol->log(
    '1234/12',                // Aktenzeichen
    '123456',                 // Conversation ID
    array(/*...*/),           // Das JSON der Intercom conversation
    new \DateTimeImmutable(), // Startzeitpunkt der Conversation
);
```

[build-status-master-php]: https://github.com/datana-gmbh/datapool-api/workflows/PHP/badge.svg?branch=master
[coverage-status-master]: https://codecov.io/gh/datana-gmbh/datapool-api/branch/master/graph/badge.svg

[actions]: https://github.com/datana-gmbh/datapool-api/actions
[codecov]: https://codecov.io/gh/datana-gmbh/datapool-api
