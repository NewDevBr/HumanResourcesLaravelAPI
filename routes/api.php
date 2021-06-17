<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, VacancyController, CandidateController};

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

Route::group(['prefix' => '/admin','middleware' => 'auth:sanctum'], function(){
    
    Route::get('{id}', [AdminController::class, 'show']);
    Route::get('/', [AdminController::class, 'index']);
    
    Route::post('/', [AdminController::class, 'store']);
    Route::post('/photo/{id}', [AdminController::class, 'updatePhoto']);
    Route::post('/revokeToken', [AuthController::class, 'revokeToken']);
    
    Route::put('/', [AdminController::class, 'update']);
    
    Route::delete('/{id}', [AdminController::class, 'destroy']);
});


Route::group(['prefix' => '/vacancy','middleware' => 'auth:sanctum'], function(){
    
    Route::get('/{id}', [VacancyController::class, 'show']);
    Route::get('/', [VacancyController::class, 'index']);
    
    Route::post('/', [VacancyController::class, 'store']);
    
    Route::put('/', [VacancyController::class, 'update']);
    
    Route::delete('/{id}', [VacancyController::class, 'destroy']);
});


Route::post('candidate/login', [AuthController::class, 'loginCandidate']);
Route::post('candidate', [CandidateController::class, 'store']);

Route::group(['prefix'=>'/candidate', 'middleware'=>'auth:sanctum'],function(){
    
    Route::get('/{id}', [CandidateController::class, 'show']);
    Route::get('/', [CandidateController::class, 'index']);
    
    Route::post('/revokeToken', [AuthController::class, 'revokeToken']);
    
    Route::put('/{id}', [CandidateController::class, 'update']);
    
    Route::delete('/{id}', [CandidateController::class, 'destroy']);
});