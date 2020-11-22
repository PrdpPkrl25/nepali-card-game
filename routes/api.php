<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('games', 'GameController');
Route::resource('players', 'PlayerController');
Route::resource('points', 'PointController');
Route::resource('rounds', 'RoundController');
Route::get('points-table/{gameId}', 'PointController@total')->name('points.table');
Route::post('points/delete/{roundId}', 'PointController@destroy')->name('points.delete');
Route::get('player/{id}/points/', 'PointController@playerPoint')->name('points.player');
Route::post('view/points-table', 'PointController@viewTotal')->name('view.table')->middleware('check.access');
Route::get('game/info', 'GameController@info')->name('game.info');
