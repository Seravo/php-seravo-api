<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

use Seravo\SeravoApi\Apis\Order\Request\Order\UpdateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing\PaperInvoice;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Mail;
use Seravo\SeravoApi\Exception\ValidationErrorException;
use Seravo\SeravoApi\SeravoAPI;

$billing = new PaperInvoice(
    contactEmail: 'john@doe.com',
    contactName: 'John Doe',
    contactPhone: '0401234567',
    address: 'Testikatu 1',
    city: 'Helsinki',
    postal: '00100',
    name: 'John Doe'
);

$updateOrderRequest = new UpdateOrderRequest(
    ...[
        'acceptServiceTerms' => true,
        'contact' => new Contact(email: 'john@doe.com', name: 'John Doe', phone: '0401234567'),
        'migration' => false,
        'orderLanguage' => 'FI',
        'orderTrialPeriod' => 12,
        'primaryDomain' => 'example.fi',
        'siteLocation' => 'FI',
        'priceData' => 'ff67d517-e5a1-4826-b936-5c41cd12853f',
        'billing' => $billing,
        'company' => new Company(id: '1', name: 'John Doe'),
        'mail' => new Mail(option: '1'),
        'id' => 'e608fd78-a0e0-4a9d-98db-8e38de79acb7'
    ]
);

$api = new SeravoAPI(
    baseUrl: $_ENV['SERAVO_API_URL'],
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate(
    authProviderUrl: $_ENV['SERAVO_KEYCLOAK_PROVIDER_URL'],
    tokenEndpoint: $_ENV['SERAVO_KEYCLOAK_TOKEN_ENDPOINT_URL']
);

try {
    $result = $api->order->orders()->update(
        id: 'e608fd78-a0e0-4a9d-98db-8e38de79acb7',
        request: $updateOrderRequest
    );
    dd($result);
} catch (ValidationErrorException $exception) {
    dd(json_decode($exception->getData()));
} catch (\Exception $exception) {
    dd($exception);
    die();
}
