<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {

        try {

            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {

                $new_user = User::create([
                    'email'        => $googleUser->email,
                    'google_id' => $googleUser->id,
                ]);


                $token = $new_user->createToken('google-access-token')->plainTextToken;
                return response()->json(['token' => $token, 'message' => 'Success']);
            } else {
                $token = $user->createToken('google-access-token')->plainTextToken;
                return response()->json(['token' => $token, 'message' => 'Success']);
            }
        } catch (\Throwable $th) {
            dd('Someting went wrong !' . $th->getMessage());
        }
    }
}
