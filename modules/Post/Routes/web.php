<?php


use Modules\Post\Controllers\PostController;


Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('/post', [PostController::class, 'index'])->name('post');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::delete('/posts/destroy-multiple', [PostController::class, 'destroyMultiple'])->name('post.destroyMultiple');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
});
