<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

enum StringEnum: string
{
    case Foo = 'foo';
    case Bar = 'bar';
}
