<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    use ApiResponseTrait;



    public function show(Request $request)
    {
        $userwalet = Wallet::where('user_id', $request->user_id)->get();
        if ($userwalet) {
            return $this->apiResponse($userwalet, '', 'we found user wallet', 200);
        }
        return $this->apiResponse(null, '', 'sorry we dont found wallet', 400);
    }

    public function update(Request $request, string $id)
    {
        $wallet = Wallet::find($id);
        $user = Auth::user();
        if ($user->role_name == "Admin") {
            $wallet->update([
                'current' => $request->current,
                'point' => $request->point,
            ]);

            return $this->customeRespone($wallet, 'The wallet has been added successfully', 200);
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }
}
