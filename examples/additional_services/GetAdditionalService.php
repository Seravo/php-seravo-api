<?php

declare(strict_types=1);

use Seravo\SeravoApi\SeravoAPI;

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$api = new SeravoAPI(
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate();

try {
    $additionalService = $api->order->additionalServices()->getById(id: 'ae921402-fe1a-4fce-815b-86a411051ad9');
    dd($additionalService);
} catch (Exception $exception) {
    dd($exception);
}
