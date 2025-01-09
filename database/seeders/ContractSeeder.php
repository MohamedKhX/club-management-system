<?php

namespace Database\Seeders;

use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    public function run(): void
    {
        // Contracts for Al-Ahli Tripoli
        Contract::create([
            'player_id' => 1, // محمد صفوت
            'club_id' => 1,   // الأهلي طرابلس
            'sport_federation_id' => 1,
            'start_date' => '2023-07-01',
            'end_date' => '2024-06-30',
            'signed_date' => '2023-06-15',
            'amount' => 150000,
        ]);

        Contract::create([
            'player_id' => 4, // مؤيد اللافي
            'club_id' => 1,   // الأهلي طرابلس
            'sport_federation_id' => 1,
            'start_date' => '2023-08-01',
            'end_date' => '2025-07-31',
            'signed_date' => '2023-07-15',
            'amount' => 200000,
        ]);

        // Contracts for Al-Ittihad
        Contract::create([
            'player_id' => 2, // أحمد المصراتي
            'club_id' => 2,   // الاتحاد
            'sport_federation_id' => 1,
            'start_date' => '2023-07-01',
            'end_date' => '2024-06-30',
            'signed_date' => '2023-06-20',
            'amount' => 180000,
        ]);

        Contract::create([
            'player_id' => 5, // حمدو الهوني
            'club_id' => 2,   // الاتحاد
            'sport_federation_id' => 1,
            'start_date' => '2023-09-01',
            'end_date' => '2025-08-31',
            'signed_date' => '2023-08-15',
            'amount' => 250000,
        ]);

        // Contracts for Al-Ahli Benghazi
        Contract::create([
            'player_id' => 3, // علي العيساوي
            'club_id' => 3,   // الأهلي بنغازي
            'sport_federation_id' => 1,
            'start_date' => '2023-07-01',
            'end_date' => '2024-06-30',
            'signed_date' => '2023-06-25',
            'amount' => 160000,
        ]);

        // Basketball Contracts
        Contract::create([
            'player_id' => 6, // محمد الزوي
            'club_id' => 4,   // المروج
            'sport_federation_id' => 2,
            'start_date' => '2023-09-01',
            'end_date' => '2024-08-31',
            'signed_date' => '2023-08-20',
            'amount' => 120000,
        ]);

        Contract::create([
            'player_id' => 7, // عمر التاورغي
            'club_id' => 5,   // النصر
            'sport_federation_id' => 2,
            'start_date' => '2023-08-01',
            'end_date' => '2024-07-31',
            'signed_date' => '2023-07-20',
            'amount' => 130000,
        ]);
    }
}
