<?php

namespace Modules\Image\Providers;

use Modules\Image\Models\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }
    public function getPathById($id)
    {
        // Lấy thông tin hình ảnh từ cơ sở dữ liệu bằng ID
        $image = Image::find($id);

        if ($image) {
            // Trả về đường dẫn tương đối
            return $image->path; // Ví dụ: 'images/filename'
        }

        // Trả về null hoặc một giá trị mặc định nếu hình ảnh không tìm thấy
        return null;
    }
    public function store($file)
    {
        $image = $this->manager->read($file);
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = 'public/images/' . $filename;

        Storage::put($path, $image->encode());

        return Image::create([
            'filename' => $filename,
            'path' => 'images/' . $filename,
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize()
        ]);
    }

    public function getAll()
    {
        return Image::all();
    }

    public function find($id)
    {
        return Image::findOrFail($id);
    }

    public function delete($id)
    {
        $image = $this->find($id);
        Storage::delete($image->path);
        return $image->delete();
    }

    // Thêm các phương thức khác nếu cần
}