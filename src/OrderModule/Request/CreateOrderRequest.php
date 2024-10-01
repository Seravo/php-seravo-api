<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request;

class CreateOrderRequest extends AbstractRequest
{
    protected string $method = 'post';

    public function __construct(array $data)
    {
        $this->options = [
            'form_params' => [...$data]
        ];
    }
}
