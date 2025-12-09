<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

abstract class AbstractEnumBackedIntMask
{
    public readonly int $value;

    /**
     * @param \BackedEnum $flags these can only be int backed enums
     *
     * @throws \InvalidArgumentException if passed flags are not int backed enums
     */
    public function __construct(\BackedEnum ...$flags)
    {
        $value = 0;
        foreach ($flags as $flag) {
            if (! \is_int($flag->value)) {
                throw new \InvalidArgumentException('only int backed enums are supported');
            }
            $value |= $flag->value;
        }

        $this->value = $value;
    }
}
