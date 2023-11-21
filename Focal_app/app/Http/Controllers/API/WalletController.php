<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Walets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    use ApiResponseTrait;



    public function show(Request $request){
        $userwalet = Walets::where('user_id',$request->user_id)->get();
        if  ($userwalet){
            return $this->apiResponse($userwalet,'','we found user wallet',200);
        }
        return $this->apiResponse(null,'','sorry we dont found wallet',400);
    }



}
