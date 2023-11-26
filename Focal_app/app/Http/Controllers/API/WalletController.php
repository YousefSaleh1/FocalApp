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



    public function show(Request $request){
        $userwalet = Wallet::where('user_id',$request->user_id)->get();
        if  ($userwalet){
            return $this->apiResponse($userwalet,'','we found user wallet',200);
        }
        return $this->apiResponse(null,'','sorry we dont found wallet',400);
    }

    public function store(Request $request){
        $checkuser = User::where('user_id',$request->user_id)->first();
        if ($checkuser){
            $wallet =   Wallet::Create([
                'user_id'=> $request->user_id,
                'current'=> 0,
                'point'=> 0,
            ]);

            return $this->apiResponse($wallet,'','Wallet Created to user',200);
        }
        return $this->apiResponse($checkuser,'','sorry dosent find user',200);
    }

    public function PayToFreelancer(Request $request){
        $freelancer = Wallet::where('user_id',$request->freelancer_id)->first();
        $BuissnessOwner = Wallet::where('user_id',$request->buissnessowner_id)->first();
        if ($BuissnessOwner && $freelancer){
            if ($BuissnessOwner->current > 0 && $BuissnessOwner->current > $request->amount) {

                $BuissnessOwnerproccess = Processe::Create([
                    'walet_id' => $BuissnessOwner->id,
                    'contact_number' => $request->contact_number,
                    'amount' => $request->amount,
                    'sender_name' => "buissnessowner",
                    'sender_id_number' => $request->buissnessowner_id,
                    'payment_method' => "withdraw",
                    'receipt_number' => $request->receipt_number,
                    'receiver_id_number' => $request->freelancer_id,
                    'password_vorifi' => $request->password_vorifi,

                ]);

                Wallet::where('user_id', $BuissnessOwner->id)
                ->update(['current' => $BuissnessOwner->current - $request->amount ]);

                $freelancerproccess = Processe::Create([
                    'walet_id' => $freelancer->id,
                    'contact_number' => $request->contact_number,
                    'amount' => $request->amount,
                    'sender_name' => "buissnessowner",
                    'sender_id_number' => $request->freelancer_id,
                    'payment_method' => "Deposit",
                    'receipt_number' => $request->receipt_number,
                    'receiver_id_number' => $request->buissnessowner_id,
                    'password_vorifi' => $request->password_vorifi,

                ]);

                Wallet::where('user_id', $freelancer->id)
                ->update(['current' => $freelancer->current + $request->amount]);

                return $this->apiResponse($freelancerproccess,'','success pay to freelancer & withdraw form buissness owner',200);
            }

            return $this->apiResponse(null,'','sorry your current not enouph',400);
        }else{
            return $this->apiResponse(null,'','sorry we dident find wallets',400);
        }
    }



}
