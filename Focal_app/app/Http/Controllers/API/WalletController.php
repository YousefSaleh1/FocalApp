<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WalletResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Processe;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    use ApiResponseTrait;



    public function show(string $id)
    {
        $userwalet = Wallet::find($id);
        if ($userwalet) {
            return $this->customeRespone(new WalletResource($userwalet), 'we found user wallet', 200);
        }
        return $this->customeRespone(null, 'sorry we dont found wallet', 400);
    }

    public function update(Request $request, string $id)
    {
        $wallet = Wallet::find($id);
        $user = Auth::user();
        if ($user->role_name == "admin") {
            $wallet->update([
                'current' => $request->current,
                'point' => $request->point,
            ]);
            $receiver_id = $wallet->user_id;
            $receiver_info = UserInfo::where('user_id', $receiver_id)->first();
            Processe::Create([
                'wallet_id'           => $wallet->id,
                'contact_number'      =>  0000000,
                'amount'              => $request->current,
                'sender_name'         => "Focal_X",
                'sender_id_number'    => "1",
                'payment_method'      => "Deposit",
                'receipt_number'      => 1000000,
                'receiver_name'       => $receiver_info->full_name,
                'receiver_id_number'  => $receiver_id,
                'address'             => 'XXXXX',
                'password_vorifi'     => "00000000000",

            ]);
            return $this->customeRespone(new WalletResource($wallet), 'The wallet has been added successfully', 200);
        }
        return $this->customeRespone(null, 'Sorry, you do not have permission for this', 401);
    }
}
