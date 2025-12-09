<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class NonNegativeInt implements IntConvertible, \Stringable
{

    /**
     * @param non-negative-int $value
     *
     * @throws \ValueError if $value is negative
     */
    public function __construct(public readonly int $value)
    {
        if (! self::isPositive($value)) {
            throw new \ValueError('value is negative');
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public static function isPositive(int $value): bool
    {
        return $value >= 0;
    }

    /** @return non-negative-int */
    public function toInt(): int
    {
        return $this->value;
    }
}
