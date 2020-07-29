<?php

namespace Kdion4891\LaravelLivewireForms\Controllers;

use Illuminate\Routing\Controller;

class LivewireFormsController extends Controller
{
    public function fileUpload()
    {
        return call_user_func([request()->input('component'), 'fileUpload']);
    }
}
