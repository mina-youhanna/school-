<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SundayClass;

class BoysClassesSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            [
                'name' => 'فصل الشهيد ونس',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الأول يسار الدور الخامس بالكنيسة',
                'servants' => 'أ/ بيتر حشمت,مينا عادل',
                'saint_image' => './images.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديسين مكسيموس ودوماديوس',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور السادس يمين سان توماس',
                'servants' => 'يوسف سعد,بيشوي وجدي',
                'saint_image' => './مكس.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل الشهيد مارمينا',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور الخامس يسار سان توماس',
                'servants' => 'مينا منير,بيشوي سبعاوي,كيرلس عادل جاد',
                'saint_image' => './StMina.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس القوي الانباء موسى',
                'stage' => 'B2',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور الخامس يسار سان توماس',
                'servants' => 'كيرلس جمال,علاء عزيز,جرجس نبيل',
                'saint_image' => './AvaMosa.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل الشهيد فيلوباتر مرقوريوس',
                'stage' => 'A3',
                'schedule' => '11:00 - 9:30',
                'place' => 'بلكون سان توماس قبليي',
                'servants' => 'توني عماد,روماريو عصام,أبرام رمزي',
                'saint_image' => './الشهيد فلوباتير ابو سيفين 6.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس بولس البسيط',
                'stage' => 'A3',
                'schedule' => '11:00 - 9:30',
                'place' => 'الدور السادس يسار سان توماس',
                'servants' => 'ابانوب حنا,ابانوب هاني',
                'saint_image' => './1.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل الشهيد زيوس',
                'stage' => 'A3',
                'schedule' => '12:30 - 11:00',
                'place' => 'كنيسة الانباء توماس / بلكون دميانه بحري',
                'servants' => 'مينا عدلي,بيشوي ماهر,اسطفانوس كمال',
                'saint_image' => './2.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس الانباء مقار',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'بلكون الشهيدة دميانه قبلي / كنيسة الانباء توماس',
                'servants' => 'جورج وهيب,توماس نادي,فادي عوض',
                'saint_image' => './3.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل الشهيد أبانوب النهيسي',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور السادس يسار سان توماس',
                'servants' => 'فادي سمير,بيشوي راضي,أبانوب هاني فرج',
                'saint_image' => './4.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس يوسف النجار',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور السادس يمين سان توماس',
                'servants' => 'ماركو فايق,ماركو القصص,أبانوب مجدي,يوسف صلاح',
                'saint_image' => './5.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس ابونا بيشوي كامل',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'مكيف 1',
                'servants' => 'مينا القصص,خيري مجدي,أبانوب رافت',
                'saint_image' => './6.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس ابونا يسطس الانطوني',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'مكيف 2',
                'servants' => 'أبانوب لمعي,أبرام عزيز,جيوفاني القس',
                'saint_image' => './7.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل الشهيد الأمير تادرس',
                'stage' => 'A2',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور السادس وسط سان توماس',
                'servants' => 'مينا ماهر,بولا معوض,أبانوب أيمن',
                'saint_image' => './8.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس الانباء بولا',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور الخامس يسار سان توماس',
                'servants' => 'كيرلس جميل,أبانوب كامل,ماجد إسحاق',
                'saint_image' => './9.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل القديس الانباء أنطونيوس',
                'stage' => 'A1',
                'schedule' => '12:30 - 11:00',
                'place' => 'الدور الخامس يمين سان توماس',
                'servants' => 'علام عزيز,بيشوي سليمان,عماد فرج الله',
                'saint_image' => './10.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل الشهيد أيسخروون',
                'stage' => 'خاص',
                'schedule' => 'م9 - 8م (الأحد)',
                'place' => 'مكيف 1',
                'servants' => 'راضي عجبان,يوسف صلاح',
                'saint_image' => './11.jpg',
                'registered_count' => 0
            ],
            [
                'name' => 'فصل الانباء توماس السائح (الخدام)',
                'stage' => 'الخدام',
                'schedule' => 'م7 - 8.30م (السبت)',
                'place' => 'بلكون بحري',
                'servants' => 'القس بافلي حنا,أ/ بيتر حشمت,أ/ ناجي جميل',
                'saint_image' => './stthomas (3).jpg',
                'registered_count' => 0
            ]
        ];

        foreach ($classes as $class) {
            SundayClass::create($class);
        }
    }
} 