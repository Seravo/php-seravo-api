<?php

declare(strict_types=1);

namespace Seravo\Tests\SeravoApi\Endpoints;

use Seravo\SeravoApi\Apis\OrderApi;
use Seravo\SeravoApi\Enums\HttpMethod;
use Seravo\SeravoApi\Enums\ApiEndpoint;
use Seravo\SeravoApi\Apis\Order\Endpoint\Orders;
use Seravo\Tests\SeravoApi\Endpoints\BaseEndpointCase;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Mail;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Company;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Contact;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\CreateOrderRequest;
use Seravo\SeravoApi\Apis\Order\Request\CreateOrder\Schema\Billing\PaperInvoice;

class OrdersEndpointTest extends BaseEndpointCase
{
    public function testGetOrders(): void
    {
        $mockData = $this->loadMockData('orders/orders.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Orders,
            HttpMethod::Get,
            self::BASE_URI,
            $mockResponse
        );

        $orders = new Orders($apiMock);
        $response = $orders->get();

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testGetOrderById(): void
    {
        $mockData = $this->loadMockData('orders/order.json');
        $mockResponse = json_decode($mockData, true);
        $orderId = '12345';

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Orders,
            HttpMethod::Get,
            self::BASE_URI . $orderId,
            $mockResponse
        );

        $orders = new Orders($apiMock);
        $response = $orders->getById($orderId);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }

    public function testCreateOrder(): void
    {
        $mockData = $this->loadMockData('orders/order.json');
        $mockResponse = json_decode($mockData, true);

        $apiMock = $this->createApiMock(
            OrderApi::class,
            ApiEndpoint::Orders,
            HttpMethod::Post,
            self::BASE_URI,
            $mockResponse
        );

        $createOrderRequest = new CreateOrderRequest(
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
                name: 'Tatu Kulmala'
            ),
            mail: new Mail(
                option: '1'
            ),
        );

        $orders = new Orders($apiMock);
        $response = $orders->create($createOrderRequest);

        $this->assertIsArray($response);
        $this->assertEquals($mockResponse, $response);
    }
}
