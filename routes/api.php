<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeagueController;
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

Route::group(['prefix' => 'leagues', 'middleware' => ['api-token']], function () {
    Route::get('/', [LeagueController::class, 'index']);
    Route::get('/{league_id}', [LeagueController::class, 'getLeagueName']);
});
