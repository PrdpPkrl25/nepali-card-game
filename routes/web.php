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


Route::get('/', function () {return view('welcome');});

Route::resource('games', 'GameController');
Route::resource('players', 'PlayerController');
Route::resource('points', 'PointController');
Route::get('points-table', 'PointController@total')->name('points.table');
Route::post('points/delete/{roundId}', 'PointController@destroy')->name('points.delete');

Route::get('code-input-page', 'PointController@codeInputPage')->name('code.input.page');
Route::get('view/points-table', 'PointController@viewTotal')->name('view.table')->middleware('check.access');
Route::get('game/info', 'GameController@info')->name('game.info');


