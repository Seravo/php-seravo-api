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

try {
    $order = $api->order->orders()->getById(id: '57e2cdd4-921c-4aa6-9926-9dd3e5ad42fb');
    dd($order);
} catch (Exception $exception) {
    dd($exception);
}
