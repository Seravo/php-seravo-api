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
    contact_email: 'john@doe.com',
    contact_name: 'John Doe',
    contact_phone: '0401234567',
    address: 'Testikatu 1',
    city: 'Helsinki',
    postal: '00100',
    name: 'John Doe'
);

$createOrderRequest = new CreateOrderRequest(
    accept_service_terms: true,
    domains: [ new Domain(name: 'mydomainexample123.fi', primary: true) ],
    contact: new Contact(email: 'john@doe.com', name: 'John Doe', phone: '0401234567'),
    migration: false,
    order_language: 'fi', // 'fi', 'en_US', 'sv_SE'
    order_trial_period: 0,
    site_location: 'FI',
    price_data: 'd289afc7-b02e-44b5-918b-da66aa3d8858',
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
