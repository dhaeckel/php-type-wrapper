<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\PositiveFloat;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PositiveFloat::class)]
class PositiveFloatTest extends TestCase
{
    public function testRejectsZero(): void
    {
        $this->expectException(\ValueError::class);
        new PositiveFloat(0.0);
    }

    public function testAcceptsPositiveFloatMax(): void
    {
        $positiveFloat = new PositiveFloat(\PHP_FLOAT_MAX);
        $this->assertSame(\PHP_FLOAT_MAX, $positiveFloat->toFloat());
        $this->assertSame((string) \PHP_FLOAT_MAX, (string) $positiveFloat);
    }

    public function testRejectsNegativeFloatMax(): void
    {
        $this->expectException(\ValueError::class);
        new PositiveFloat(-\PHP_FLOAT_MAX);
    }
}
