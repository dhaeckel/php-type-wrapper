<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class NonZeroInt implements IntConvertible, \Stringable
{
    /**
     * @param non-zero-int $value
     *
     * @throws \ValueError if $value is zero
     */
    public function __construct(public readonly int $value)
    {
        if (! self::isNonZero($value)) {
            throw new \ValueError('value is zero');
        }
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public static function isNonZero(int $value): bool
    {
        return $value !== 0;
    }

    /** @return non-zero-int */
    public function toInt(): int
    {
        return $this->value;
    }
}
