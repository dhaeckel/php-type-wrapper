<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

final class NumericString implements FloatConvertible, \Stringable
{
    /**
     * @param numeric-string $value
     *
     * @throws \ValueError when value is not numeric
     *
     * @see \is_numeric()
     */
    public function __construct(public readonly string $value)
    {
        if (! \is_numeric($value)) {
            throw new \ValueError('value is not numeric');
        }
    }

    public static function fromFloat(
        float $value,
        ?int $precision = null,
        LegacyRoundMode $roundMode = LegacyRoundMode::HalfAwayFromZero,
    ): self {
        if ($precision !== null) {
            $value = \round(
                $value,
                $precision,
                $roundMode->value,
            );
        }

        $iniPrecisionSetting = \ini_get('precision');
        $defaultPrecision = (
            $iniPrecisionSetting !== false && $iniPrecisionSetting > -1
            ? (int) $iniPrecisionSetting
            : 14
        );

        $formatPrecision = $precision ?? $defaultPrecision;
        // @phpstan-ignore argument.type (format ensures, that string is numeric)
        return new self(\sprintf('%1.' . $formatPrecision . 'F', $value));
    }

    public static function fromInt(int $value): self
    {
        return new self((string) $value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /** WARNING: possible precision loss */
    public function toFloat(): float
    {
        return (float) $this->value;
    }
}
