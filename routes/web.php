<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$prefix_news  = config('pvt.app.prefix_news');

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => $prefix_news], function () {
    /*=====================     HOMEPAGE      ====================*/
    $prefix             = '/';
    $controllerName     = 'home';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as'    =>  $controllerName,  'uses'               =>  $controller . 'index']);
    });
});
