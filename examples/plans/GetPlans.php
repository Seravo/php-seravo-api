<?php

declare(strict_types=1);

use Seravo\SeravoApi\SeravoAPI;

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$api = new SeravoAPI(
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate();

$plans = $api->public->plans()->get();

dd($plans);
