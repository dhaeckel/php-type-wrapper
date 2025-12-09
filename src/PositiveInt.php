<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class PositiveInt implements IntConvertible, \Stringable
{
    /**
     * @param positive-int $value
     *
     * @throws \ValueError if $value is not positive
     */
    public function __construct(private readonly int $value)
    {
        if (! self::isPositive($value)) {
            throw new \ValueError('value is not positive');
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public static function isPositive(int $value): bool
    {
        return $value > 0;
    }

    /** @return positive-int */
    public function toInt(): int
    {
        return $this->value;
    }
}
