<?php

declare(strict_types = 1);

require_once __DIR__ . '/../../vendor/autoload.php';

use Seravo\SeravoApi\OrderModule\Client;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\CreateOrderRequest;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Billing\PaperInvoice;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Company;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Contact;
use Seravo\SeravoApi\OrderModule\Request\CreateOrder\Model\Mail;


// $contact = new Contact(email: 'tatu@seravo.com', name: 'Tatu Kulmala', phone: '0401234567');

// dump($contact->toArray());
// exit;

$createOrderRequest = new CreateOrderRequest(
    acceptServiceTerms: true,
    contact: new Contact(email: 'tatu@seravo.com', name: 'Tatu Kulmala', phone: '0401234567'),
    migration: false,
    orderLanguage: 'FI',
    orderTrialPeriod: 0,
    primaryDomain: 'testdomain.fi',
    siteLocation: 'FI',
    priceData: 'test',
    // billing: new PaperInvoice(),
    company: new Company(id: '1', name: 'Tatu Kulmala', address: 'Testikatu 1'),
    mail: new Mail(option: '1'),
);

dump($createOrderRequest->toArray());
exit;

// $client = new Client('https://api.seravo.dev', 'token');
// $createOrder = $client->orders()->create($createOrderRequest);

// dump($createOrder);
