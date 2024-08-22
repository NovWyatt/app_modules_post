<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id(); // Khóa chính tự tăng (auto-incrementing)
                $table->unsignedBigInteger('category_id');
                $table->string('title'); // Tiêu đề của bài viết
                $table->text('content'); // Nội dung của bài viết
                $table->string('slug')->unique(); // Đường dẫn tĩnh (slug) duy nhất
                $table->string('image_path'); // Đường dẫn tĩnh (slug) duy nhất
                $table->unsignedBigInteger('user_id'); // ID người dùng tạo bài viết
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Khóa ngoại tham chiếu đến bảng users, xóa bài viết nếu người dùng bị xóa
                $table->string('status')->default('draft'); // Trạng thái bài viết (draft, published, etc.)
                $table->timestamps(); // Thêm cột created_at và updated_at
                $table->softDeletes(); // Thêm cột deleted_at để hỗ trợ xóa mềm (soft delete)
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};