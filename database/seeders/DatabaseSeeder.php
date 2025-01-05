<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\Club;
use App\Models\SportFederation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@admin.com',
            'type'  => UserTypeEnum::Admin,
        ]);

        $sportFederation = SportFederation::factory()->create();
        $club = Club::factory()->create([
            'sport_federation_id' => $sportFederation->id,
        ]);

        $sportUser = User::factory()->create([
            'type' => UserTypeEnum::SportFederation,
            'sport_federation_id' => $sportFederation->id,
            'email' => 'sport@sport.com'
        ]);

        $clubUser = User::factory()->create([
            'type' => UserTypeEnum::ClubManager,
            'club_id' => $club->id,
            'email' => 'club@club.com'
        ]);
    }
}
