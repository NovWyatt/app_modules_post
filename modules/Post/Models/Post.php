<?php

namespace Modules\Post\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Models\Category;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts'; // Tên bảng

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', // Tiêu đề bài viết
        'content', // Nội dung bài viết
        'slug', // Đường dẫn tĩnh
        'user_id', // ID người dùng tạo bài viết
        'category_id', // ID danh mục bài viết
        'image_path',
        'status', // Trạng thái bài viết (ví dụ: draft, published)
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = $post->generateSlug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = $post->generateSlug($post->title);
        });
    }

    // Phương thức tạo slug từ tiêu đề
    public function generateSlug($title)
    {
        $slug = Str::slug($title);
        $count = static::where('slug', $slug)->count();

        if ($count) {
            $slug = $slug . '-' . ($count + 1);
        }

        return $slug;
    }
    /**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // Bài viết thuộc về một danh mục
    }

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Bài viết thuộc về một người dùng
    }
    protected $dates = ['deleted_at'];
}