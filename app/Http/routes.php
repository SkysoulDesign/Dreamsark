<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('migrate', function () {
    return Artisan::call('migrate:refresh', ['--seed']);
});

Route::get('/', ['as' => 'home', 'uses' => 'Home\HomeController@index']);

Route::get('intro', ['as' => 'intro', 'uses' => function(){
    return view('intro');
}]);