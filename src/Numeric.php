<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class Numeric implements FloatConvertible, \Stringable
{
    private readonly string $value;

    /**
     * @param numeric-string|int|float $value
     *
     * @throws \ValueError when value is not numeric
     *
     * @see \is_numeric()
     */
    public function __construct(int|float|string $value)
    {
        if (! \is_numeric($value)) {
            throw new \ValueError('value is not numeric');
        }
        $this->value = (string) $value;
    }

    /**
     * @param \PHP_ROUND_HALF_DOWN|\PHP_ROUND_HALF_EVEN|\PHP_ROUND_HALF_ODD|\PHP_ROUND_HALF_UP $roundMode
     */
    public function roundToInt(int $roundMode = \PHP_ROUND_HALF_UP): int
    {
        return (int) \round($this->toFloat(), mode: $roundMode);
    }

    /**
     * @param \PHP_ROUND_HALF_DOWN|\PHP_ROUND_HALF_EVEN|\PHP_ROUND_HALF_ODD|\PHP_ROUND_HALF_UP $roundMode
     */
    public function round(int $precision = 0, int $roundMode = \PHP_ROUND_HALF_UP): self
    {
        return new self(\round($this->toFloat(), $precision, $roundMode));
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function toFloat(): float
    {
        return (float) $this->value;
    }
}
