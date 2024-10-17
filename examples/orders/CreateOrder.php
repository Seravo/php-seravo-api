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
    contactEmail: 'tatu@seravo.com',
    contactName: 'Tatu Kulmala',
    contactPhone: '0401234567',
    address: 'Kauppakatu 3 A 4',
    city: 'Tampere',
    postal: '33200',
    name: 'Tatu Kulmala'
);

$createOrderRequest = new CreateOrderRequest(
    acceptServiceTerms: true,
    contact: new Contact(email: 'tatu@seravo.com', name: 'Tatu Kulmala', phone: '0401234567'),
    migration: false,
    orderLanguage: 'FI',
    orderTrialPeriod: 0,
    primaryDomain: 'testdomain.fi',
    siteLocation: 'FI',
    priceData: 'ff67d517-e5a1-4826-b936-5c41cd12853f',
    billing: $billing,
    company: new Company(id: '1', name: 'Tatu Kulmala'),
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
