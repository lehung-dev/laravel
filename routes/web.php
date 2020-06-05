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

$prefix_admin = config('pvt.admin.prefix_admin');
$prefix_news  = config('pvt.app.prefix_news');

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => $prefix_admin], function () {
    /*=====================     DASHBOARD      ====================*/
    $prefix             = 'dashboard';
    $controllerName     = 'dashboard';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as'    =>  $controllerName,  'uses'               =>  $controller . 'index']);
    });


    /*=====================     SLIDER      ====================*/
    $prefix             = 'slider';
    $controllerName     = 'slider';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as'    =>  $controllerName,               'uses'    =>  $controller . 'index']);
        Route::get('form/{id?}',                    ['as'    =>  $controllerName . '/form',     'uses'    =>  $controller . 'form'])->where(['id' => '[0-9]+']);
        Route::post('save',                         ['as'    =>  $controllerName . '/save',     'uses'    =>  $controller . 'save']);
        Route::get('delete/{id}',                   ['as'    =>  $controllerName . '/delete',   'uses'    =>  $controller . 'delete'])->where(['id' => '[0-9]+']);
        Route::get('change-status-{status}/{id}',   ['as'    =>  $controllerName . '/status',   'uses'    =>  $controller . 'status'])->where(['id' => '[0-9]+']);
    });
   
    /*=====================     CATEGORY      ====================*/
    $prefix             = 'category';
    $controllerName     = 'category';
    Route::group(['prefix' => $prefix], function () use ($controllerName) {
        $controller = ucfirst($controllerName) . 'Controller@';
        Route::get('/',                             ['as'    =>  $controllerName,               'uses'    =>  $controller . 'index']);
        Route::get('form/{id?}',                    ['as'    =>  $controllerName . '/form',     'uses'    =>  $controller . 'form'])->where(['id' => '[0-9]+']);
        Route::post('save',                         ['as'    =>  $controllerName . '/save',     'uses'    =>  $controller . 'save']);
        Route::get('delete/{id}',                   ['as'    =>  $controllerName . '/delete',   'uses'    =>  $controller . 'delete'])->where(['id' => '[0-9]+']);
        Route::get('change-status-{status}/{id}',   ['as'    =>  $controllerName . '/status',   'uses'    =>  $controller . 'status'])->where(['id' => '[0-9]+']);
        Route::get('change-is-home-{is_home}/{id}', ['as'    =>  $controllerName . '/is_home',  'uses'    =>  $controller . 'is_home'])->where(['id' => '[0-9]+']);
        Route::get('change-display-{display}/{id}', ['as'    =>  $controllerName . '/display',  'uses'    =>  $controller . 'display']);
    });
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
