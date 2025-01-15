<?php

declare(strict_types=1);

use Seravo\SeravoApi\SeravoAPI;

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

$api = new SeravoAPI(
    baseUrl: $_ENV['SERAVO_API_URL'],
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate(
    authProviderUrl: $_ENV['SERAVO_KEYCLOAK_PROVIDER_URL'],
    tokenEndpoint: $_ENV['SERAVO_KEYCLOAK_TOKEN_ENDPOINT_URL']
);

$affiliate = $api->order->affiliates()->getById(id: '4cda0607-73c2-4bbd-bb52-4f5eaa05a9ba');

dd($affiliate);
