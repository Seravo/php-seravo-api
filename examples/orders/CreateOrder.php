<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Billing\PaperInvoice;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Mail;
use Seravo\SeravoApi\Exception\ValidationErrorException;

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
    priceData: 'test',
    billing: $billing,
    company: new Company(id: '1', name: 'John Doe'),
    mail: new Mail(option: '1'),
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
    $result = $api->order->orders()->create($createOrderRequest);
    dd($result);
} catch (ValidationErrorException $exception) {
    dd(json_decode($exception->getData()));
} catch (\Exception $exception) {
    dd($exception);
    die();
}
