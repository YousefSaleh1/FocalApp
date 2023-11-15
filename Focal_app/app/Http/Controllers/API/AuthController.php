<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(StoreUser $request){

        $user = $request->validated();

        $user = User::create([
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'role_name' => $user['role_name'],
            'status' => $user['status'],
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->apiResponse(new UserResource($user),$token,'registered successfully',200);

    }


    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->apiResponse(new UserResource($user),$token,'successfully login,welcome!',200);

    }
}
