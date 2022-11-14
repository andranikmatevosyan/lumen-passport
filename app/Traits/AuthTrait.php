<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

trait AuthTrait
{
    public function user(): Authenticatable|User|null
    {
        return Auth::user();
    }
}
