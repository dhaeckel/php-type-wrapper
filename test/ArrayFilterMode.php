<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

use Haeckel\TypeWrapper\AbstractEnumBackedIntMask;

class ArrayFilterMode extends AbstractEnumBackedIntMask
{
    public function __construct(ArrayFilterModeFlag ...$flags)
    {
        parent::__construct(...$flags);
    }
}
