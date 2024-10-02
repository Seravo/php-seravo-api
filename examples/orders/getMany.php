<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Seravo\SeravoApi\OrderModule\Client;

$client = new Client('https://api.seravo.dev', 'token');
$orders = $client->orders()->get();

dump($orders);
