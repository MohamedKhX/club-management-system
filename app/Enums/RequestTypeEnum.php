<?php

namespace App\Enums;

use App\Traits\Enum;

enum RequestTypeEnum: string
{
    use Enum;

    case PlayerRegistration = "Player Registration";
    case PlayerCreation = "Player Creation";
    case PlayerPurchase     = "Player Purchase";
    case PlayerLoan         = "Player Loan";

    case TerminationOfContract = 'Termination of Contract';
}
