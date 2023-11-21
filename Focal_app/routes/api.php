<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GoogleAuthController;
use App\Http\Controllers\API\SocialiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

// Route::resource('roles', RoleController::class);
