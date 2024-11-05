<?php


use App\Enums\PlayerStateEnum;
use App\Enums\RequestStateEnum;
use App\Enums\RequestTypeEnum;

return [
    'player_state_enum' => [
        PlayerStateEnum::Active->value    => 'نشط',
        PlayerStateEnum::Inactive->value  => 'غير نشط',
        PlayerStateEnum::Injured->value   => 'مصاب',
        PlayerStateEnum::Suspended->value => 'معلق',
    ],

    'request_type_enum' => [
        RequestStateEnum::Pending->value => 'قيد الانتظار',
        RequestStateEnum::Approved->value => 'موافقة',
        RequestStateEnum::Rejected->value => 'مرفوض',
    ],

    'request_state_enum' => [
        RequestTypeEnum::PlayerRegistration->value => 'تسجيل لاعب',
        RequestTypeEnum::PlayerPurchase->value => 'شراء لاعب',
        RequestTypeEnum::PlayerLoan->value => 'إعارة لاعب',
    ],
];
