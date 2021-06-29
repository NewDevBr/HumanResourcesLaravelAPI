<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    VacancyController,
    CandidateController,
    TechnologyController,
    DiplomaController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/


Route::post('admin/login', [AuthController::class, 'loginAdmin']);


Route::group(['prefix' => '/admin', 'middleware' => 'auth:sanctum'], function () {
    
    Route::get('/{id}', [AdminController::class, 'show']);
    Route::get('/', [AdminController::class, 'index']);
    
    Route::post('/admin', [AdminController::class, 'store']);
    Route::post('/photo/{id}', [AdminController::class, 'updatePhoto']);
    Route::post('/revokeToken', [AuthController::class, 'revokeToken']);

    Route::put('/{id}', [AdminController::class, 'update']);
    Route::put('/changePassword/{id}', [AdminController::class, 'updatePassword']);

    Route::delete('/{id}', [AdminController::class, 'destroy']);
});


Route::group(['prefix' => '/vacancy', 'middleware' => 'auth:sanctum'], function () {

    Route::get('/applicable/{idCandidate}', [VacancyController::class, 'applicable']);
    Route::get('/applied/{idCandidate}', [VacancyController::class, 'applied']);
    Route::get('/{id}', [VacancyController::class, 'show']);
    Route::get('/', [VacancyController::class, 'index']);

    Route::post('/', [VacancyController::class, 'store']);
    Route::post('/apply', [VacancyController::class, 'apply']);

    Route::put('/{id}', [VacancyController::class, 'update']);

    Route::delete('/{id}', [VacancyController::class, 'destroy']);
});


Route::post('candidate/login', [AuthController::class, 'loginCandidate']);
Route::post('candidate', [CandidateController::class, 'store']);

Route::group(['prefix' => '/candidate', 'middleware' => 'auth:sanctum'], function () {

    Route::get('/vacancy/{id}', [CandidateController::class, 'candidateByVacancyId']);
    Route::get('/{id}', [CandidateController::class, 'show']);
    Route::get('/', [CandidateController::class, 'index']);

    Route::post('/TechnologiesThatCandidateKnows/{id}', [CandidateController::class, 'saveTechnologies']);
    Route::post('/photo/{id}', [CandidateController::class, 'updatePhoto']);
    Route::post('/revokeToken', [AuthController::class, 'revokeToken']);

    Route::put('/changePassword/{id}', [CandidateController::class, 'updatePassword']);
    Route::put('/{id}', [CandidateController::class, 'update']);

    Route::delete('/{id}', [CandidateController::class, 'destroy']);
});

Route::group(['prefix' => '/technology', 'middleware' => 'auth:sanctum'], function () {

    Route::get('/like/{searchedValue}', [TechnologyController::class, 'searchToList']);
    Route::get('/{id}', [TechnologyController::class, 'show']);
    Route::get('/', [TechnologyController::class, 'index']);
    Route::get('/candidate/{idCandidate}', [TechnologyController::class, 'candidateTechnologies']);

    Route::post('/', [TechnologyController::class, 'store']);

    Route::put('/{id}', [TechnologyController::class, 'update']);

    Route::delete('/{id}', [TechnologyController::class, 'destroy']);
});

Route::group(['prefix' => '/diploma', 'middleware' => 'auth:sanctum'], function () {

    Route::get('/candidate/{idCandidate}', [DiplomaController::class, 'show']);

    Route::post('/candidate/{idCandidate}', [DiplomaController::class, 'store']);

    Route::put('/{id}', [DiplomaController::class, 'update']);

    Route::delete('/{id}', [DiplomaController::class, 'destroy']);
});
