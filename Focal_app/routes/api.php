<?php

use App\Http\Controllers\API\AnswersController;
use App\Http\Controllers\API\FreelancerController;
use App\Http\Controllers\API\AuthController;
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

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    
    return $request->user();
});
Route::post('/register',[AuthController::class,'register']);
Route::POST('/login', [AuthController::class, 'login'])->name('login');


Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/ShowJobQandA/{jop_id}', [AnswersController::class, 'ShowJobQandA']);
    Route::post('/storeAnswer/{question_id}', [AnswersController::class, 'storeAnswer']);
    Route::get('/showAnswer/{question_id}', [AnswersController::class, 'showAnswer']);

    Route::get('/index/{jop_id}', [QuestionController::class, 'index']);
    Route::post('/storeQuestion/{answer_id}', [QuestionController::class, 'storeQuestion']);
    Route::get('/showQuestion/{answer_id}', [QuestionController::class, 'showQuestion']);


    });


Route::apiResource('/freelancer', FreelancerController::class);

// Route::resource('roles', RoleController::class);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::resource('jobseeker',JobSeekerController::class);

});

