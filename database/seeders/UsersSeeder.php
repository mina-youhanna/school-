<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء جدول users إذا لم يكن موجوداً
        if (!DB::getSchemaBuilder()->hasTable('users')) {
            DB::statement('
                CREATE TABLE users (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    full_name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    password_plain VARCHAR(255) NULL,
                    phone VARCHAR(20) NULL,
                    whatsapp VARCHAR(20) NULL,
                    relative_phone VARCHAR(20) NULL,
                    address TEXT NULL,
                    confession_father VARCHAR(255) NULL,
                    dob DATE NULL,
                    gender ENUM("ذكر", "أنثى") NULL,
                    role ENUM("admin", "خادم", "مخدوم") DEFAULT "مخدوم",
                    is_main_servant BOOLEAN DEFAULT FALSE,
                    serving_classes JSON NULL,
                    my_class VARCHAR(255) NULL,
                    is_deacon BOOLEAN DEFAULT FALSE,
                    ordination_date DATE NULL,
                    ordination_bishop VARCHAR(255) NULL,
                    deacon_rank VARCHAR(255) NULL,
                    code VARCHAR(255) UNIQUE NULL,
                    profile_image VARCHAR(255) NULL,
                    score INT DEFAULT 0,
                    is_admin BOOLEAN DEFAULT FALSE,
                    full_name_en VARCHAR(255) NULL,
                    promotion_rank VARCHAR(255) NULL,
                    promotion_date DATE NULL,
                    promotion_by VARCHAR(255) NULL,
                    last_degree VARCHAR(255) NULL,
                    job VARCHAR(255) NULL,
                    national_id VARCHAR(14) UNIQUE NULL,
                    username VARCHAR(255) UNIQUE NULL,
                    last_profile_update TIMESTAMP NULL,
                    email_verified_at TIMESTAMP NULL,
                    remember_token VARCHAR(100) NULL,
                    created_at TIMESTAMP NULL,
                    updated_at TIMESTAMP NULL
                )
            ');
        }

        // إنشاء جدول study_classes إذا لم يكن موجوداً
        if (!DB::getSchemaBuilder()->hasTable('study_classes')) {
            DB::statement('
                CREATE TABLE study_classes (
                    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    stage VARCHAR(255) NOT NULL,
                    schedule VARCHAR(255) NOT NULL,
                    place VARCHAR(255) NOT NULL,
                    main_servant_email VARCHAR(255) NOT NULL,
                    assistant_servants_emails TEXT NULL,
                    saint_image VARCHAR(255) NULL,
                    gender ENUM("ذكر", "أنثى", "مختلط") NOT NULL,
                    students_count INT DEFAULT 0,
                    created_at TIMESTAMP NULL,
                    updated_at TIMESTAMP NULL
                )
            ');
        }

        // إضافة مستخدمين تجريبيين
        $users = [
            [
                'full_name' => 'أحمد محمد علي',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('123456'),
                'password_plain' => '123456',
                'phone' => '01012345678',
                'gender' => 'ذكر',
                'role' => 'admin',
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'فاطمة أحمد محمد',
                'email' => 'fatima@example.com',
                'password' => Hash::make('123456'),
                'password_plain' => '123456',
                'phone' => '01087654321',
                'gender' => 'أنثى',
                'role' => 'خادم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'محمد علي أحمد',
                'email' => 'mohamed@example.com',
                'password' => Hash::make('123456'),
                'password_plain' => '123456',
                'phone' => '01011223344',
                'gender' => 'ذكر',
                'role' => 'مخدوم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'سارة محمود حسن',
                'email' => 'sara@example.com',
                'password' => Hash::make('123456'),
                'password_plain' => '123456',
                'phone' => '01055667788',
                'gender' => 'أنثى',
                'role' => 'مخدوم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'علي محمد فتحي',
                'email' => 'ali@example.com',
                'password' => Hash::make('123456'),
                'password_plain' => '123456',
                'phone' => '01099887766',
                'gender' => 'ذكر',
                'role' => 'خادم',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'مينا يوحنا',
                'email' => 'minayouhanna2004@gmail.com',
                'password' => Hash::make('01277131028'),
                'password_plain' => '01277131028',
                'phone' => '01277131028',
                'gender' => 'ذكر',
                'role' => 'admin',
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        // إضافة فصول تجريبية
        $classes = [
            [
                'name' => 'فصل أول',
                'stage' => 'ابتدائي',
                'schedule' => 'الأحد 9:00 ص',
                'place' => 'قاعة القديس مارمرقس',
                'main_servant_email' => 'ali@example.com',
                'gender' => 'مختلط',
                'students_count' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'فصل ثاني',
                'stage' => 'ابتدائي',
                'schedule' => 'الأحد 10:30 ص',
                'place' => 'قاعة القديسة دميانة',
                'main_servant_email' => 'fatima@example.com',
                'gender' => 'مختلط',
                'students_count' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'فصل ثالث',
                'stage' => 'إعدادي',
                'schedule' => 'الأحد 12:00 م',
                'place' => 'قاعة القديس أثناسيوس',
                'main_servant_email' => 'ahmed@example.com',
                'gender' => 'مختلط',
                'students_count' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($classes as $class) {
            DB::table('study_classes')->insert($class);
        }

        $this->command->info('تم إنشاء الجداول وإضافة البيانات التجريبية بنجاح!');
    }
}
