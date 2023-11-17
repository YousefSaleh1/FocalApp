<?php

namespace App\Traits;
use Illuminate\Http\Request;


trait UploadPhotoTrait {
    public function UploadPhoto(Request $request, $folderName, $fileName)
     {
     $photo =time() .'.'. $request->file($fileName)->getClientOriginalName();
     $path = $request->file($fileName)->storeAs($folderName,$photo,'photos');
     return $path
    }
}
