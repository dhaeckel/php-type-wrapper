<?php

declare(strict_types=1);

namespace Haeckel\TypeWrapper;

enum LegacyRoundMode: int
{
    case HalfAwayFromZero = \PHP_ROUND_HALF_UP;
    case HalfTowardsZero = \PHP_ROUND_HALF_DOWN;
    case HalfEven = \PHP_ROUND_HALF_EVEN;
    case HalfOdd = \PHP_ROUND_HALF_ODD;
}
