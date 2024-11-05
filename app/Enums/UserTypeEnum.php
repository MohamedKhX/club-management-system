<?php

namespace App\Enums;

use App\Traits\Enum;

enum UserTypeEnum: string
{
    use Enum;

    case Admin           = 'Admin';
    case SportFederation = 'Sport Federation Manager';
    case ClubManager     = 'Club Manager';
}
