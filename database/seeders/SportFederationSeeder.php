<?php

namespace Database\Seeders;

use App\Models\SportFederation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SportFederationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportFederation::factory()->create([
            'name' => 'اتحاد كرة القدم',
            'description' => 'الاتحاد المسؤول عن إدارة أنشطة كرة القدم.'
        ]);

        SportFederation::factory()->create([
            'name' => 'اتحاد كرة السلة',
            'description' => 'الاتحاد المسؤول عن إدارة أنشطة كرة السلة.'
        ]);

        SportFederation::factory()->create([
            'name' => 'اتحاد السباحة',
            'description' => 'الاتحاد المسؤول عن إدارة أنشطة السباحة.'
        ]);

        SportFederation::factory()->create([
            'name' => 'اتحاد ألعاب القوى',
            'description' => 'الاتحاد المسؤول عن تنظيم مسابقات ألعاب القوى.'
        ]);

        SportFederation::factory()->create([
            'name' => 'اتحاد التنس',
            'description' => 'الاتحاد المسؤول عن إدارة أنشطة رياضة التنس.'
        ]);
    }
}
