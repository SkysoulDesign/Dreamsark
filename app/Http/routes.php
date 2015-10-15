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
Route::get('translation/sync', ['as' => 'translation.sync', 'uses' => 'Translation\TranslationController@sync']);
Route::post('translation/language/store', ['as' => 'translation.newLanguage', 'uses' => 'Translation\TranslationController@newLanguage']);
Route::post('translation/group/store', ['as' => 'translation.newGroup', 'uses' => 'Translation\TranslationController@newGroup']);
Route::post('translation/translation/store', ['as' => 'translation.newTranslation', 'uses' => 'Translation\TranslationController@newTranslation']);
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
 * Audition Controller
 */
Route::get('auditions', ['as' => 'auditions', 'uses' => 'Project\AuditionController@index']);
Route::get('audition/show/{project}', ['as' => 'audition.show', 'uses' => 'Project\AuditionController@show']);

/**
 * Idea Controller
 */
Route::get('ideas', ['as' => 'project.ideas', 'uses' => 'Project\Idea\IdeaController@index']);
Route::get('idea/create', ['as' => 'project.idea.create', 'uses' => 'Project\Idea\IdeaController@create']);
Route::post('idea/store', ['as' => 'project.idea.store', 'uses' => 'Project\Idea\IdeaController@store']);
Route::get('idea/show/{idea}', ['as' => 'project.idea.show', 'uses' => 'Project\Idea\IdeaController@show']);
Route::post('idea/bid/{idea}', ['as' => 'project.idea.bid.store', 'uses' => 'Project\Idea\IdeaController@bid']);

/**
 * Submission Controller
 */
Route::post('idea/submission/store/{idea}', ['as' => 'project.idea.submission.store', 'uses' => 'Project\Idea\SubmissionController@store']);
Route::post('idea/submission/select/{submission}', ['as' => 'project.idea.submission.select', 'uses' => 'Project\Idea\SubmissionController@select']);


/**
 * Project Controller
 */
Route::get('projects', ['as' => 'projects', 'uses' => 'Project\ProjectController@index']);
Route::get('project/create', ['as' => 'project.create', 'uses' => 'Project\ProjectController@create']);
Route::get('project/show/{project}', ['as' => 'project.show', 'uses' => 'Project\ProjectController@show']);
Route::post('project/store', ['as' => 'project.store', 'uses' => 'Project\ProjectController@store']);

/**
 * Project Take Controller
 */
Route::post('project/take/store/{script}', ['as' => 'project.take.store', 'uses' => 'Project\TakeController@store']);

/**
 * Project Cast Controller
 */
Route::post('project/cast/store/{project}', ['as' => 'project.cast.store', 'uses' => 'Project\CastController@store']);

/**
 * Project Crew Controller
 */
Route::post('project/crew/store/{project}', ['as' => 'project.crew.store', 'uses' => 'Project\CrewController@store']);

/**
 * Project Pledge Controller
 */
Route::get('project/pledge/create/{project}', ['as' => 'project.pledge.create', 'uses' => 'Project\ProjectPledgeController@create']);
Route::post('project/pledge/store/{project}', ['as' => 'project.pledge.store', 'uses' => 'Project\ProjectPledgeController@store']);

/**
 * Project Enroll Controller
 */
Route::get('project/enroll/create/{project}', ['as' => 'project.enroll.create', 'uses' => 'Project\ProjectEnrollController@create']);
Route::post('project/enroll/cast/store/{cast}', ['as' => 'project.enroll.cast.store', 'uses' => 'Project\ProjectEnrollController@castStore']);
Route::post('project/enroll/crew/store/{crew}', ['as' => 'project.enroll.crew.store', 'uses' => 'Project\ProjectEnrollController@crewStore']);

/**
 * Coin Controller
 */
Route::get('purchase/coins/create', ['as' => 'coin.create', 'uses' => 'Bag\CoinController@create']);
Route::post('purchase/coins/store', ['as' => 'coin.store', 'uses' => 'Bag\CoinController@store']);

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