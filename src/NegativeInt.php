<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class NegativeInt implements IntConvertible, \Stringable
{
    /**
     * @param negative-int $value
     *
     * @throws \ValueError if $value is not negative
     */
    public function __construct(public readonly int $value)
    {
        if (! self::isNegative($value)) {
            throw new \ValueError('value is not negative');
        }
    }

    public static function isNegative(int $value): bool
    {
        return $value < 0;
    }

    /** @return negative-int */
    public function toInt(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
