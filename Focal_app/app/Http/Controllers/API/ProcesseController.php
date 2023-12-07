<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProcessRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\CreateTrait;
use App\Models\Processe;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProcesseController extends Controller
{
    use ApiResponseTrait , CreateTrait;


    public function processe(StoreProcessRequest $request)
    {
        $sender_id = Auth::user()->id;
        $sender_wallet = Wallet::where('user_id', $sender_id)->first();


        $receiver_number = $request->contact_number;
        $receiver_info = UserInfo::where('phone_number' , $receiver_number)->first();
        $receiver = User::where('id' ,$receiver_info->user_id )->first();
        if(empty($receiver)){
            return  response()->json(['message' => 'Sorry, the receiver does not exist'], 404);
        }
        $receiver_wallet = Wallet::where('user_id', $receiver->id)->first();

        $amonunt = $request->amount;

        DB::beginTransaction();

        if ($sender_wallet->current < $amonunt) {
            DB::rollBack();
            return $this->customeRespone(null ,'Insufficient balance' , 400 ) ;
        }
        $proccesse = $this->CreateProcesse($request , 'Withdraw' , $sender_wallet->id);
        $sender_wallet->current -= $amonunt ;
        $sender_wallet->save();

        $proccesse = $this->CreateProcesse($request , 'Deposit' , $receiver_wallet->id);
        $receiver_wallet->current += $amonunt ;
        $receiver_wallet->save();

        DB::commit();

        return response()->json(['message' => 'Balance added successfully'], 200);
    }
}
