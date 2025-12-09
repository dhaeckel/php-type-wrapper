<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\NonEmptyString;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(NonEmptyString::class)]
class NonEmptyStringTest extends TestCase
{
    public function testRejectsEmptyString(): void
    {
        $this->expectException(\ValueError::class);
        new NonEmptyString('');
    }

    public function testAcceptsNonEmptyString(): void
    {
        $nonEmptyString = new NonEmptyString('Hello, World!');
        $this->assertSame('Hello, World!', (string) $nonEmptyString);
    }
}
