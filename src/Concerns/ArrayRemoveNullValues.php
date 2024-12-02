<?php

declare(strict_types=1);

namespace Seravo\SeravoApi\Concerns;

trait ArrayRemoveNullValues
{
    /**
     *
     * @param array<string, mixed> $array
     * @return array<string, mixed>
     */
    public function arrayFilterRecursive(array $array): array
    {
        foreach ($array as $key => &$value) {
            if (is_null($value)) {
                unset($array[$key]);
            } elseif (is_array($value)) {
                $value = $this->arrayFilterRecursive($value);
            }
        }
        return $array;
    }
}
