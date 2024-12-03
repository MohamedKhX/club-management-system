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
        User::factory()->create([
            'name'  => 'Admin',
            'email' => 'admin@admin.com',
            'type'  => UserTypeEnum::Admin,
        ]);

        $this->call(SportFederationSeeder::class);
        $this->call(ClubSeeder::class);
        $this->call(PlayerSeeder::class);
        $this->call(ReportSeeder::class);
    }
}
