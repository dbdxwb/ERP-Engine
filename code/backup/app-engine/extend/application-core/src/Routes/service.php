<?php

use DevEngine\Core\Web\Area;
use DevEngine\Core\Web\Image;
use Illuminate\Support\Facades\Route;

/**
 * 基础路由
 */
Route::get('image/placeholder/{w}/{h}/{t}', [Image::class, 'placeholder'])->middleware('web')->name('service.image.placeholder');
Route::get('area', [Area::class, 'index'])->middleware('web')->name('service.area');
