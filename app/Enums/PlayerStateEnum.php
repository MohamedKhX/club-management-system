<?php

namespace App\Enums;

use App\Traits\Enum;

enum PlayerStateEnum: string
{
    use Enum;

    case Active    = 'Active';
    case Inactive  = 'Inactive';
    case Injured   = 'injured';
    case Suspended = 'Suspended';

}
