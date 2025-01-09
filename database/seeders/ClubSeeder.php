<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
    public function run(): void
    {
        // Football Clubs
        $club = Club::create([
            'name' => 'الأهلي طرابلس',
            'description' => 'نادي الأهلي طرابلس هو نادٍ رياضي ليبي تأسس عام 1950 في مدينة طرابلس',
            'location' => 'طرابلس، ليبيا',
            'founded_date' => '1950-08-29',
            'phone' => '0218912345678',
            'email' => 'info@alahli-tripoli.ly',
            'website' => 'www.alahli-tripoli.ly',
            'sport_federation_id' => 1,
        ]);

        $club->addMediaFromUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaqOg5ouXYjSVvp5M4AmDK8wJTnLsNAFGPwA&s')
            ->toMediaCollection('logo');

        $club = Club::create([
            'name' => 'الاتحاد',
            'description' => 'نادي الاتحاد هو نادٍ رياضي ليبي تأسس عام 1944 في مدينة طرابلس',
            'location' => 'طرابلس، ليبيا',
            'founded_date' => '1944-01-01',
            'phone' => '0218913456789',
            'email' => 'info@alittihad.ly',
            'website' => 'www.alittihad.ly',
            'sport_federation_id' => 1,
        ]);

        $club->addMediaFromUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQszX08BCgIAhmAahX3r92tXB_v_dC8Y4n6Bg&s')
            ->toMediaCollection('logo');

        $club = Club::create([
            'name' => 'الأهلي بنغازي',
            'description' => 'نادي الأهلي بنغازي هو نادٍ رياضي ليبي تأسس عام 1947 في مدينة بنغازي',
            'location' => 'بنغازي، ليبيا',
            'founded_date' => '1947-03-15',
            'phone' => '0218914567890',
            'email' => 'info@alahli-benghazi.ly',
            'website' => 'www.alahli-benghazi.ly',
            'sport_federation_id' => 1,
        ]);

        $club->addMediaFromUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7ckgzwnX1X0Ki16VnmoVpiLQD6FPDMTSjng&s')
            ->toMediaCollection('logo');

        // Basketball Clubs
        $club = Club::create([
            'name' => 'المروج',
            'description' => 'نادي المروج لكرة السلة هو أحد أعرق الأندية الليبية في كرة السلة',
            'location' => 'طرابلس، ليبيا',
            'founded_date' => '1960-05-20',
            'phone' => '0218915678901',
            'email' => 'info@almorouj.ly',
            'sport_federation_id' => 2,
        ]);

        $club->addMediaFromUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2ZQZzBqcvCxkcewkLD270m1EVEUWQJw2HgQ&s')
            ->toMediaCollection('logo');


        $club = Club::create([
            'name' => 'النصر',
            'description' => 'نادي النصر هو نادٍ رياضي ليبي تأسس في مدينة بنغازي',
            'location' => 'بنغازي، ليبيا',
            'founded_date' => '1954-06-10',
            'phone' => '0218916789012',
            'email' => 'info@alnasr.ly',
            'sport_federation_id' => 2,
        ]);

        $club->addMediaFromUrl('https://upload.wikimedia.org/wikipedia/ar/6/60/Nasr_Benghazi.png')
            ->toMediaCollection('logo');

    }
}
