<?php

namespace App\Http\Controllers;

use App\Traits\AuthTrait;
use App\Traits\ResponseTrait;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthTrait, ResponseTrait;
}
