<?php

declare(strict_types=1);

use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\Order\Request\AdditionalService\EditAdditionalServiceRequest;

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$api = new SeravoAPI(
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate();

$editAdditionalServiceRequest = new EditAdditionalServiceRequest(
    transferKeys: ['test', 'test2', 'test3'],
    dnsZone: 'testzonedataedited',
);

try {
    $result = $api->order->additionalServices()->edit(
        request: $editAdditionalServiceRequest,
        id: 'ae921402-fe1a-4fce-815b-86a411051ad9'
    );
    dd($result);
} catch (Exception $exception) {
    dd($exception);
}
