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
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'أحمد سالم',
            'date_of_birth' => '2000-07-20',
            'position' => 'مدافع',
            'nationality' => 'ليبي',
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'سامي خالد',
            'date_of_birth' => '1995-12-10',
            'position' => 'حارس مرمى',
            'nationality' => 'تونسي',
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'محمد السواق (عبد الله الشحات)',
            'date_of_birth' => '2002-05-05',
            'position' => 'لاعب وسط',
            'nationality' => 'مصري',
            'sport_federation_id' => 1,
        ]);

        Player::factory()->create([
            'name' => 'يوسف ناصر',
            'date_of_birth' => '1999-09-25',
            'position' => 'جناح',
            'nationality' => 'جزائري',
            'sport_federation_id' => 1,
        ]);
    }
}
