<?php

namespace App\Enums;

use App\Traits\Enum;

enum ContractTypeEnum: string
{
    use Enum;

    case PlayerRegistration = "Player Registration";
    case PlayerPurchase     = "Player Purchase";
    case PlayerLoan         = "Player Loan";
}
