<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NegativeFloat;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NegativeFloat::class)]
class NegativeFloatTest extends TestCase
{
    public function testRejectsZero(): void
    {
        $this->expectException(\ValueError::class);
        new NegativeFloat(0.0);
    }

    public function testRejectsPositiveFloatMax(): void
    {
        $this->expectException(\ValueError::class);
        new NegativeFloat(\PHP_FLOAT_MAX);
    }

    public function testAcceptsNegativeFloatMax(): void
    {
        $negativeFloat = new NegativeFloat(-\PHP_FLOAT_MAX);
        $this->assertSame(-\PHP_FLOAT_MAX, $negativeFloat->toFloat());
        $this->assertSame((string) -\PHP_FLOAT_MAX, (string) $negativeFloat);
    }
}
