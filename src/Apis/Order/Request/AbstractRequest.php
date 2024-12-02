<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Apis\Order\Request;

use Seravo\SeravoApi\Concerns\CastableToArray;

abstract class AbstractRequest
{
    use CastableToArray;

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
