<?php

namespace App\Enums;

use App\Traits\Enum;

enum ContractStateEnum: string
{
    use Enum;

    case NotStarted = "Not Started";
    case Expired = "Expired";
    case Active = 'Active';
}
