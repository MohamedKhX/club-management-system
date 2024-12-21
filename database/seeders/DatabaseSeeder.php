<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call(SportFederationSeeder::class);
        $this->call(ClubSeeder::class);

        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@admin.com',
            'type'  => UserTypeEnum::Admin,
            'sport_federation_id' => 1,
            'club_id' => 1
        ]);

        $this->call(PlayerSeeder::class);
        $this->call(ReportSeeder::class);
    }
}
