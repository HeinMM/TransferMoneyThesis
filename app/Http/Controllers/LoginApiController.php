<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginApiController extends Controller
{
    private static  $processIdentifier = "NOTHING";
    public function login(Request $request)
    {
        $processIdentifier = "NOTHING";

        $login = $request->validate([
            'agentCode' => 'required|string',
            'password' => 'required|string',
        ]);

        $request->validate([
            'authKey' => 'required|string'
        ]);

        // $authKey  =  $request->authKey;
        // $cipher = "AES-256-CBC";
        // $secret = "k10VSO848S2pnf3vY!d%nYyqR6q6B89Y";
        // $options = 0;
        // $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        // $encryptedString = openssl_encrypt($authKey, $cipher, $secret, $options, $iv);
        // return $encryptedString;
        // $realAuthKey = openssl_decrypt($request->authKey,$cipher,$secret,$options,$iv);
        // return $realAuthKey;

        // return $encryptedString;
        // return $data;



        // $getAuthKey = DB::table('users')->where('authKey', '=', $request->authKey)->get();
        // return $getAuthKey->count();

        if (!Auth::attempt($login)) {
            return response()->json([
                'code' => '101',
                'message' => 'AgentCode and pw Invalid credentials!'
            ]);
        }


        if (!Hash::check($request->authKey, Auth::user()->authKey)) {
            return response()->json([
                'code' => '102',
                'message' => "AuthKey is invalid!"
            ]);
        }

        /** @var \App\Models\User */
        $currentUser = Auth::user();
        $accessToken = $currentUser->createToken('authToken')->accessToken;


        return response()->json([
            "code" => "000",
            "message" => "Authentication success!",
            'detail' => [
                "token"=> $accessToken,
                "note" => "Token will only be Valid for 5 minutes.",
                "processIdentifier" => $currentUser->processIdentifier
        ]
        ]);
    }
}
