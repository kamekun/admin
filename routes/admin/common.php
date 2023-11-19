<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \BytePlatform\Admin\Livewire\Dashboard::class)->name('admin.dashboard');
Route::post('/widget-setting/{widgetId?}', route_theme(\BytePlatform\Admin\Livewire\SettingWidget::class))->name('admin.widget-setting');
Route::get('/settings', route_theme(\BytePlatform\Admin\Livewire\Pages\Setting\Index::class))->name('admin.setting');
