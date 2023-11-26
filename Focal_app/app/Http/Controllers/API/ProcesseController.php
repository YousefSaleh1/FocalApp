<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProcessRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Processe;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcesseController extends Controller
{
    use ApiResponseTrait;



    public function AddToWallet(StoreProcessRequest $request)
    {
        $validator = $request->validated();
        if ($validator->fails()) {
            return $this->apiResponse(null, "", $validator->errors(), 400);
        } else {
            $proccess = Processe::Create([
                'walet_id' => $request->walet_id,
                'contact_number' => $request->contact_number,
                'amount' => $request->amount,
                'sender_name' => $request->sender_name,
                'sender_id_number' => $request->sender_id_number,
                'payment_method' => "Deposit",
                'receipt_number' => $request->receipt_number,
                'receiver_id_number' => $request->receiver_id_number,
                'password_vorifi' => $request->password_vorifi,

            ]);
            $oldamount = Wallet::where('id', $request->walet_id)->get();
            Wallet::where('id', $request->walet_id)->update(['amount' => $oldamount->amount + $request->amount]);


            $this->apiResponse($proccess, "", "Add To Credit Success", 200);
        }
    }

    public function WithdrawFromWallet(StoreProcessRequest $request)
    {
        $validator = $request->validated();
        if ($validator->fails()) {
            return $this->apiResponse(null, "", $validator->errors(), 400);
        } else {
            $wallet = Wallet::findorFail($request->wallet_id);
            if ($wallet->amount > 0 && $wallet->amount <= $request->amount) {
                $proccess = Processe::Create([
                    'walletid' => $request->walet_id,
                    'contact_number' => $request->contact_number,
                    'amount' => $request->amount,
                    'sender_name' => $request->sender_name,
                    'sender_id_number' => $request->sender_id_number,
                    'payment_method' => "Withdraw",
                    'receipt_number' => $request->receipt_number,
                    'receiver_id_number' => $request->receiver_id_number,
                    'password_vorifi' => $request->receiver_id_number,

                ]);

                Wallet::where('id', $request->walet_id)->update(['amount' => $wallet->amount - $request->amount]);

                $this->apiResponse($proccess, "", "Withdraw Success", 200);
            } else {

                return $this->apiResponse(null, "", "Amount in Wallet not Enough", 400);
            }
        }
    }
}
