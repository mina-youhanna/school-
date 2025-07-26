<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            ClassesSeeder::class,
            PhotoGallerySeeder::class,
            GalleryPhotoSeeder::class,
        ]);

        User::factory()->create([
            'full_name' => 'بيتر حشمت',
            'username' => 'peter.hashmat',
            'email' => 'peter.hashmat@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'خادم',
            'my_class_id' => 1, // فصل الشهيد ونس
            'is_admin' => false,
            'phone' => '01000000000',
            'whatsapp' => '01000000001',
            'relative_phone' => '01000000002',
            'address' => 'مصر',
            'confession_father' => 'أبونا',
            'dob' => '1990-01-01',
            'gender' => 'ذكر',
            'is_deacon' => false,
            'code' => '9999',
        ]);
    }
}
