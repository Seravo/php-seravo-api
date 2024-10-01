<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\OrderModule\Request;

abstract class AbstractRequest
{
    protected string $method = 'get';

    /**
     *
     * @var array<string, mixed>
     */
    protected array $options = [];

    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     *
     * @param array<string, mixed> $arr
     * @return array<string, mixed>
     */
    public function filterEmpty(array $arr): array
    {
        return array_filter($arr, function ($value) {
            return $value !== null;
        });
    }
}
