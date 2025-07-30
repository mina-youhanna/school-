<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateStudyClassesGenderSeeder extends Seeder
{
    public function run()
    {
        // إضافة عمود النوع إذا لم يكن موجوداً
        if (!DB::getSchemaBuilder()->hasColumn('study_classes', 'gender')) {
            DB::statement('ALTER TABLE study_classes ADD COLUMN gender ENUM("ذكر", "أنثى", "مختلط") DEFAULT "ذكر" AFTER saint_image');
        }

        // تحديث النوع للفصول - أول 17 فصل للذكور والباقي للإناث
        $classes = DB::table('study_classes')->orderBy('id')->get();
        
        foreach ($classes as $index => $class) {
            $gender = $index < 17 ? 'ذكر' : 'أنثى';
            DB::table('study_classes')
                ->where('id', $class->id)
                ->update(['gender' => $gender]);
        }

        $this->command->info('تم تحديث النوع للفصول بنجاح!');
    }
}
