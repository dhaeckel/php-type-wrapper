<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NonPositiveInt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NonPositiveInt::class)]
class NonPositiveIntTest extends TestCase
{
    public function testRejectsPositiveIntMax(): void
    {
        $this->expectException(\ValueError::class);
        new NonPositiveInt(\PHP_INT_MAX);
    }

    public function testAcceptsZero(): void
    {
        $nonPositiveInt = new NonPositiveInt(0);
        $this->assertSame(0, $nonPositiveInt->toInt());
        $this->assertSame('0', (string) $nonPositiveInt);
    }

    public function testAcceptsNegativeIntMax(): void
    {
        $nonPositiveInt = new NonPositiveInt(-\PHP_INT_MAX);
        $this->assertSame(-\PHP_INT_MAX, $nonPositiveInt->toInt());
        $this->assertSame((string) -\PHP_INT_MAX, (string) $nonPositiveInt);
    }
}
