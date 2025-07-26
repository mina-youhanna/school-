<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SundayClass;

class SundayClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'name' => 'فصل مريم المجدلية',
                'saint_image' => 'images/download(1).jpg',
                'stage' => 'A2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'servants' => json_encode(['مونيكا ناثان', 'ناردين غبريال', 'ماريا سبعاوي', 'كيرمينا منير']),
            ],
            [
                'name' => 'فصل الشهيدة فيلومينا',
                'saint_image' => 'images/download.jpg',
                'stage' => 'A2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'servants' => json_encode(['سيلفيا رأفت', 'روفينا يوسف', 'جومانا نادر']),
            ],
            [
                'name' => 'فصل العذارء مريم',
                'saint_image' => 'images/image.jpg',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'servants' => json_encode(['كريستين نادي', 'دينا رمزي', 'مونيكا عاطف']),
            ],
            [
                'name' => 'فصل القديسة فيرينا',
                'saint_image' => 'images/11.jpg',
                'stage' => 'B1',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'servants' => json_encode(['كريستين فارس', 'نورهان راضي', 'مارينا عزت', 'مارينا كمال']),
            ],
            [
                'name' => 'فصل داود النبي',
                'saint_image' => 'images/1602480917201442-0.jpg',
                'stage' => 'تمهيدي 1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'بلكون يسار - الانباء توماس',
                'servants' => json_encode(['جورجينا جميل', 'سيلفانا عبد المسيح', 'سارة سامي', 'ساندرا عزمى','مارتينا جمال']),
            ],
            [
                'name' => 'فصل الشهيد كرياكوس',
                'saint_image' => 'images/156363883991523.jpg',
                'stage' => 'تمهيدي 1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'بلكون يمين - الانباء توماس',
                'servants' => json_encode(['فيفيان فايق', 'مهرائيل ممدوح','فيولا منير','ساندرا فادي','مريم مجدى']),
            ],
            [
                'name' => 'فصل الملكة اناسيمون',
                'saint_image' => 'images/7.jpg',
                'stage' => 'تمهيدي 2',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 1 - الدور 6 بالكنيسة',
                'servants' => json_encode(['اناسيمون مدحت', 'جورجيت نعيم','اميرة صبحي' ,'مريم جمال', 'ميرا موريس']),
            ],
            [
                'name' => 'فصل الشهيدة بربارة',
                'saint_image' => 'images/6.jpg',
                'stage' => 'تمهيدي 2',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 1 شمال - الدور 5 بالكنيسة',
                'servants' => json_encode(['سارة نبيل', 'ناردين ونجت', 'أميرة بخيت', 'مارجليت صبحي', 'كاترين جاد الله']),
            ],
            [
                'name' => 'فصل الملكة هيلانة',
                'saint_image' => 'images/5.jpg',
                'stage' => 'A1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 4 يمين - الدور 5 بالكنيسة',
                'servants' => json_encode(['مارينا كمال', 'سيلفيا رأفت', 'برناديت', 'سيلفيا عزمي', 'يؤانا سمير']),
            ],
            [
                'name' => 'فصل الشهيدة مارينا',
                'saint_image' => 'images/4.jpg',
                'stage' => 'A1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 3 يمين - الدور 5 بالكنيسة',
                'servants' => json_encode(['ميرنا إميل', 'نورهان راضي', 'سالي ناجي', 'روفينا يوسف', 'ماران ناصر']),
            ],
            [
                'name' => 'فصل الشهيدة يوليطة',
                'saint_image' => 'images/9-10.jpg',
                'stage' => 'A2',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 2 - الدور 6 بالكنيسة',
                'servants' => json_encode(['مارينا موريس', 'سميرة نادي', 'نادين صبري', 'ميرنا عبيد', 'أوريم ناصر']),
            ],
            [
                'name' => 'فصل الشهيدة رفقة',
                'saint_image' => 'images/images3.jpg',
                'stage' => 'A3',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 3 - الدور 6 بالكنيسة',
                'servants' => json_encode(['راحيل إسحق', 'جومانا نادر', 'كيرمينا منير', 'ناردين غبريال']),
            ],
            [
                'name' => 'فصل الشماسة فيبي',
                'saint_image' => 'images/images.jpg',
                'stage' => 'خاص',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'البلكون وسط - الدور 5 بالكنيسة',
                'servants' => json_encode(['يوستينا ناثان', 'مارينا ميلاد']),
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'saint_image' => 'images/القديسة-دميانة.jpg',
                'stage' => 'خاص ',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 2 شمال - الدور 5 بالكنيسة',
                'servants' => json_encode(['مريم صدقي', 'مارينا داود']),
            ],
            [
                'name' => 'فصل الخدمات',
                'saint_image' => 'images/images1.jpg',
                'stage' => 'خاص',
                'schedule' => 'الجمعة - 6:00',
                'place' => 'فصل 1 يمين - الدور 5 بالكنيسة',
                'servants' => json_encode(['فيفيان كامل', 'مريم صدقي', 'مريم مجدي']),
            ],
        ];

        foreach ($classes as $class) {
            SundayClass::create($class);
        }
    }
}
