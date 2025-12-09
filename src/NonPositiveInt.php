<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class NonPositiveInt implements IntConvertible, \Stringable
{
    /**
     * @param non-positive-int $value
     * @throws \ValueError if $value is positive
     */
    public function __construct(public readonly int $value)
    {
        if (! self::isNonPositive($value)) {
            throw new \ValueError('value is positive');
        }
    }

    public static function isNonPositive(int $value): bool
    {
        return $value <= 0;
    }

    /** @return non-positive-int */
    public function toInt(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
