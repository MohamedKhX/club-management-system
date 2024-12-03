<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Club::factory()->create([
            'name' => 'الأهلي بنغازي',
            'description' => 'أحد أقدم وأشهر الأندية الرياضية في ليبيا.',
            'location' => 'بنغازي، ليبيا',
            'founded_date' => now(),
            'sport_federation_id' => 1,
        ]);

        Club::factory()->create([
            'name' => 'الترجي التونسي',
            'description' => 'نادي رياضي تونسي يقع في العاصمة تونس.',
            'location' => 'تونس العاصمة، تونس',
            'founded_date' => now(),
            'sport_federation_id' => 1,
        ]);

        Club::factory()->create([
            'name' => 'الاتحاد السكندري',
            'description' => 'نادي رياضي يقع في مدينة الإسكندرية بمصر.',
            'location' => 'الإسكندرية، مصر',
            'founded_date' => now(),
            'sport_federation_id' => 1,
        ]);

        Club::factory()->create([
            'name' => 'النصر الليبي',
            'description' => 'نادي رياضي يقع في العاصمة طرابلس ويعد من أبرز الأندية الليبية.',
            'location' => 'طرابلس، ليبيا',
            'founded_date' => now(),
            'sport_federation_id' => 1,
        ]);

        Club::factory()->create([
            'name' => 'الأهلي طرابلس',
            'description' => 'نادي رياضي مميز في ليبيا، يعرف بإنجازاته العديدة في كرة القدم.',
            'location' => 'طرابلس، ليبيا',
            'founded_date' => now(),
            'sport_federation_id' => 1,
        ]);
    }
}
