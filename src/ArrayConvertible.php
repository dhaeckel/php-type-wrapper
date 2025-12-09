<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

interface ArrayConvertible
{
    /** @return array<string,mixed> */
    public function toArray(): array;
}
