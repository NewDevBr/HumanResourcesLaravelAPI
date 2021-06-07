<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, VacancyController, CandidateController};
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


/// Administrative routes

Route::get('admin/{id}', [AdminController::class, "show"]);
Route::get('admin', [AdminController::class, "index"]);
Route::post('admin', [AdminController::class, "store"]);
Route::post('admin/photo/{id}', [AdminController::class, "updatePhoto"]);
Route::put('admin', [AdminController::class, "update"]);
Route::delete('admin/{id}', [AdminController::class, "destroy"]);


/// Vacancies routes just allowed to Admins

Route::get('vacancy/{id}', [VacancyController::class, "show"]);
Route::get('vacancy', [VacancyController::class, "index"]);
Route::post('vacancy', [VacancyController::class, "store"]);
Route::put('vacancy', [VacancyController::class, "update"]);
Route::delete('vacancy/{id}', [VacancyController::class, "destroy"]);


/// Candidates routes

Route::get('candidate/{id}', [CandidateController::class, "show"]);
Route::get('candidate', [CandidateController::class, "index"]);
Route::post('candidate', [CandidateController::class, "store"]);
Route::put('candidate', [CandidateController::class, "update"]);
Route::delete('candidate/{id}', [CandidateController::class, "destroy"]);