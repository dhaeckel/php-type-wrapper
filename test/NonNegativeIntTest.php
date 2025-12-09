<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NonNegativeInt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NonNegativeInt::class)]
class NonNegativeIntTest extends TestCase
{
    public function testRejectsNegativeIntMax(): void
    {
        $this->expectException(\ValueError::class);
        new NonNegativeInt(-\PHP_INT_MAX);
    }

    public function testAcceptsZero(): void
    {
        $nonNegativeInt = new NonNegativeInt(0);
        $this->assertSame(0, $nonNegativeInt->toInt());
        $this->assertSame('0', (string) $nonNegativeInt);
    }

    public function testAcceptsPositiveIntMax(): void
    {
        $nonNegativeInt = new NonNegativeInt(\PHP_INT_MAX);
        $this->assertSame(\PHP_INT_MAX, $nonNegativeInt->toInt());
        $this->assertSame((string) \PHP_INT_MAX, (string) $nonNegativeInt);
    }
}
