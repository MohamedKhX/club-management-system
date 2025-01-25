<?php

namespace App\Enums;

use App\Traits\Enum;

enum ClubTypeEnum: string
{
    use Enum;

    case PremierLeague = 'Premier League';
    case FirstDivisionLeague = 'First Division League';
    case SecondDivisionLeague = 'Second Division League';
    case ThirdDivisionLeague = 'Third Division League';
}
