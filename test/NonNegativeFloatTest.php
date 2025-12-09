<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NonNegativeFloat;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NonNegativeFloat::class)]
class NonNegativeFloatTest extends TestCase
{
    public function testRejectsNegativeFloatMax(): void
    {
        $this->expectException(\ValueError::class);
        new NonNegativeFloat(-\PHP_FLOAT_MAX);
    }

    public function testAcceptsZero(): void
    {
        $nonNegativeFloat = new NonNegativeFloat(0.0);
        $this->assertSame(0.0, $nonNegativeFloat->toFloat());
        $this->assertSame('0', (string) $nonNegativeFloat);
    }

    public function testAcceptsPositiveFloatMax(): void
    {
        $nonNegativeFloat = new NonNegativeFloat(\PHP_FLOAT_MAX);
        $this->assertSame(\PHP_FLOAT_MAX, $nonNegativeFloat->toFloat());
        $this->assertSame((string) \PHP_FLOAT_MAX, (string) $nonNegativeFloat);
    }
}
