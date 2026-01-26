<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\Order\Request\Order\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing\PaperInvoice;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Mail;
use Seravo\SeravoApi\Apis\Order\Response\Order\Domain;

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
    domains: [ new Domain(name: 'mydomainexample123.fi', primary: true) ],
    contact: new Contact(email: 'john@doe.com', name: 'John Doe', phone: '0401234567'),
    migration: false,
    orderLanguage: 'fi', // 'fi', 'en_US', 'sv_SE'
    orderTrialPeriod: 0,
    siteLocation: 'FI',
    priceData: 'd289afc7-b02e-44b5-918b-da66aa3d8858',
    billing: $billing,
    company: new Company(id: '1', name: 'John Doe'),
    mail: new Mail(option: '1'),
);

$api = new SeravoAPI(
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate();

try {
    $result = $api->order->orders()->create($createOrderRequest);
    dd($result);
} catch (\Exception $exception) {
    dd($exception);
    die();
}
