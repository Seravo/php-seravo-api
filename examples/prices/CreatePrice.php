<?php

require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

use Seravo\SeravoApi\SeravoAPI;
use Seravo\SeravoApi\Apis\Public\Request\Price\CreatePriceRequest;
use Seravo\SeravoApi\Exception\ValidationErrorException;

$createPriceRequest = new CreatePriceRequest(
    interval: 1,
    products: [],
    plan: '0e6bb9d4-2c90-4ae7-b876-4e17d5e8ff11',
    promotion: null,
);

$api = new SeravoAPI(
    clientId: $_ENV['SERAVO_API_CLIENT_ID'],
    secret: $_ENV['SERAVO_API_SECRET']
);

$api->authenticate();

try {
    $result = $api->public->prices()->create($createPriceRequest);
    dd($result);
} catch (ValidationErrorException $exception) {
    dd(json_decode((string) $exception->getData()));
} catch (\Exception $exception) {
    dd($exception);
    die();
}
