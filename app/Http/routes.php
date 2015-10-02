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

use DreamsArk\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/**
 * Artisan Commands
 */
Route::get('artisan/{mode?}', function ($mode = 'refresh') {

    switch ($mode) {
        case "refresh" :
            Artisan::call('migrate:refresh', ['--seed' => true]);
            break;
        case "migrate":
            Artisan::call('migrate');
            break;
        case "seed":
            Artisan::call('db:seed');
            break;
        case "reset":
            Artisan::call('migrate:reset');
            break;
        case "rollback":
            Artisan::call('migrate:rollback');
            break;
    }

    return redirect()->route('home');

});

Route::get('/', ['as' => 'home', 'uses' => 'Home\HomeController@index']);


/**
 * Auth Controller
 */
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@login']);
Route::post('login/store', ['as' => 'login.store', 'uses' => 'Auth\AuthController@store']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

/**
 * Translation Controller
 */
Route::get('translation/import', ['as' => 'translation.import', 'uses' => 'Translation\TranslationController@import']);
Route::get('translation/export', ['as' => 'translation.export', 'uses' => 'Translation\TranslationController@export']);
Route::get('translation/language/store', ['as' => 'translation.newLanguage', 'uses' => 'Translation\TranslationController@newLanguage']);
Route::get('translation/group/store', ['as' => 'translation.newGroup', 'uses' => 'Translation\TranslationController@newGroup']);
Route::post('translation/update/{translation}', ['as' => 'translation.update', 'uses' => 'Translation\TranslationController@update']);
Route::get('translation/{language?}/{group?}', ['as' => 'translation', 'uses' => 'Translation\TranslationController@index']);


/**
 * Session Controller
 */
Route::get('profile', ['as' => 'profile', 'uses' => 'Session\SessionController@index']);
Route::get('register', ['as' => 'register.create', 'uses' => 'Session\SessionController@create']);
Route::post('register/update', ['as' => 'register.update', 'uses' => 'Session\SessionController@update']);
Route::post('register', ['as' => 'register.store', 'uses' => 'Session\SessionController@store']);


/**
 * Settings Controller
 */
Route::post('settings/update/{setting}', ['as' => 'settings.update', 'uses' => 'Setting\SettingController@update']);

/**
 * Report Controller
 */
Route::post('report/store', ['as' => 'report.store', 'uses' => 'Report\ReportController@store']);

Route::get('intro', ['as' => 'intro', 'uses' => function () {
    return view('intro');
}]);