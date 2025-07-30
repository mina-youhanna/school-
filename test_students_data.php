<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    // إضافة طلاب تجريبيين للفصل 32
    $students = [
        [
            'full_name' => 'أحمد محمد علي',
            'email' => 'ahmed.mohamed@example.com',
            'phone' => '0123456789',
            'my_class_id' => 32,
            'is_main_servant' => 1,
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'full_name' => 'فاطمة أحمد حسن',
            'email' => 'fatima.ahmed@example.com',
            'phone' => '0123456790',
            'my_class_id' => 32,
            'is_main_servant' => 0,
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'full_name' => 'محمد علي أحمد',
            'email' => 'mohamed.ali@example.com',
            'phone' => '0123456791',
            'my_class_id' => 32,
            'is_main_servant' => 0,
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'full_name' => 'سارة محمود حسن',
            'email' => 'sara.mahmoud@example.com',
            'phone' => '0123456792',
            'my_class_id' => 32,
            'is_main_servant' => 0,
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'full_name' => 'علي محمد فتحي',
            'email' => 'ali.mohamed@example.com',
            'phone' => '0123456793',
            'my_class_id' => 32,
            'is_main_servant' => 0,
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]
    ];
    
    // حذف الطلاب السابقين من الفصل 32
    DB::table('users')->where('my_class_id', 32)->delete();
    
    // إضافة الطلاب الجدد
    foreach ($students as $student) {
        DB::table('users')->insert($student);
    }
    
    echo "تم إضافة 5 طلاب تجريبيين للفصل 32 بنجاح!\n";
    echo "الطلاب:\n";
    foreach ($students as $student) {
        echo "- {$student['full_name']} ({$student['email']})\n";
    }
    echo "\nيمكنك الآن اختبار صفحة الطلاب!\n";
    
} catch (Exception $e) {
    echo "خطأ: " . $e->getMessage() . "\n";
} 