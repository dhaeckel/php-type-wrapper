<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NonZeroInt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NonZeroInt::class)]
class NonZeroIntTest extends TestCase
{
    public function testRejectsZero(): void
    {
        $this->expectException(\ValueError::class);
        new NonZeroInt(0);
    }

    public function testAcceptsPositiveIntMax(): void
    {
        $nonZeroInt = new NonZeroInt(\PHP_INT_MAX);
        $this->assertSame(\PHP_INT_MAX, $nonZeroInt->toInt());
        $this->assertSame((string) \PHP_INT_MAX, (string) $nonZeroInt);
    }

    public function testAcceptsNegativeIntMax(): void
    {
        $nonZeroInt = new NonZeroInt(-\PHP_INT_MAX);
        $this->assertSame(-\PHP_INT_MAX, $nonZeroInt->toInt());
        $this->assertSame((string) -\PHP_INT_MAX, (string) $nonZeroInt);
    }
}
