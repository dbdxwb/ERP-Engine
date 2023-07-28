<?php

use Illuminate\Support\Facades\Route;


Route::get('', ['uses' => 'System\Index@index', 'desc' => '系统首页'])->name('admin.index');

/**
 * 用户登录
 */
Route::post('login', 'System\Login@submit')->name('admin.login.submit');
Route::get('login/logout', 'System\Login@logout')->name('admin.login.logout');
Route::get('login/check', 'System\Login@check')->name('admin.login.check');

/**
 * 用户注册
 */
Route::post('register', 'System\Register@submit')->middleware('auth.manage.register')->name('admin.register.submit');

/**
 * 其他公用
 */
Route::get('map/weather', ['uses' => 'System\Map@weather', 'desc' => '天气服务'])->name('admin.map.weather');
