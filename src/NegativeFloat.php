<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class NegativeFloat implements FloatConvertible, \Stringable
{
    /** @throws \ValueError if $value is not negative */
    public function __construct(public readonly float $value)
    {
        if (! self::isNegative($value)) {
            throw new \ValueError('value is not negative');
        }
    }

    public static function isNegative(float $value): bool
    {
        return $value < 0.0;
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
