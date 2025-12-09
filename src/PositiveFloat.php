<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class PositiveFloat implements FloatConvertible, \Stringable
{
    /** @throws \ValueError */
    public function __construct(public readonly float $value)
    {
        if (! self::isPositive($value)) {
            throw new \ValueError('value is not positive');
        }
    }

    public static function isPositive(float $value): bool
    {
        return $value > 0.0;
    }

    public function toFloat(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
