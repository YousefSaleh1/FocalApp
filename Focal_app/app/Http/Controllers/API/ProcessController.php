<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Processes;
use App\Http\Requests\StoreProcessRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Walets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcessController extends Controller
{
    use ApiResponseTrait;



    public function AddToWallet(StoreProcessRequest $request)
    {
        $validator = $request->validated();
        if($validator->fails()){
            return $this ->apiResponse(null, "",$validator->errors(),400);
        }else{
            $proccess = Processes::Create([
                'walet_id'=> $request->walet_id ,
                'contact_number'=> $request->contact_number  ,
                'amount'=> $request->amount  ,
                'sender_name'=> $request->sender_name ,
                'sender_id_number'=> $request->sender_id_number ,
                'payment_method'=> "Deposit" ,
                'receipt_number'=> $request->receipt_number ,
                'receiver_id_number'=> $request->receiver_id_number ,
                'password_vorifi'=> $request->password_vorifi ,

            ]);
            $oldamount = Walets::where('id', $request->walet_id)->get();
            Walets::where('id', $request->walet_id)->update(['amount' => $oldamount->amount + $request->amount]);


            $this ->apiResponse($proccess, "","Add To Credit Success",200);
        }

    }

    public function WithdrawFromWallet(StoreProcessRequest $request)
    {
        $validator = $request->validated();
        if($validator->fails()){
            return $this ->apiResponse(null, "",$validator->errors(),400);
        }else{
            $wallet = Walets::findorFail($request->wallet_id);
            if ($wallet->amount > 0 && $wallet->amount <= $request->amount) {
                $proccess = Processes::Create([
                    'walletid'=> $request->walet_id ,
                    'contact_number'=> $request->contact_number  ,
                    'amount'=> $request->amount  ,
                    'sender_name'=> $request->sender_name ,
                    'sender_id_number'=> $request->sender_id_number ,
                    'payment_method'=> "Withdraw" ,
                    'receipt_number'=> $request->receipt_number ,
                    'receiver_id_number'=> $request->receiver_id_number ,
                    'password_vorifi'=> $request->receiver_id_number ,

                ]);

                Walets::where('id', $request->walet_id)->update(['amount' => $wallet->amount - $request->amount]);

                $this ->apiResponse($proccess, "","Withdraw Success",200);
            }
            return $this ->apiResponse(null, "","Amount in Wallet not Enough",400);


        }
    }




}
