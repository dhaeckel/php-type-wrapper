<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\{LegacyRoundMode, NumericString};
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NumericString::class)]
class NumericTest extends TestCase
{
    public function testAcceptsFloat(): void
    {
        $numeric = NumericString::fromFloat(\PHP_FLOAT_MAX);

        $this->assertSame(\PHP_FLOAT_MAX, $numeric->toFloat());
        $this->assertSame(
            \number_format(\PHP_FLOAT_MAX, 14, '.', ''),
            (string) $numeric,
        );
    }

    public function testWorksWithPrecisionIniSettingMinusOne(): void
    {
        $old = \ini_set('precision', '-1');
        $numeric = NumericString::fromFloat(\PHP_FLOAT_MAX);
        \ini_set('precision', $old);

        $this->assertSame(\PHP_FLOAT_MAX, $numeric->toFloat());
        $this->assertSame(
            \number_format(\PHP_FLOAT_MAX, 14, '.', ''),
            (string) $numeric,
        );
    }

    public function testWorksWithPrecisionIniSettingFalse(): void
    {
        $old = \ini_set('precision', false);
        $numeric = NumericString::fromFloat(\PHP_FLOAT_MAX);
        \ini_set('precision', $old);

        $this->assertSame(\PHP_FLOAT_MAX, $numeric->toFloat());
        $this->assertSame(
            \number_format(\PHP_FLOAT_MAX, 14, '.', ''),
            (string) $numeric,
        );
    }

    public function testRejectsNonNumericString(): void
    {
        $this->expectException(\ValueError::class);
        new NumericString('not a number');
    }

    public function testAcceptsNumericString(): void
    {
        $numeric = new NumericString('-123.456');
        $this->assertSame(-123.456, $numeric->toFloat());
        $this->assertSame('-123.456', (string) $numeric);
    }

    public function testAcceptsNumericStringScientificNotation(): void
    {
        $numeric = new NumericString('1.23456E18');
        $this->assertSame(1.23456E18, $numeric->toFloat());
        $this->assertSame('1.23456E18', (string) $numeric);
    }

    public function testAcceptsInteger(): void
    {
        $numeric = NumericString::fromInt(\PHP_INT_MAX);
        $this->assertSame((float) \PHP_INT_MAX, $numeric->toFloat());
        $this->assertSame((string) \PHP_INT_MAX, (string) $numeric);
    }

    public function testAcceptsNumericInteger(): void
    {
        $numeric = new NumericString((string) \PHP_INT_MAX);
        $this->assertSame((float) \PHP_INT_MAX, $numeric->toFloat());
        $this->assertSame((string) \PHP_INT_MAX, (string) $numeric);
    }

    public function testRound(): void
    {
        $numeric = NumericString::fromFloat(123.455, 2, LegacyRoundMode::HalfTowardsZero);
        $this->assertSame(123.45, $numeric->toFloat());
        $this->assertSame('123.45', (string) $numeric);
    }

    public function testRoundToInt(): void
    {
        $numeric = NumericString::fromFloat(123.5567, 0, LegacyRoundMode::HalfAwayFromZero);
        $this->assertSame(124.0, $numeric->toFloat());
        $this->assertSame('124', (string) $numeric);
    }

    public function testRoundToIntDifferentMode(): void
    {
        $numeric = NumericString::fromFloat(123.5, 0, LegacyRoundMode::HalfTowardsZero);
        $this->assertSame(123.0, $numeric->toFloat());
        $this->assertSame('123', (string) $numeric);
    }

    public function testRoundFloatMax(): void
    {
        $numeric = NumericString::fromFloat(\PHP_FLOAT_MAX, 2, LegacyRoundMode::HalfAwayFromZero);
        $this->assertSame(\round(\PHP_FLOAT_MAX, 2), $numeric->toFloat());
    }
}
