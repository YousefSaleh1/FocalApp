<?php

use App\Http\Controllers\API\UserinfoController;
use App\Http\Controllers\API\AnswersController;
use App\Http\Controllers\API\FreelancerController;
use App\Http\Controllers\API\AuthController;
<<<<<<< HEAD
<<<<<<< Updated upstream
use App\Http\Controllers\JobSeekerController;
=======
use App\Http\Controllers\API\BlogerController;
use App\Http\Controllers\API\FilteringController;
>>>>>>> Stashed changes
=======

use App\Http\Controllers\API\ProcessController;
use App\Http\Controllers\API\WalletController;


use App\Models\BusinessOwner;
>>>>>>> cd8bfa4dea1e98d6ca2525e1b65d653c03495442
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BusinessOwnerController;

use App\Http\Controllers\API\ResumeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\API\JopController;
use App\Http\Controllers\JobSeekerController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\CategoryController;



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
    Route::get('/Wallet/{userid}', [WalletController::class, 'usercredit']);
    Route::post('/Wallet/{userid}', [WalletController::class, 'createwallet']);
    Route::post('/Wallet/AddToWallet/{walletid}', [ProcessController::class, 'AddToCredit']);
    Route::post('/Wallet/WithdrawFromWallet/{walletid}', [ProcessController::class, 'WithdrawFromCredit']);
});


Route::resource('user_info',UserinfoController::class);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/ShowJobQandA/{jop_id}', [AnswersController::class, 'ShowJobQandA']);
    Route::post('/storeAnswer/{question_id}', [AnswersController::class, 'storeAnswer']);
    Route::get('/showAnswer/{question_id}', [AnswersController::class, 'showAnswer']);
    
)};

    Route::get('/index/{jop_id}', [QuestionController::class, 'index']);
    Route::post('/storeQuestion/{answer_id}', [QuestionController::class, 'storeQuestion']);
    Route::get('/showQuestion/{answer_id}', [QuestionController::class, 'showQuestion']);


<<<<<<< HEAD
    });


Route::apiResource('/freelancer', FreelancerController::class);

=======
>>>>>>> Stashed changes
// Route::resource('roles', RoleController::class);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::resource('jobseeker',JobSeekerController::class);
=======
Route::group(['middleware'=> ['auth:sanctum']], function () {
    
    Route::resource('resumes',ResumeController::class);
>>>>>>> cd8bfa4dea1e98d6ca2525e1b65d653c03495442

});

Route::apiResource('/freelancer', FreelancerController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {


 Route::resource('businessowner', BusinessOwnerController::class);
});

Route::resource('city', CityController::class);
// Route::resource('roles', RoleController::class);


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
Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::resource('jobseeker',JobSeekerController::class);
    Route::resource('jops',JopController::class);
});

