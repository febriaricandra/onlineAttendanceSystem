<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AttendancesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("user", UsersController::class);
Route::apiResource("event", EventsController::class);
Route::apiResource("attendance", AttendancesController::class);
Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Selamat Datang di API Absensi',
        'data' => ''
    ], 200);
});

Route::post('login', [AuthController::class, 'login']);


//route for upcoming event
Route::get('upcoming', [EventsController::class, 'upcoming']);