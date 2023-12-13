<?php

namespace App\Http\Controllers;

use App\Http\Resources\RateResource;
use App\Models\Rate;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class RateApiController extends Controller
{
    public function currentRate(Request $request){

        // try {
        //     $request->type = Crypt::decryptString($request->type);
        //     $request->processIdentifier = Crypt::decryptString($request->processIdentifier);
        //     $request->agentCode = Crypt::decryptString($request->agentCode);
        // } catch (DecryptException $e) {
        //     return response()->json([
        //         "code" => "104",
        //         "message" => "data encryption is something wrong!"
        //     ]);
        // }


        //     $testSig = $request->agentCode. $request->receivingCountry . $request->sendingCountry . $request->receivingCurrency . $request->rate;
        // return Crypt::encryptString($testSig);


        Validator::make($request->all(), [
            'agentCode' => 'required|string',
            'processIdentifier' => 'required|string',
            'receivingCountry' => 'required|string',
            'sendingCountry' => 'required|string',
            'receivingCurrency' => 'required|string',
            'signature' => 'required|string'
        ])->validate();

        if ($request->receivingCountry == "MMR" && $request->sendingCountry == "KR" && $request->receivingCurrency == "MMK") {
            $rate = Rate::all()->last();
            return response()->json([
                "Code" => "000",
                "message" => "Ex-Rate calculated successfully",
                "processIdentifier" => $request->processIdentifier,
                "Detail" =>
                new RateResource($rate)
            ]);
        }
        return response()->json([
            "Code" => "107",
            "message" => "Check your country code and currency code!"
        ]);

    }
}
