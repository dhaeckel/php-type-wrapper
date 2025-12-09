<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper\Test;

enum ArrayFilterModeFlag: int
{
    case UseKey = \ARRAY_FILTER_USE_KEY;
    case UseBoth = \ARRAY_FILTER_USE_BOTH;
}
