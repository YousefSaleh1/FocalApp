<?php

use App\Http\Controllers\API\AnswersController;
use App\Http\Controllers\API\FreelancerController;
use App\Http\Controllers\API\AuthController;
<<<<<<< Updated upstream
use App\Http\Controllers\JobSeekerController;
=======
use App\Http\Controllers\API\BlogerController;
use App\Http\Controllers\API\FilteringController;
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    
=======
Route::apiResource('blogers',BlogerController::class);
Route::post('/filter',[FilteringController::class,'filter']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
>>>>>>> Stashed changes
    return $request->user();
});
Route::post('/register',[AuthController::class,'register']);
Route::POST('/login', [AuthController::class, 'login'])->name('login');

<<<<<<< Updated upstream

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/ShowJobQandA/{jop_id}', [AnswersController::class, 'ShowJobQandA']);
    Route::post('/storeAnswer/{question_id}', [AnswersController::class, 'storeAnswer']);
    Route::get('/showAnswer/{question_id}', [AnswersController::class, 'showAnswer']);


    });


Route::apiResource('/freelancer', FreelancerController::class);

=======
>>>>>>> Stashed changes
// Route::resource('roles', RoleController::class);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::resource('jobseeker',JobSeekerController::class);

});

