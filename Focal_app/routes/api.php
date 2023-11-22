<?php

use App\Http\API\Controllers\CategoryController;
use App\Http\Controllers\API\UserinfoController;
use App\Http\Controllers\API\AnswersController;
use App\Http\Controllers\API\FreelancerController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\BusinessOwnerController;
use App\Http\Controllers\JobSeekerController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/ShowJobQandA/{jop_id}', [AnswersController::class, 'ShowJobQandA']);
    Route::post('/storeAnswer/{question_id}', [AnswersController::class, 'storeAnswer']);
    Route::get('/showAnswer/{question_id}', [AnswersController::class, 'showAnswer']);


    Route::apiResource('/freelancer', FreelancerController::class);

    Route::get('/blogs/{status}', [BlogController::class, 'index']);
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::get('/blogs/{blog}', [BlogController::class, 'show']);
    Route::put('/blogs/{blog}', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    Route::resource('jobseeker',JobSeekerController::class);

    Route::apiResource('businessOwners' , BusinessOwnerController::class);
    });



// Route::resource('roles', RoleController::class);



