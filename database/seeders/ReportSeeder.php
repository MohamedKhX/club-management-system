<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        Report::factory()->create([
            'title' => 'إلغاء مباراة',
            'content' => 'تم إلغاء المباراة بسبب سوء الأحوال الجوية وتأجيلها إلى إشعار آخر.',
            'club_id' => random_int(1, 4),
            'sport_federation_id' => 1,
        ]);

        Report::factory()->create([
            'title' => 'تأجيل مباراة',
            'content' => 'تم تأجيل المباراة المقررة اليوم بسبب مشكلة في الملعب.',
            'club_id' => random_int(1, 4),
            'sport_federation_id' => 1,
        ]);

        Report::factory()->create([
            'title' => 'إلغاء مباراة بسبب الظروف الأمنية',
            'content' => 'تم إلغاء المباراة نتيجة الظروف الأمنية الحالية في المنطقة.',
            'club_id' => random_int(1, 4),
            'sport_federation_id' => 1,
        ]);

        Report::factory()->create([
            'title' => 'شكوى حول سوء تنظيم المباراة',
            'content' => 'واجه الفريق مشاكل في دخول اللاعبين إلى الملعب بسبب سوء التنظيم.',
            'club_id' => random_int(1, 4),
            'sport_federation_id' => 1,
        ]);

        Report::factory()->create([
            'title' => 'شكوى من تأخر بدء المباراة',
            'content' => 'تأخرت المباراة عن الموعد المحدد بسبب غياب الحكام في الوقت المحدد.',
            'club_id' => random_int(1, 4),
            'sport_federation_id' => 1,
        ]);
    }
}
