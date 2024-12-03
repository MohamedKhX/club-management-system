<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Player::factory()->create([
            'name' => 'محمد علي',
            'date_of_birth' => '1998-03-15',
            'position' => 'مهاجم',
            'nationality' => 'ليبي',
            'club_id' => 1,
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'أحمد سالم',
            'date_of_birth' => '2000-07-20',
            'position' => 'مدافع',
            'nationality' => 'ليبي',
            'club_id' => 1,
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'سامي خالد',
            'date_of_birth' => '1995-12-10',
            'position' => 'حارس مرمى',
            'nationality' => 'تونسي',
            'club_id' => 1,
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'عمر عبد الله',
            'date_of_birth' => '2002-05-05',
            'position' => 'لاعب وسط',
            'nationality' => 'مصري',
            'club_id' => 1,
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'يوسف ناصر',
            'date_of_birth' => '1999-09-25',
            'position' => 'جناح',
            'nationality' => 'جزائري',
            'club_id' => 1,
            'sport_federation_id' => 1,
        ]);
    }
}
