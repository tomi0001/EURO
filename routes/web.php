<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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
Route::get('/', [MainController::class, 'index'])->name("index");
Route::get('/addCountry', [MainController::class, 'addCountry'])->name("addCountry");
Route::get('/addCountrySubmit', [MainController::class, 'addCountrySubmit'])->name("addCountrySubmit");
Route::get('/addMatch', [MainController::class, 'addMatch'])->name("addMatch");
Route::get('/addMatchSubmit', [MainController::class, 'addMatchSubmit'])->name("addMatchSubmit");
Route::get('/showMatch', [MainController::class, 'showMatch'])->name("showMatch");
Route::get('/updateMatch', [MainController::class, 'updateMatch'])->name("updateMatch");
Route::get('/addGroups', [MainController::class, 'addGroups'])->name("addGroups");
Route::get('/addGroupsSubmit', [MainController::class, 'addGroupsSubmit'])->name("addGroupsSubmit");
Route::get('/showGroups/{nameGroups?}', [MainController::class, 'showGroups'])->name("showGroups");
Route::get('/settingGroups', [MainController::class, 'settingGroups'])->name("settingGroups");
Route::get('/updateGroups', [MainController::class, 'updateGroups'])->name("updateGroups");
//Route::get('/','App\Http\Controlles\MainController@index')->name('main');
