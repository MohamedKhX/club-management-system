<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Sport Federations and Clubs
        $this->call([
            SportFederationSeeder::class,
            ClubSeeder::class,
            PlayerSeeder::class,
            ContractSeeder::class,
        ]);

        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'type' => UserTypeEnum::Admin,
        ]);

        // Create Sport Federation Users
        User::create([
            'name' => 'مدير اتحاد كرة القدم',
            'email' => 'football@federation.ly',
            'password' => bcrypt('password'),
            'type' => UserTypeEnum::SportFederation,
            'sport_federation_id' => 1,
        ]);

        User::create([
            'name' => 'مدير اتحاد كرة السلة',
            'email' => 'basketball@federation.ly',
            'password' => bcrypt('password'),
            'type' => UserTypeEnum::SportFederation,
            'sport_federation_id' => 2,
        ]);

        User::create([
            'name' => 'مدير اتحاد كرة اليد',
            'email' => 'handball@federation.ly',
            'password' => bcrypt('password'),
            'type' => UserTypeEnum::SportFederation,
            'sport_federation_id' => 3,
        ]);

        // Create Club Users
        User::create([
            'name' => 'مدير الأهلي طرابلس',
            'email' => 'ahli.tripoli@club.ly',
            'password' => bcrypt('password'),
            'type' => UserTypeEnum::ClubManager,
            'club_id' => 1,
        ]);

        User::create([
            'name' => 'مدير الاتحاد',
            'email' => 'ittihad@club.ly',
            'password' => bcrypt('password'),
            'type' => UserTypeEnum::ClubManager,
            'club_id' => 2,
        ]);

        User::create([
            'name' => 'مدير الأهلي بنغازي',
            'email' => 'ahli.benghazi@club.ly', 
            'password' => bcrypt('password'),
            'type' => UserTypeEnum::ClubManager,
            'club_id' => 3,
        ]);
    }
}
