<?php

use App\Http\Controllers\API\UserinfoController;
use App\Http\Controllers\API\AnswersController;
use App\Http\Controllers\API\FreelancerController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SocialiteController;

use App\Http\Controllers\API\ProcessController;
use App\Http\Controllers\API\WalletController;

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

Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::POST('/login', [AuthController::class, 'login'])->name('login');




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

});

    Route::get('/index/{jop_id}', [QuestionController::class, 'index']);
    Route::post('/storeQuestion/{answer_id}', [QuestionController::class, 'storeQuestion']);
    Route::get('/showQuestion/{answer_id}', [QuestionController::class, 'showQuestion']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/ShowJobQandA/{jop_id}', [AnswersController::class, 'ShowJobQandA']);
    Route::post('/storeAnswer/{question_id}', [AnswersController::class, 'storeAnswer']);
    Route::get('/showAnswer/{question_id}', [AnswersController::class, 'showAnswer']);
});

Route::get('/index/{jop_id}', [QuestionController::class, 'index']);
Route::post('/storeQuestion/{answer_id}', [QuestionController::class, 'storeQuestion']);
Route::get('/showQuestion/{answer_id}', [QuestionController::class, 'showQuestion']);


Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::resource('resumes', ResumeController::class);
});

Route::apiResource('/freelancer', FreelancerController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {


    Route::resource('businessowner', BusinessOwnerController::class);
});

Route::resource('city', CityController::class);

Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::resource('resumes',ResumeController::class);

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

