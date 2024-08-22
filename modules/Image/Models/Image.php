<?php

namespace Modules\Image\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['filename', 'path', 'mime_type', 'size'];

    // Nếu bạn muốn sử dụng tên bảng khác
    protected $table = 'images';

    // Các quan hệ và phương thức khác nếu cần
}