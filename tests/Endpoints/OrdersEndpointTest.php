<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Seravo\SeravoApi\Apis\Order\Response\Order\Order;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Mail;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Request\Order\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\UpdateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\Order\Schema\Billing\PaperInvoice;
use Seravo\SeravoApi\Exceptions\BadRequestException;

class OrdersEndpointTest extends BaseEndpointTestCase
{
    public function testGetOrders(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $this->testCollection(Order::class, $client->order->orders()->get(), $data['results']);

        $this->expectException(BadRequestException::class);
        $client->order->orders()->get();
    }

    public function testGetOrder(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(Order::class, $client->order->orders()->getById($id), $data);

        $this->expectException(BadRequestException::class);
        $client->order->orders()->getById($id);
    }

    public function testCreateOrder(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $request = new CreateOrderRequest(
            acceptServiceTerms: true,
            contact: new Contact(
                email: 'test@test.com',
                name: 'Test',
                phone: '1234567890'
            ),
            migration: false,
            orderLanguage: 'en',
            primaryDomain: 'test.com',
            siteLocation: 'eu',
            priceData: '1234',
            billing: new PaperInvoice(
                contactEmail: 'test@test.com',
                contactName: 'Test',
                contactPhone: '1234567890',
                address: 'Test Address',
                city: 'Test City',
                name: 'Test Name',
                postal: '12345',
            ),
            company: new Company(
                id: '1',
                name: 'Test Company'
            ),
            mail: new Mail(
                option: '1'
            ),
        );

        $this->testGetObject(Order::class, $client->order->orders()->create($request), $data);

        $this->expectException(BadRequestException::class);
        $client->order->orders()->create($request);
    }

    public function testUpdateOrder(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $request = new UpdateOrderRequest(
            acceptServiceTerms: true,
            contact: new Contact(
                email: 'test@test.com',
                name: 'Test',
                phone: '1234567890'
            ),
            migration: false,
            orderLanguage: 'en',
            primaryDomain: 'test.com',
            siteLocation: 'eu',
            priceData: '1234',
            billing: new PaperInvoice(
                contactEmail: 'test@test.com',
                contactName: 'Test',
                contactPhone: '1234567890',
                address: 'Test Address',
                city: 'Test City',
                name: 'Test Name',
                postal: '12345',
            ),
            company: new Company(
                id: '1',
                name: 'Test Company'
            ),
            mail: new Mail(
                option: '1'
            ),
        );

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';
        $this->testGetObject(Order::class, $client->order->orders()->update($id, $request), $data);

        $this->expectException(BadRequestException::class);
        $client->order->orders()->update($id, $request);
    }
}
