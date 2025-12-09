<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\Numeric;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Numeric::class)]
class NumericTest extends TestCase
{
    public function testAcceptsFloat(): void
    {
        $numeric = new Numeric(\PHP_FLOAT_MAX);
        $this->assertSame(\PHP_FLOAT_MAX, $numeric->toFloat());
        $this->assertSame((string) \PHP_FLOAT_MAX, (string) $numeric);
    }

    public function testRejectsNonNumericString(): void
    {
        $this->expectException(\ValueError::class);
        new Numeric('not a number');
    }

    public function testAcceptsNumericString(): void
    {
        $numeric = new Numeric('123.456');
        $this->assertSame(123.456, $numeric->toFloat());
        $this->assertSame('123.456', (string) $numeric);
    }

    public function testAcceptsInteger(): void
    {
        $numeric = new Numeric(\PHP_INT_MAX);
        $this->assertSame((float) \PHP_INT_MAX, $numeric->toFloat());
        $this->assertSame((string) \PHP_INT_MAX, (string) $numeric);
    }

    public function testAcceptsNumericInteger(): void
    {
        $numeric = new Numeric((string) \PHP_INT_MAX);
        $this->assertSame((float) \PHP_INT_MAX, $numeric->toFloat());
        $this->assertSame((string) \PHP_INT_MAX, (string) $numeric);
    }

    public function testRound(): void
    {
        $numeric = new Numeric(123.4567);
        $rounded = $numeric->round(2);
        $this->assertSame(123.46, $rounded->toFloat());
        $this->assertSame('123.46', (string) $rounded);
    }

    public function testRoundToInt(): void
    {
        $numeric = new Numeric(123.5567);
        $rounded = $numeric->round(0, \PHP_ROUND_HALF_UP);
        $this->assertSame(124.0, $rounded->toFloat());
        $this->assertSame('124', (string) $rounded);
    }

    public function testRoundToIntDifferentMode(): void
    {
        $numeric = new Numeric(123.5);
        $rounded = $numeric->round(0, \PHP_ROUND_HALF_DOWN);
        $this->assertSame(123.0, $rounded->toFloat());
        $this->assertSame('123', (string) $rounded);
    }

    public function testRoundNegativePrecision(): void
    {
        $numeric = new Numeric(12345.67);
        $rounded = $numeric->round(-2);
        $this->assertSame(12300.0, $rounded->toFloat());
        $this->assertSame('12300', (string) $rounded);
    }

    public function testRoundFloatMax(): void
    {
        $numeric = new Numeric(\PHP_FLOAT_MAX);
        $rounded = $numeric->round(2);
        $this->assertSame(\round(\PHP_FLOAT_MAX, 2), $rounded->toFloat());
        $this->assertSame((string) \PHP_FLOAT_MAX, (string) $rounded);
    }
}
