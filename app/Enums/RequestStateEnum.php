<?php

namespace App\Enums;

use App\Traits\Enum;

enum RequestStateEnum: string
{
    use Enum;

    case Pending = 'Pending';
    case Approved = 'Approved';
    case Rejected = 'Rejected';
}
