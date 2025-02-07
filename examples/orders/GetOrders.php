<?php

declare(strict_types=1);

use Seravo\SeravoApi\SeravoAPI;

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$api = SeravoAPI::create(
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET'],
    cacheClient: new Predis\Client('asd'),
);
// $api = new SeravoAPI(
//     clientId: $_ENV['SERAVO_API_CLIENT_ID'],
//     secret: $_ENV['SERAVO_API_SECRET'],
//     cacheClient: new Predis\Client(),
// );

$api->authenticate();

$orders = $api->order->orders()->get();

dd($orders);
