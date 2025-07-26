<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhotoGallery;
use App\Models\GalleryPhoto;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoSeeder extends Seeder
{
    public function run(): void
    {
        $servant = User::where('role', 'خادم')->first();
        if (!$servant) {
            $servant = User::create([
                'full_name' => 'خادم تجريبي',
                'email' => 'servant@example.com',
                'password' => bcrypt('password'),
                'role' => 'خادم',
                'is_servant' => true
            ]);
        }

        $galleries = PhotoGallery::all();

        // أسماء ملفات الصور الموجودة في مجلد public/images
        $sampleImages = [
            '1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg',
            '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg'
        ];

        foreach ($galleries as $gallery) {
            // إنشاء صور تجريبية لكل مكتبة
            for ($i = 0; $i < 5; $i++) {
                $imageName = $sampleImages[$i] ?? '1.jpg';
                $this->createSamplePhoto($gallery, $servant, $i + 1, $imageName);
            }
        }

        $this->command->info('تم إنشاء الصور التجريبية بنجاح!');
    }

    private function createSamplePhoto($gallery, $servant, $index, $sourceImageName)
    {
        // مسار الصورة المصدر
        $sourcePath = public_path("images/{$sourceImageName}");
        
        // التحقق من وجود الصورة المصدر
        if (!file_exists($sourcePath)) {
            $this->command->warn("الصورة {$sourceImageName} غير موجودة، سيتم تخطيها");
            return;
        }

        // إنشاء مجلد الصور إذا لم يكن موجوداً
        $directory = "galleries/{$gallery->folder_name}";
        if (!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        // نسخ الصورة إلى مجلد المكتبة
        $fileName = "photo_{$index}.jpg";
        $filePath = "{$directory}/{$fileName}";
        
        // نسخ الملف
        $sourceContent = file_get_contents($sourcePath);
        Storage::disk('public')->put($filePath, $sourceContent);

        // إنشاء thumbnail بسيط (نسخ من الأصل)
        $this->createThumbnail($filePath);

        // حفظ في قاعدة البيانات
        GalleryPhoto::create([
            'gallery_id' => $gallery->id,
            'file_name' => $fileName,
            'original_name' => "صورة تجريبية {$index}.jpg",
            'file_path' => $filePath,
            'file_size' => Storage::disk('public')->size($filePath),
            'mime_type' => 'image/jpeg',
            'uploaded_by' => $servant->id
        ]);
    }

    private function createThumbnail($filePath)
    {
        try {
            $pathInfo = pathinfo($filePath);
            $thumbnailDir = $pathInfo['dirname'] . '/thumbnails';
            $thumbnailPath = $thumbnailDir . '/' . $pathInfo['basename'];
            
            if (!Storage::disk('public')->exists($thumbnailDir)) {
                Storage::disk('public')->makeDirectory($thumbnailDir);
            }

            // نسخ الصورة الأصلية كـ thumbnail مؤقتاً
            $sourceContent = Storage::disk('public')->get($filePath);
            Storage::disk('public')->put($thumbnailPath, $sourceContent);
            
        } catch (\Exception $e) {
            \Log::error('Error creating thumbnail: ' . $e->getMessage());
        }
    }
} 