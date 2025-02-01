<?php


use App\Enums\ClubTypeEnum;
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

    'request_state_enum' => [
        RequestStateEnum::Pending->value => 'قيد الانتظار',
        RequestStateEnum::Approved->value => 'موافقة',
        RequestStateEnum::Rejected->value => 'مرفوض',
    ],

    'request_type_enum' => [
        RequestTypeEnum::PlayerRegistration->value => 'تسجيل لاعب',
        RequestTypeEnum::PlayerCreation->value => 'إنشاء لاعب',
        RequestTypeEnum::PlayerPurchase->value => 'شراء لاعب',
        RequestTypeEnum::PlayerLoan->value => 'إعارة لاعب',
        RequestTypeEnum::TerminationOfContract->value => 'فسخ عقد',
    ],

    'club_type_enum' => [
        ClubTypeEnum::PremierLeague->value => 'الدوري الممتاز',
        ClubTypeEnum::FirstDivisionLeague->value => 'الدوري الدرجة الأولى',
        ClubTypeEnum::SecondDivisionLeague->value => 'الدوري الدرجة الثانية',
        ClubTypeEnum::ThirdDivisionLeague->value => 'الدوري الدرجة الثالثة',
    ],
];
