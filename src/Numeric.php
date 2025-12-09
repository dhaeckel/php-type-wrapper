<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class Numeric implements FloatConvertible, \Stringable
{
    /**
     * @param numeric-string|float $value
     *
     * @throws \ValueError when value is not numeric
     *
     * @see \is_numeric()
     */
    public function __construct(public readonly int|float|string $value)
    {
        if (! \is_numeric($value)) {
            throw new \ValueError('value is not numeric');
        }
    }

    /**
     * phpcs:ignore Generic.Files.LineLength.MaxExceeded
     * @param \PHP_ROUND_HALF_DOWN|\PHP_ROUND_HALF_EVEN|\PHP_ROUND_HALF_ODD|\PHP_ROUND_HALF_UP $roundMode
     */
    public function round(int $precision = 0, int $roundMode = \PHP_ROUND_HALF_UP): self
    {
        return new self(\round($this->toFloat(), $precision, $roundMode));
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }

    public function toFloat(): float
    {
        return (float) $this->value;
    }
}
