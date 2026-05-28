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
use Seravo\SeravoApi\Apis\Order\Response\Order\Domain;
use Seravo\SeravoApi\Exceptions\BadRequestException;
use Seravo\SeravoApi\Exceptions\HttpException;

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

    public function testGetOrderThrowsHttpExceptionForServerError(): void
    {
        $client = $this->getDataProvider()->createClientHandler([
            new Response(500, [], Utils::streamFor(json_encode(['error' => 'Internal Server Error']))),
        ]);

        $id = 'b27c543d-d388-4e26-a3aa-877cb914cbc4';

        try {
            $client->order->orders()->getById($id);
            $this->fail('Expected HttpException to be thrown.');
        } catch (HttpException $exception) {
            $this->assertSame(500, $exception->getCode());
            $this->assertSame(['error' => 'Internal Server Error'], $exception->getContext());
        }
    }

    public function testCreateOrder(): void
    {
        $data = $this->getDataProvider()->getData();

        $client = $this->getDataProvider()->createClientHandler([
            new Response(200, ['Content-Type' => 'application/json'], Utils::streamFor(json_encode($data))),
            new Response(400, [], Utils::streamFor(json_encode(['error' => 'Bad Request']))),
        ]);

        $request = new CreateOrderRequest(
            accept_service_terms: true,
            contact: new Contact(
                email: 'test@test.com',
                name: 'Test',
                phone: '1234567890'
            ),
            migration: false,
            order_language: 'en',
            domains: [
                new Domain(
                    name: 'test.com',
                    primary: true
                )
            ],
            site_location: 'eu',
            price_data: '1234',
            billing: new PaperInvoice(
                contact_email: 'test@test.com',
                contact_name: 'Test',
                contact_phone: '1234567890',
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
            accept_service_terms: true,
            contact: new Contact(
                email: 'test@test.com',
                name: 'Test',
                phone: '1234567890'
            ),
            migration: false,
            order_language: 'en',
            domains: [
                new Domain(
                    name: 'test.com',
                    primary: true
                )
            ],
            site_location: 'eu',
            price_data: '1234',
            billing: new PaperInvoice(
                contact_email: 'test@test.com',
                contact_name: 'Test',
                contact_phone: '1234567890',
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
