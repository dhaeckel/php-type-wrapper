<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NegativeInt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NegativeInt::class)]
class NegativeIntTest extends TestCase
{
    public function testRejectsZero(): void
    {
        $this->expectException(\ValueError::class);
        new NegativeInt(0);
    }

    public function testRejectsPositiveIntMax(): void
    {
        $this->expectException(\ValueError::class);
        new NegativeInt(\PHP_INT_MAX);
    }

    public function testAcceptsNegativeIntMax(): void
    {
        $negativeInt = new NegativeInt(-\PHP_INT_MAX);
        $this->assertSame(-\PHP_INT_MAX, $negativeInt->toInt());
        $this->assertSame((string) -\PHP_INT_MAX, (string) $negativeInt);
    }
}
