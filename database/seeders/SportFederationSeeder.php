<?php

namespace Database\Seeders;

use App\Models\SportFederation;
use Illuminate\Database\Seeder;

class SportFederationSeeder extends Seeder
{
    public function run(): void
    {
        // Football Federation
        $federation = SportFederation::create([
            'name' => 'الاتحاد الليبي لكرة القدم',
            'description' => 'الاتحاد الليبي لكرة القدم هو الهيئة المنظمة لكرة القدم في ليبيا',
            'phone' => '0218912345678',
            'email' => 'info@lff.ly',
            'website' => 'www.lff.ly',
            'facebook_page' => 'https://facebook.com/LibyanFF',
            'twitter_page' => 'https://twitter.com/LibyanFF',
        ]);

        $federation->addMediaFromUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9piADDc6VbC35-ed5_53xVf8WLDtq18NvXv111IvK2NqEwR3EjhLwmTJ9Nsd0KoS6QP8&usqp=CAU')
            ->toMediaCollection('logo');

        // Basketball Federation
        $federation = SportFederation::create([
            'name' => 'الاتحاد الليبي لكرة السلة',
            'description' => 'الاتحاد الليبي لكرة السلة هو الهيئة المنظمة لكرة السلة في ليبيا',
            'phone' => '0218913456789',
            'email' => 'info@lbf.ly',
            'website' => 'www.lbf.ly',
            'facebook_page' => 'https://facebook.com/LibyanBF',
            'twitter_page' => 'https://twitter.com/LibyanBF',
        ]);

        $federation->addMediaFromUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsmgLJz8KiRCOeqaFBXLNi3x65H2ZxLyOfLw&s')
            ->toMediaCollection('logo');

        // Handball Federation
        $federation = SportFederation::create([
            'name' => 'الاتحاد الليبي لكرة اليد',
            'description' => 'الاتحاد الليبي لكرة اليد هو الهيئة المنظمة لكرة اليد في ليبيا',
            'phone' => '0218914567890',
            'email' => 'info@lhf.ly',
            'website' => 'www.lhf.ly',
            'facebook_page' => 'https://facebook.com/LibyanHF',
            'twitter_page' => 'https://twitter.com/LibyanHF',
        ]);

        $federation->addMediaFromUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDYdvGIPcG5yiYhcEhYH5PPh0s1pvYuKZEfQ&s')
            ->toMediaCollection('logo');
    }
}
