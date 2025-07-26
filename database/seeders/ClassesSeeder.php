<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    public function run()
    {
        // فصول الأولاد
        $boysClasses = [
            [
                'name' => 'فصل الشهيد ونس',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الأول يسار الدور الخامس بالكنيسة',
                'saint_image' => 'storage/images/images.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديسين مكسيموس ودوماديوس',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور السادس يمين سان توماس',
                'saint_image' => 'storage/images/مكس.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل الشهيد مارمينا',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور الخامس يسار سان توماس',
                'saint_image' => 'storage/images/StMina.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس القوي الانباء موسى',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور الخامس يسار سان توماس',
                'saint_image' => 'storage/images/AvaMosa.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل الشهيد فيلوباتر مرقوريوس',
                'stage' => 'A3',
                'schedule' => '11:00 - 9:30',
                'place' => 'بلكون سان توماس قبليي',
                'saint_image' => 'storage/images/الشهيد فلوباتير ابو سيفين 6.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس بولس البسيط',
                'stage' => 'A3',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور السادس يسار سان توماس',
                'saint_image' => 'storage/images/1.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل الشهيد زيوس',
                'stage' => 'A3',
                'schedule' => '12:30 - 11:00',
                'place' => 'كنيسة الانباء توماس / بلكون دميانه بحري',
                'saint_image' => 'storage/images/2.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس الانباء مقار',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'بلكون الشهيدة دميانه قبلي / كنيسة الانباء توماس',
                'saint_image' => 'storage/images/3.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل الشهيد أبانوب النهيسي',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور السادس يسار سان توماس',
                'saint_image' => 'storage/images/4.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس يوسف النجار',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور السادس يمين سان توماس',
                'saint_image' => 'storage/images/5.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس ابونا بيشوي كامل',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'مكيف 1',
                'saint_image' => 'storage/images/6.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس ابونا يسطس الانطوني',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'مكيف 2',
                'saint_image' => 'storage/images/7.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل الشهيد الأمير تادرس',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور السادس وسط سان توماس',
                'saint_image' => 'storage/images/8.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس الانباء بولا',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور الخامس يسار سان توماس',
                'saint_image' => 'storage/images/9.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل القديس الانباء أنطونيوس',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور الخامس يمين سان توماس',
                'saint_image' => 'storage/images/10.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل الشهيد أيسخروون',
                'stage' => 'خاص',
                'schedule' => 'م9 - 8م (الأحد)',
                'place' => 'مكيف 1',
                'saint_image' => 'storage/images/11.jpg',
                'gender' => 'male'
            ],
            [
                'name' => 'فصل الانباء توماس السائح (الخدام)',
                'stage' => 'الخدام',
                'schedule' => 'م7 - 8.30م (السبت)',
                'place' => 'بلكون بحري',
                'saint_image' => 'storage/images/stthomas (3).jpg',
                'gender' => 'male'
            ]
        ];

        // فصول البنات
        $girlsClasses = [
            [
                'name' => 'فصل مريم المجدلية',
                'stage' => 'A2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/download(1).jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة فيلومينا',
                'stage' => 'A2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/download.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل العذارء مريم',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/image.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل القديسة فيرينا',
                'stage' => 'B1',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/11.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل داود النبي',
                'stage' => 'تمهيدي 1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'بلكون يسار - الانباء توماس',
                'saint_image' => 'storage/images/1602480917201442-0.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيد كرياكوس',
                'stage' => 'تمهيدي 1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'بلكون يمين - الانباء توماس',
                'saint_image' => 'storage/images/156363883991523.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الملكة اناسيمون',
                'stage' => 'تمهيدي 2',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 1 - الدور 6 بالكنيسة',
                'saint_image' => 'storage/images/7.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة بربارة',
                'stage' => 'تمهيدي 2',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 1 شمال - الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/6.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الملكة هيلانة',
                'stage' => 'A1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 4 يمين - الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/5.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة مارينا',
                'stage' => 'A1',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 3 يمين - الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/4.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/11.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة بربارة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/156363883991523.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة رفقة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/7.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/6.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/5.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/4.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/9-10.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'stage' => 'B2',
                'schedule' => 'الجمعة - 9:30 إلى 11:00',
                'place' => 'الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/images3.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشماسة فيبي',
                'stage' => 'خاص',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'البلكون وسط - الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/images.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الشهيدة دميانة',
                'stage' => 'خاص',
                'schedule' => 'الجمعة - 11:00 إلى 12:30',
                'place' => 'فصل 2 شمال - الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/القديسة-دميانة.jpg',
                'gender' => 'female'
            ],
            [
                'name' => 'فصل الخدمات',
                'stage' => 'خاص',
                'schedule' => 'الجمعة - 6:00',
                'place' => 'فصل 1 يمين - الدور 5 بالكنيسة',
                'saint_image' => 'storage/images/images1.jpg',
                'gender' => 'female'
            ]
        ];

        // إضافة فصول الأولاد
        foreach ($boysClasses as $class) {
            DB::table('study_classes')->insert($class);
        }

        // إضافة فصول البنات
        foreach ($girlsClasses as $class) {
            DB::table('study_classes')->insert($class);
        }
    }
} 