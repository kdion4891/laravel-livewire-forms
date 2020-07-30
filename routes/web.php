<?php
use \Kdion4891\LaravelLivewireForms\Controllers\FileUploadController;

Route::group(['middleware' => 'web'], function () {
    Route::post('/laravel-livewire-forms/file-upload', FileUploadController::class)
        ->name('laravel-livewire-forms.file-upload');
});
