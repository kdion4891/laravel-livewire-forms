<?php
use \Kdion4891\LaravelLivewireForms\Controllers\LivewireFormsController;

Route::group(['middleware' => 'web'], function () {
    Route::post('/laravel-livewire-forms/file-upload', LivewireFormsController::class.'@fileUpload')->name('laravel-livewire-forms.file-upload');
});
