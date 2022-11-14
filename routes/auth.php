<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all the routes for auth.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Auth\UserSignInController;

$router->post('api/user/register', UserRegisterController::class);
$router->post('api/user/sign-in', UserSignInController::class);
$router->post('api/user/recover-password', RecoverPasswordController::class);
$router->post('api/user/reset-password', ResetPasswordController::class);
