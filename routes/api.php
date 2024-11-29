<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CareerOfficeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EducationMaterialsController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\OfferCompetenceController;



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
Route::get('/offer/list', [OfferController::class, 'index']);
Route::post('/offer/add', [OfferController::class, 'store']);
Route::get('/offer/{id}', [OfferController::class, 'show']);
Route::get('/offer/competence/{competenceId}', [OfferCompetenceController::class, 'getOfferIdsByCompetenceId']);
Route::delete('/offer/delete/{offerId}', [OfferController::class, 'destroy']);

Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::post('/admin/register', [UserAuthController::class, 'registerPriviligedUser']);
    Route::get('/admin/employers', [EmployerController::class, 'index']); // Trzeba zmienic dodawanie tak zeby korzystal z 'store'
    Route::patch('/admin/edit/{adminId}', [AdministratorController::class, 'update']);
    Route::patch('/admin/employers/{employerId}', [AdministratorController::class, 'verifyEmployer']);
    Route::post('/admin/blacklist/{userId}', [AdministratorController::class, 'addToBlackList']);
    Route::delete('/admin/blacklist/{userId}', [AdministratorController::class, 'removeFromBlackList']);
    // dodac listowanie uzytkonikow ktorzy sa na blackliscie
});

// Done ~Dominik - działa middleware i updatowanie tylko siebie jako employer
Route::middleware(['auth:api', 'employer'])->group(function () {
    Route::patch('/employer/{employerId}', [EmployerController::class, 'update']);
    Route::get('/employer/my_offers', [OfferController::class, 'getMyOffers']);
});

Route::get('/competence/list', [CompetenceController::class, 'index']);

Route::middleware(['auth:api', 'career_office'])->group(function () {
    Route::patch('/career_office/edit/{careerOfficeId}', [CareerOfficeController::class, 'update']);
});

Route::patch('/student/edit', [StudentController::class, 'update']);

Route::middleware(['auth:api', 'offer'])->group(function () {
    Route::get('/offer/list/{employerId}', [OfferController::class, 'getOffersByEmployerId']);
});

// DLA WSZYZTKICH ENDPOINTOW KTORE MAJA DO CZYNIENIA ZE ZWRACANIEM OFERT TRZEBA ZWRACAC ROWNIEZ PRACODAWCE I COMPETENCE DLA TEJ OFERTY (W JEDNYM ENDPOINCIE)

Route::middleware(['auth:api', 'education_materials'])->group(function () {
    Route::get('/education_materials/list', [EducationMaterialsController::class, 'index']);
    Route::get('/education_materials/list/{careerOfficeId}', [EducationMaterialsController::class, 'listEducationalMaterialsByCareerOfficeId']);
    Route::get('/education_materials/{id}', [EducationMaterialsController::class, 'listSingleEducationalMaterial']);
    Route::post('/education_materials/add', [EducationMaterialsController::class, 'store']);
    Route::patch('/education_materials/edit/{educationMaterialId}', [EducationMaterialsController::class, 'update']);
    Route::delete('/education_materials/delete/{educationMaterialId}', [EducationMaterialsController::class, 'destroy']);
});