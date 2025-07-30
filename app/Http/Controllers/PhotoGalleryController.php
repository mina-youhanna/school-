<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PhotoGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $query = PhotoGallery::with(['creator', 'coverPhoto']);
        
        // إذا كان المستخدم أدمن، اعرض جميع المكتبات
        if (Auth::check() && Auth::user()->isAdmin()) {
            $galleries = $query->orderBy('created_at', 'desc')->get();
        } else {
            // للمستخدمين العاديين، اعرض فقط المكتبات النشطة
            $galleries = $query->where('is_active', true)->orderBy('created_at', 'desc')->get();
        }

        return view('photo-gallery.index', compact('galleries'));
    }

    /**
     * عرض مكتبة معينة
     */
    public function show($id)
    {
        $gallery = PhotoGallery::with(['photos.uploader', 'creator'])
            ->findOrFail($id);

        // إذا كان المستخدم ليس أدمن والمكتبة غير نشطة، اعرض خطأ 404
        if (!$gallery->is_active && (!Auth::check() || !Auth::user()->isAdmin())) {
            abort(404);
        }

        return view('photo-gallery.show', compact('gallery'));
    }

    /**
     * عرض صفحة إنشاء مكتبة جديدة (للخدام فقط)
     */
    public function create()
    {
        if (!Auth::user()->isServant() && !Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك بإنشاء مكتبات صور');
        }

        return view('photo-gallery.create');
    }

    /**
     * حفظ مكتبة جديدة
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isServant() && !Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك بإنشاء مكتبات صور');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'folder_name' => 'required|string|max:255|unique:photo_galleries,folder_name',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240' // 10MB max
        ]);

        $gallery = PhotoGallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'folder_name' => $request->folder_name,
            'created_by' => Auth::id(),
            'is_active' => true
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $this->uploadPhoto($gallery, $photo);
            }
        }

        return redirect()->route('photo-gallery.show', $gallery->id)
            ->with('success', 'تم إنشاء المكتبة بنجاح');
    }

    /**
     * عرض صفحة تعديل المكتبة
     */
    public function edit($id)
    {
        $gallery = PhotoGallery::findOrFail($id);
        
        if ((!Auth::user()->isServant() && !Auth::user()->isAdmin()) || 
            (Auth::user()->isServant() && $gallery->created_by !== Auth::id())) {
            abort(403, 'غير مصرح لك بتعديل هذه المكتبة');
        }

        return view('photo-gallery.edit', compact('gallery'));
    }

    /**
     * تحديث المكتبة
     */
    public function update(Request $request, $id)
    {
        $gallery = PhotoGallery::findOrFail($id);
        
        if ((!Auth::user()->isServant() && !Auth::user()->isAdmin()) || 
            (Auth::user()->isServant() && $gallery->created_by !== Auth::id())) {
            abort(403, 'غير مصرح لك بتعديل هذه المكتبة');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $gallery->update($request->only(['title', 'description', 'is_active']));

        return redirect()->route('photo-gallery.show', $gallery->id)
            ->with('success', 'تم تحديث المكتبة بنجاح');
    }

    /**
     * حذف المكتبة
     */
    public function destroy($id)
    {
        $gallery = PhotoGallery::findOrFail($id);
        
        if ((!Auth::user()->isServant() && !Auth::user()->isAdmin()) || 
            (Auth::user()->isServant() && $gallery->created_by !== Auth::id())) {
            abort(403, 'غير مصرح لك بحذف هذه المكتبة');
        }

        // حذف جميع الصور من التخزين
        foreach ($gallery->photos as $photo) {
            Storage::delete($photo->file_path);
            
            // حذف الصورة المصغرة إذا وجدت
            $pathInfo = pathinfo($photo->file_path);
            $thumbnailPath = $pathInfo['dirname'] . '/thumbnails/' . $pathInfo['basename'];
            Storage::delete($thumbnailPath);
        }

        $gallery->delete();

        return redirect()->route('photo-gallery.index')
            ->with('success', 'تم حذف المكتبة بنجاح');
    }

    /**
     * رفع صور جديدة لمكتبة موجودة
     */
    public function uploadPhotos(Request $request, $id)
    {
        $gallery = PhotoGallery::findOrFail($id);
        
        if (!Auth::user()->isServant() && !Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك برفع الصور');
        }

        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $uploadedCount = 0;

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $this->uploadPhoto($gallery, $photo);
                $uploadedCount++;
            }
        }

        // إذا كان الطلب من AJAX، ارجع JSON response
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => "تم رفع {$uploadedCount} صورة بنجاح",
                'redirect_url' => route('photo-gallery.show', $gallery->id)
            ]);
        }

        return redirect()->route('photo-gallery.show', $gallery->id)
            ->with('success', "تم رفع {$uploadedCount} صورة بنجاح");
    }

    /**
     * حذف صورة من المكتبة
     */
    public function deletePhoto($galleryId, $photoId)
    {
        $gallery = PhotoGallery::findOrFail($galleryId);
        $photo = GalleryPhoto::where('gallery_id', $galleryId)
            ->where('id', $photoId)
            ->firstOrFail();
        
        if (!Auth::user()->isServant() && !Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك بحذف الصور');
        }

        // حذف الملف من التخزين
        Storage::delete($photo->file_path);
        
        // حذف الصورة المصغرة إذا وجدت
        $pathInfo = pathinfo($photo->file_path);
        $thumbnailPath = $pathInfo['dirname'] . '/thumbnails/' . $pathInfo['basename'];
        Storage::delete($thumbnailPath);

        $photo->delete();

        return redirect()->route('photo-gallery.show', $gallery->id)
            ->with('success', 'تم حذف الصورة بنجاح');
    }

    /**
     * تحميل صورة
     */
    public function downloadPhoto($galleryId, $photoId)
    {
        $photo = GalleryPhoto::where('gallery_id', $galleryId)
            ->where('id', $photoId)
            ->firstOrFail();

        if (!Storage::exists($photo->file_path)) {
            abort(404, 'الملف غير موجود');
        }

        return Storage::download($photo->file_path, $photo->original_name);
    }

    /**
     * رفع صورة واحدة
     */
    private function uploadPhoto($gallery, $photo)
    {
        $fileName = time() . '_' . Str::random(10) . '.' . $photo->getClientOriginalExtension();
        $folderPath = 'galleries/' . $gallery->folder_name;
        $filePath = $photo->storeAs($folderPath, $fileName, 'public');

        // إنشاء صورة مصغرة
        $this->createThumbnail($filePath);

        GalleryPhoto::create([
            'gallery_id' => $gallery->id,
            'file_name' => $fileName,
            'original_name' => $photo->getClientOriginalName(),
            'file_path' => $filePath,
            'file_size' => $photo->getSize(),
            'mime_type' => $photo->getMimeType(),
            'uploaded_by' => Auth::id()
        ]);
    }

    /**
     * إنشاء صورة مصغرة
     */
    private function createThumbnail($filePath)
    {
        try {
            $fullPath = Storage::disk('public')->path($filePath);
            $pathInfo = pathinfo($filePath);
            $thumbnailDir = $pathInfo['dirname'] . '/thumbnails';
            $thumbnailPath = $thumbnailDir . '/' . $pathInfo['basename'];

            // إنشاء مجلد الصور المصغرة إذا لم يكن موجوداً
            if (!Storage::disk('public')->exists($thumbnailDir)) {
                Storage::disk('public')->makeDirectory($thumbnailDir);
            }

            // إنشاء الصورة المصغرة باستخدام GD
            $sourceImage = imagecreatefromstring(file_get_contents($fullPath));
            if ($sourceImage === false) {
                return;
            }

            $sourceWidth = imagesx($sourceImage);
            $sourceHeight = imagesy($sourceImage);
            
            // حساب الأبعاد الجديدة مع الحفاظ على النسبة
            $targetSize = 300;
            $ratio = min($targetSize / $sourceWidth, $targetSize / $sourceHeight);
            $newWidth = round($sourceWidth * $ratio);
            $newHeight = round($sourceHeight * $ratio);
            
            $thumbnail = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($thumbnail, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $sourceWidth, $sourceHeight);
            
            // حفظ الصورة المصغرة
            $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
            $thumbnailFullPath = Storage::disk('public')->path($thumbnailPath);
            
            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($thumbnail, $thumbnailFullPath, 90);
                    break;
                case 'png':
                    imagepng($thumbnail, $thumbnailFullPath, 9);
                    break;
                case 'gif':
                    imagegif($thumbnail, $thumbnailFullPath);
                    break;
            }
            
            imagedestroy($sourceImage);
            imagedestroy($thumbnail);
        } catch (\Exception $e) {
            // تجاهل الأخطاء في إنشاء الصور المصغرة
            \Log::error('Error creating thumbnail: ' . $e->getMessage());
        }
    }

    /**
     * إدارة المكتبات (للأدمن فقط)
     */
    public function manage()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        $galleries = PhotoGallery::with(['creator', 'coverPhoto', 'photos'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('photo-gallery.manage', compact('galleries'));
    }

    /**
     * إحصائيات المكتبات (للأدمن فقط)
     */
    public function stats()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        $stats = [
            'total_galleries' => PhotoGallery::count(),
            'active_galleries' => PhotoGallery::where('is_active', true)->count(),
            'total_photos' => GalleryPhoto::count(),
            'total_creators' => PhotoGallery::distinct('created_by')->count(),
            'recent_galleries' => PhotoGallery::with('creator')->latest()->take(5)->get(),
            'top_creators' => PhotoGallery::with('creator')
                ->selectRaw('created_by, COUNT(*) as gallery_count')
                ->groupBy('created_by')
                ->orderBy('gallery_count', 'desc')
                ->take(5)
                ->get()
        ];

        return view('photo-gallery.stats', compact('stats'));
    }

    /**
     * إضافة صور لمكتبة (للأدمن فقط)
     */
    public function addPhotos($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        $gallery = PhotoGallery::findOrFail($id);
        return view('photo-gallery.add-photos', compact('gallery'));
    }

    /**
     * تفعيل/إيقاف مكتبة (للأدمن فقط)
     */
    public function toggleStatus($id)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'غير مصرح لك بالوصول إلى هذه الصفحة');
        }

        $gallery = PhotoGallery::findOrFail($id);
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();

        $status = $gallery->is_active ? 'تم تفعيل' : 'تم إيقاف';
        
        return redirect()->back()->with('success', $status . ' المكتبة بنجاح');
    }
} 