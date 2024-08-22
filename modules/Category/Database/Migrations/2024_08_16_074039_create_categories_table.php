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
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id(); // Khóa chính tự tăng (auto-incrementing)
                $table->string('name'); // Tên của danh mục
                $table->string('slug')->unique(); // Đường dẫn tĩnh (slug) duy nhất
                $table->text('description')->nullable(); // Mô tả về danh mục (có thể rỗng)
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
        Schema::dropIfExists('categories');
    }
};