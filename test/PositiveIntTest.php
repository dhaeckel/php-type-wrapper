<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\PositiveInt;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PositiveInt::class)]
class PositiveIntTest extends TestCase
{
    public function testRejectsZero(): void
    {
        $this->expectException(\ValueError::class);
        new PositiveInt(0);
    }

    public function testRejectsNegativeIntMax(): void
    {
        $this->expectException(\ValueError::class);
        new PositiveInt(-\PHP_INT_MAX);
    }

    public function testAcceptsPositiveIntMax(): void
    {
        $positiveInt = new PositiveInt(\PHP_INT_MAX);
        $this->assertSame(\PHP_INT_MAX, $positiveInt->toInt());
        $this->assertSame((string) \PHP_INT_MAX, (string) $positiveInt);
    }
}
