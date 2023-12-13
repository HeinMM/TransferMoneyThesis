<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SignatureForRate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($request) && $request->signature) {
                try {

                   $decryptSig =  $request->signature;
                   $stringSig =md5($request->agentCode . $request->processIdentifier . $request->receivingCountry . $request->sendingCountry . $request->receivingCurrency . $request->rate);

                    if ($stringSig == $decryptSig) {
                        return $next($request);
                    }else {
                    return response()->json([
                        "code" => "106",
                        "message" => "Signature is something wrong!"
                    ]);
                    }

                } catch (DecryptException $e) {
                    return response()->json([
                        "code" => "104",
                        "message" => "data encryption is something wrong!"
                    ]);

            }
        } else {
            return response()->json([
                "code" => "105",
                "message" => "There is no form data!"
            ]);
        }

        //  return $next($request);
    }
}
