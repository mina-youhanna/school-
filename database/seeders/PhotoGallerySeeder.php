<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhotoGallery;
use App\Models\GalleryPhoto;
use App\Models\User;

class PhotoGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // البحث عن مستخدم خادم أو إنشاء واحد
        $servant = User::where('role', 'خادم')->first();
        
        if (!$servant) {
            // إنشاء مستخدم خادم تجريبي
            $servant = User::create([
                'full_name' => 'خادم تجريبي',
                'email' => 'servant@example.com',
                'password' => bcrypt('password'),
                'role' => 'خادم',
                'is_servant' => true
            ]);
        }

        // إنشاء مكتبات تجريبية
        $galleries = [
            [
                'title' => 'مؤتمر الخدام 2025',
                'description' => 'صور من مؤتمر الخدام السنوي لعام 2025',
                'folder_name' => 'conference-2025',
                'created_by' => $servant->id,
                'is_active' => true
            ],
            [
                'title' => 'رحلات الكنيسة',
                'description' => 'صور من رحلات الكنيسة المختلفة',
                'folder_name' => 'church-trips',
                'created_by' => $servant->id,
                'is_active' => true
            ],
            [
                'title' => 'مناسبات خاصة',
                'description' => 'صور من المناسبات والاحتفالات الخاصة',
                'folder_name' => 'special-events',
                'created_by' => $servant->id,
                'is_active' => true
            ]
        ];

        foreach ($galleries as $galleryData) {
            PhotoGallery::create($galleryData);
        }

        $this->command->info('تم إنشاء مكتبات الصور التجريبية بنجاح!');
    }
} 