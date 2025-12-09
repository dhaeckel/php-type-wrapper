<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class NonEmptyString implements \Stringable
{
    /**
     * @param non-empty-string $value
     *
     * @throws \ValueError if $value is empty
     */
    public function __construct(public readonly string $value)
    {
        if (! self::isNonEmpty($value)) {
            throw new \ValueError('value is empty');
        }
    }

    public static function isNonEmpty(string $value): bool
    {
        return $value !== '';
    }

    /** @return non-empty-string */
    public function __toString(): string
    {
        return $this->value;
    }
}
