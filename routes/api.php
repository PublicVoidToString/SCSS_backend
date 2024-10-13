<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CareerOfficeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\AdministratorController;


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

Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/register', [UserAuthController::class, 'register']);

// Route to get logged-in user information, requires authentication
Route::middleware('auth:api')->get('/user/me', [UserAuthController::class, 'me']);

Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::post('/admin/register', [UserAuthController::class, 'registerPrivilegedUser']);
    Route::get('/admin/employers', [EmployerController::class, 'index']);
    Route::patch('/admin/employers/{employerId}', [AdministratorController::class, 'verifyEmployer']);
    Route::post('/admin/blacklist/{userId}', [AdministratorController::class, 'addToBlackList']);
    Route::delete('/admin/blacklist/{userId}', [AdministratorController::class, 'removeFromBlackList']);
});