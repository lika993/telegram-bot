<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Validator;

class QrCodeController extends Controller
{
    public function createCode (Request $request){

		$image = QrCode::encoding('UTF-8')->size(250)->backgroundColor(255,255,204)->generate($request->data);

		 $validator = Validator::make($request->all(), [
            'data' => 'required|min:1|max:500'

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 500);
        }

		return response($image);
    }
}
