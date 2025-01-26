<?php

namespace Database\Seeders;

use App\Enums\PlayerStateEnum;
use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        // Football Players
        $player = Player::create([
            'first_name' => 'محمد',
            'middle_name' => 'صفوت',
            'grandfather_name' => 'علي',
            'last_name' => 'الزاوي',
            'place_of_birth' => 'طرابلس',
            'date_of_birth' => '1995-03-15',
            'position' => 'مهاجم',
            'nationality' => 'ليبي',
            'national_number' => '19950315001',
            'tunic_number' => '10',
            'is_active' => true,
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://i.ibb.co/D7LvNCd/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'first_name' => 'أحمد',
            'middle_name' => 'المصراتي',
            'grandfather_name' => 'سالم',
            'last_name' => 'الشريف',
            'place_of_birth' => 'بنغازي',
            'date_of_birth' => '1998-07-22',
            'position' => 'وسط',
            'nationality' => 'ليبي',
            'national_number' => '19980722002',
            'tunic_number' => '8',
            'is_active' => true,
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://i.ibb.co/D7LvNCd/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'first_name' => 'علي',
            'middle_name' => 'العيساوي',
            'grandfather_name' => 'عبدالله',
            'last_name' => 'المرغني',
            'place_of_birth' => 'البيضاء',
            'date_of_birth' => '1997-11-30',
            'position' => 'مدافع',
            'nationality' => 'ليبي',
            'national_number' => '19971130003',
            'tunic_number' => '3',
            'is_active' => true,
            'state' => PlayerStateEnum::Injured,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://i.ibb.co/D7LvNCd/team-m1.png')
            ->toMediaCollection('avatar');

        // Add more players following the same structure...

        // Basketball Players
        $player = Player::create([
            'first_name' => 'محمد',
            'middle_name' => 'الزوي',
            'grandfather_name' => 'حسن',
            'last_name' => 'الدالي',
            'place_of_birth' => 'مصراتة',
            'date_of_birth' => '1999-04-12',
            'position' => 'صانع ألعاب',
            'nationality' => 'ليبي',
            'national_number' => '19990412004',
            'tunic_number' => '12',
            'is_active' => true,
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://i.ibb.co/D7LvNCd/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'first_name' => 'عمر',
            'middle_name' => 'التاورغي',
            'grandfather_name' => 'عبدالرحمن',
            'last_name' => 'السنوسي',
            'place_of_birth' => 'الخمس',
            'date_of_birth' => '1996-08-25',
            'position' => 'جناح',
            'nationality' => 'ليبي',
            'national_number' => '19960825005',
            'tunic_number' => '7',
            'is_active' => true,
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://i.ibb.co/D7LvNCd/team-m1.png')
            ->toMediaCollection('avatar');
    }
}
