<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplainRequest;
use App\Http\Resources\ComplainResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadPhotoTrait;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplainController extends Controller
{
    use ApiResponseTrait, UploadPhotoTrait;
    public function index()
    {
        $complans = Complain::all();
        return $this->customeRespone(ComplainResource::collection($complans), 'all complains', 200);
    }

    public function store(ComplainRequest $request)
    {
        $validate = $request->validated();
        $user_id = Auth::user()->id;
        if (!empty($request->photoURL)) {

            $path = $this->UploadPhoto($request , 'complains' , 'photoURL');
        }else {
            $path=null;
        }

        $complain = Complain::create([
            'user_id'         => $user_id,
            'complain_type'   => $request->complain_type,
            'complain_reason' => $request->complain_reason,
            'photoURL'        => $path
        ]);


        if ($complain) {
            return $this->customeRespone(new ComplainResource($complain), 'Successful', 201);
        }
        return $this->customeRespone(null, 'not found', 404);
    }

    public function show(Complain $complain)
    {
        if ($complain) {
            return $this->customeRespone(new ComplainResource($complain), 'ok', 200);
        }
        return $this->customeRespone(null, 'Complain not found', 404);
    }

    public function destroy(Complain $complain)
    {
        if (!$complain) {
            return $this->customeRespone(null , 'Complain not found' , 400);
        }
        $complain->delete();
        return $this->customeRespone(' ' , 'Complain deleted successfully' , 200);
    }
}
