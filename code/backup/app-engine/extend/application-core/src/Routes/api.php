<?php

use Illuminate\Support\Facades\Route;


Route::get('appForm/{id}', ['uses' => 'Form@list', 'desc' => '表单列表'])->name('api.core.form.list');
Route::get('appFormInfo/{id}', ['uses' => 'Form@info', 'desc' => '表单列表'])->name('api.core.form.list');
Route::post('appFormInfo/{id}', ['uses' => 'Form@push', 'desc' => '表单提交'])->name('api.core.form.push');

