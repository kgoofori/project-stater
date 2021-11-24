<?php

use App\Models\Category;
use App\Models\VerificationCard;
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


Auth::routes(['verify' => true]);

Route::prefix('data')->group(function () {
    Route::get('/categories.json', 'DataController@categories');
    Route::get('/verification-ids.json', 'DataController@verificationCards');
});


Route::middleware(['auth', 'verified'])->group(function () {

    //user
    Route::get('/account', 'UsersController@account');
    Route::post('/account/change-password', 'UsersController@changePassword');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/intro', 'HomeController@intro');
    Route::post('/intro/setup', 'HomeController@introSetup');

});
