<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all the routes for company.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers\Company\CompanyCreateController;
use App\Http\Controllers\Company\CompanyListController;

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('api/user/companies', CompanyListController::class);
    $router->post('api/user/companies', CompanyCreateController::class);
});
