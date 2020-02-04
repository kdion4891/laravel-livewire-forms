<?php

Route::group(['middleware' => 'web'], function () {
    Route::post('/laravel-livewire-forms/file-upload', function () {
        return call_user_func([request()->input('component'), 'fileUpload']);
    })->name('laravel-livewire-forms.file-upload');
});
