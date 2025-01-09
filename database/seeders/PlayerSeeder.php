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
            'name' => 'محمد صفوت',
            'date_of_birth' => '1995-03-15',
            'position' => 'مهاجم',
            'nationality' => 'ليبي',
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://club-management-system.laraplay.fun/images/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'name' => 'أحمد المصراتي',
            'date_of_birth' => '1998-07-22',
            'position' => 'وسط',
            'nationality' => 'ليبي',
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://club-management-system.laraplay.fun/images/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'name' => 'علي العيساوي',
            'date_of_birth' => '1997-11-30',
            'position' => 'مدافع',
            'nationality' => 'ليبي',
            'state' => PlayerStateEnum::Injured,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://club-management-system.laraplay.fun/images/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'name' => 'مؤيد اللافي',
            'date_of_birth' => '1996-04-12',
            'position' => 'جناح',
            'nationality' => 'ليبي',
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://club-management-system.laraplay.fun/images/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'name' => 'حمدو الهوني',
            'date_of_birth' => '1994-08-15',
            'position' => 'مهاجم',
            'nationality' => 'ليبي',
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 1,
        ]);
        $player->addMediaFromUrl('https://club-management-system.laraplay.fun/images/team-m1.png')
            ->toMediaCollection('avatar');

        // Basketball Players
        $player = Player::create([
            'name' => 'محمد الزوي',
            'date_of_birth' => '1999-04-12',
            'position' => 'صانع ألعاب',
            'nationality' => 'ليبي',
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 2,
        ]);
        $player->addMediaFromUrl('https://club-management-system.laraplay.fun/images/team-m1.png')
            ->toMediaCollection('avatar');

        $player = Player::create([
            'name' => 'عمر التاورغي',
            'date_of_birth' => '1996-08-25',
            'position' => 'جناح',
            'nationality' => 'ليبي',
            'state' => PlayerStateEnum::Active,
            'sport_federation_id' => 2,
        ]);
        $player->addMediaFromUrl('https://club-management-system.laraplay.fun/images/team-m1.png')
            ->toMediaCollection('avatar');
    }
}
