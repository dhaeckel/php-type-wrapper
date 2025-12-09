<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\AbstractEnumBackedIntMask;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AbstractEnumBackedIntMask::class)]
class AbstractEnumBackedIntMaskTest extends TestCase
{
    public function testWithMultipleFlags(): void
    {
        $mask = new ArrayFilterMode(
            ArrayFilterModeFlag::UseKey,
            ArrayFilterModeFlag::UseBoth,
        );

        $this->assertSame(
            \ARRAY_FILTER_USE_KEY | \ARRAY_FILTER_USE_BOTH,
            $mask->value,
        );
    }

    public function testWithSingleFlag(): void
    {
        $mask = new ArrayFilterMode(
            ArrayFilterModeFlag::UseKey,
        );

        $this->assertSame(
            \ARRAY_FILTER_USE_KEY,
            $mask->value,
        );
    }

    public function testWithNoFlags(): void
    {
        $mask = new ArrayFilterMode();

        $this->assertSame(
            0,
            $mask->value,
        );
    }

    public function testWithInvalidEnumTypeThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('only int backed enums are supported');

        new class (StringEnum::Foo, StringEnum::Bar) extends AbstractEnumBackedIntMask {
            public function __construct(StringEnum ...$flags)
            {
                parent::__construct(...$flags);
            }
        };
    }
}
