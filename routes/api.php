<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CareerOfficeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployerController;

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

// http://127.0.0.1:8000/api/register
Route::post('/register', [UserAuthController::class, 'register']);

// http://127.0.0.1:8000/api/login
Route::post('/login', [UserAuthController::class, 'login']);

// Route to get logged-in user information, requires authentication
Route::middleware('auth:api')->get('/user/me', [UserAuthController::class, 'me']);


/*
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

*/

Route::post('/register', [UserController::class, 'store']);

Route::get('/admin/employers', [EmployerController::class, 'index']);
Route::patch('/admin/employers/{employerId}', [AdministratorController::class, 'verifyEmployer']);
Route::post('/admin/blacklist/{userId}', [AdministratorController::class, 'addToBlackList']);
Route::delete('/admin/blacklist/{userId}', [AdministratorController::class, 'removeFromBlackList']);