<?php

declare(strict_types=1);

use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\CreateAdditionalServiceRequest;

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

$createAdditionalServiceRequest = new CreateAdditionalServiceRequest(
    transferKeys: ['test', 'test2'],
    dnsZone: 'testzonedata'
);

try {
    $result = $api->order->additionalServices()->create(
        request: $createAdditionalServiceRequest,
        id: 'ae921402-fe1a-4fce-815b-86a411051ad9'
    );
    dd($result);
} catch (Exception $exception) {
    dd($exception);
}
