<?php

namespace Kdion4891\LaravelLivewireForms\Controllers;

class FileUploadController
{
    public function __invoke()
    {
        return call_user_func([request()->input('component'), 'fileUpload']);
    }
}
