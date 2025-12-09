<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NonPositiveFloat;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NonPositiveFloat::class)]
class NonPositiveFloatTest extends TestCase
{
    public function testRejectsPositiveFloatMax(): void
    {
        $this->expectException(\ValueError::class);
        new NonPositiveFloat(\PHP_FLOAT_MAX);
    }

    public function testAcceptsZero(): void
    {
        $nonPositiveFloat = new NonPositiveFloat(0.0);
        $this->assertSame(0.0, $nonPositiveFloat->toFloat());
        $this->assertSame('0', (string) $nonPositiveFloat);
    }

    public function testAcceptsNegativeFloatMax(): void
    {
        $nonPositiveFloat = new NonPositiveFloat(-\PHP_FLOAT_MAX);
        $this->assertSame(-\PHP_FLOAT_MAX, $nonPositiveFloat->toFloat());
        $this->assertSame((string) -\PHP_FLOAT_MAX, (string) $nonPositiveFloat);
    }
}
