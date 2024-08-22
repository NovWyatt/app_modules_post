<?php
use Modules\Image\Controllers\ImageController;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::prefix('images')->group(function () {
        Route::get('/', [ImageController::class, 'index'])->name('image.index');
        Route::get('/upload', [ImageController::class, 'upload'])->name('image.upload');
        Route::post('/store', [ImageController::class, 'store'])->name('image.store');
        Route::delete('/{id}', [ImageController::class, 'destroy'])->name('image.destroy');
        Route::get('/select', [ImageController::class, 'select'])->name('image.select');
    });
});