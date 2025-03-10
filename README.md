<img src="https://seravo.com/wp-content/uploads/2024/06/seravo-logo-512.png" width="150">

# PHP Seravo API

A simple, object-oriented wrapper for the Seravo API, written in PHP.

## Getting Started

API credentials are required to use the service. For more information and to request API credentials, please visit our [website](https://www.seravo.com) or contact help@seravo.com directly.

### Requirements

- PHP >= 8.2
- PHP XML extension (php-xml)
- [ext-curl](https://www.php.net/manual/en/curl.installation.php) PHP cURL extension
- [ext-json](https://www.php.net/manual/en/json.installation.php) PHP JSON extension
- [ext-mbstring](https://www.php.net/manual/en/mbstring.installation.php) PHP Multibyte String extension

### Installation

Clone the project:

**HTTPS**

```
git clone https://github.com/Seravo/php-seravo-api.git
```

**SSH**

```
git clone git@github.com:Seravo/php-seravo-api.git
```

Install composer dependencies:

```
composer install
```

The package uses PSR-4 autoloader for class autoloading. Activate autoloading by requiring the Composer autoloader _(Note the path to the vendor directory is relative to your project)_:

```
require 'vendor/autoload.php';
```

### Environment Variables

The following environment variables are required to be set before using the library:

- `SERAVO_API_CLIENT_ID`
- `SERAVO_API_SECRET`

Optionally, you may pass these environment variables as well:

- `SERAVO_ENVIRONMENT`
    - Defines the API environment (`testing`, `staging`, `production`) to be used. Defaults to `production` if omitted from `.env` and/or constructor.

These values must be set in the `/.env` file. See `.env.example`.

## Basic Usage

See the [examples](https://github.com/Seravo/php-seravo-api/tree/main/examples) directory for more detailed information about how to use the library.

#### Initializing the Client

To initialize the `SeravoAPI` client, instantiate the class with valid credentials and authenticate:

```php
<?php

use Seravo\SeravoApi\SeravoAPI;

require_once 'vendor/autoload.php';

// Initialize client
$api = new SeravoAPI(
    clientId: 'your-client-id',
    secret: 'your-client-secret'
);

// Authenticate with given credentials
$api->authenticate();
```

#### Public API

##### Get Single Plan

Return a single Plan by ID:

```php
<?php

use Seravo\SeravoApi\SeravoAPI;

require_once 'vendor/autoload.php';

$api = new SeravoAPI(
    clientId: 'your-client-id',
    secret: 'your-client-secret'
);

$api->authenticate();

$plan = $api->public->plans()->getById(id: 'plan-id');
var_dump($plan);
```

#### Order API

##### Get Single Order

Return a single Order by ID:

```php
<?php

require_once 'vendor/autoload.php';

use Seravo\SeravoApi\SeravoAPI;

$api = new SeravoAPI(
    clientId: 'your-client-id',
    secret: 'your-client-secret'
);

$api->authenticate();

$order = $api->order->orders()->getById(id: 'your-order-id');
var_dump($order);
```

##### Create New Order

Create a new Order:

```php
<?php

require_once 'vendor/autoload.php';

use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\Order\Request\Order\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing\PaperInvoice;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Mail;

$billing = new PaperInvoice(
    contactEmail: 'jonh@doe.com',
    contactName: 'John Doe',
    contactPhone: '0401234567',
    address: 'Testikatu 1',
    city: 'Helsinki',
    postal: '00100',
    name: 'John Doe'
);

$createOrderRequest = new CreateOrderRequest(
    acceptServiceTerms: true,
    contact: new Contact(email: 'john@doe.com', name: 'John Doe', phone: '0401234567'),
    migration: false,
    orderLanguage: 'FI',
    orderTrialPeriod: 0,
    primaryDomain: 'example.fi',
    siteLocation: 'FI',
    priceData: 'ff67d517-e5a1-4826-b936-5c41cd12853f',
    billing: $billing,
    company: new Company(id: '1', name: 'John Doe'),
    mail: new Mail(option: '1'),
);

$api = new SeravoAPI(
    clientId: 'your-client-id',
    secret: 'your-client-secret'
);

$api->authenticate();

try {
    $result = $api->order->orders()->create($createOrderRequest);
    var_dump($result);
} catch (\Exception $exception) {
    var_dump($exception);
}
```

## Documentation

See our documentation for [Order Module API](https://api.seravo.com/order/docs#/) & [Public Module API](https://api.seravo.com/public/docs#/).

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.