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

        $federation->addMediaFromUrl('https://scontent.fmji3-1.fna.fbcdn.net/v/t39.30808-6/347431129_249064861165507_5906586683997689020_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=MtA7Vq996ckQ7kNvgHHv7Pq&_nc_zt=23&_nc_ht=scontent.fmji3-1.fna&_nc_gid=AGpCX0TKrQRPix4hcILjMU2&oh=00_AYA1AKtspYYrJ_T6z9jSenPCU4CoF7fFygcpEXvsUECr_w&oe=6785413D')
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
