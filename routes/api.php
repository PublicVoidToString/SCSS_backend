<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AdministratorAuthController;
use App\Http\Controllers\PracodawcaAuthController;
use App\Http\Controllers\PracownikBiuraKarierAuthController;

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

Route::post('student/register', [StudentAuthController::class, 'register']);
Route::post('student/login', [StudentAuthController::class, 'login']);
Route::middleware('auth:student')->get('student/me', [StudentAuthController::class, 'me']);

Route::post('administrator/register', [AdministratorAuthController::class, 'register']);
Route::post('administrator/login', [AdministratorAuthController::class, 'login']);
Route::middleware('auth:administrator')->get('administrator/me', [AdministratorAuthController::class, 'me']);

Route::post('pracodawca/register', [PracodawcaAuthController::class, 'register']);
Route::post('pracodawca/login', [PracodawcaAuthController::class, 'login']);
Route::middleware('auth:pracodawca')->get('pracodawca/me', [PracodawcaAuthController::class, 'me']);

Route::post('pracownikbiurakarier/register', [PracownikBiuraKarierAuthController::class, 'register']);
Route::post('pracownikbiurakarier/login', [PracownikBiuraKarierAuthController::class, 'login']);
Route::middleware('auth:pracownikbiurakarier')->get('pracownikbiurakarier/me', [PracownikBiuraKarierAuthController::class, 'me']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:administrator-api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:pracodawca-api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:pracownik-api')->get('/user', function (Request $request) {
    return $request->user();
});