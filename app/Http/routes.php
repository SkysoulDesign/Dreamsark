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

Route::get('/', ['as' => 'home', 'middleware' => 'auth.basic', 'uses' => 'Home\HomeController@index']);


//app()->setLocale('cn');

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
 * Project Controller
 */
Route::get('projects', ['as' => 'projects', 'uses' => 'Project\ProjectController@index']);
Route::get('project/create', ['as' => 'project.create', 'uses' => 'Project\ProjectController@create']);
Route::get('project/show/{project}', ['as' => 'project.show', 'uses' => 'Project\ProjectController@show']);
Route::post('project/store', ['as' => 'project.store', 'uses' => 'Project\ProjectController@store']);

/**
 * Project Pledge Controller
 */
Route::get('project/pledge/{project}', ['as' => 'project.pledge.create', 'uses' => 'Project\ProjectPledgeController@create']);
Route::post('project/pledge/{project}', ['as' => 'project.pledge.store', 'uses' => 'Project\ProjectPledgeController@store']);

/**
 * Coin Controller
 */
Route::get('purchase/coins', ['as' => 'coin.create', 'uses' => 'Coin\CoinController@create']);
Route::post('purchase/coins', ['as' => 'coin.store', 'uses' => 'Coin\CoinController@store']);

/**
 * User Projects Controller
 */
Route::get('user/projects', ['as' => 'user.projects', 'uses' => 'Project\UserProjectController@index']);


/**
 * Report Controller
 */
Route::post('report/store', ['as' => 'report.store', 'uses' => 'Report\ReportController@store']);

Route::get('intro', ['as' => 'intro', 'uses' => function () {
    return view('intro');
}]);