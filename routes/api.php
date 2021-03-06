<?php

use App\Http\Controllers\API\CubeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cube', [CubeController::class, 'index']);
Route::post('/cube', [CubeController::class, 'store']);
Route::get('/cube/{cube}', [CubeController::class, 'show']);
Route::post('/cube/{cube}/rotation', [CubeController::class, 'rotation']);

