<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();

use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\Order\Request\OrderStatusRequest;

use Seravo\SeravoApi\Enums\OrderStatusEnum;

$api = new SeravoAPI(
    baseUrl: $_ENV['SERAVO_API_URL'],
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate(
    authProviderUrl: $_ENV['SERAVO_KEYCLOAK_PROVIDER_URL'], 
    tokenEndpoint: $_ENV['SERAVO_KEYCLOAK_TOKEN_ENDPOINT_URL']
);

$orderStatusRequest = new OrderStatusRequest(
    orderStatus: OrderStatusEnum::New
);

try {
    $result = $api->order->orders()->status(
        id: 'fa8407ea-47e6-4d9a-9c1b-8f68eb9175ba',
        request: $orderStatusRequest
    );
    dd($result);
} catch (\Exception $exception) {
    dd($exception);
    die();
}
