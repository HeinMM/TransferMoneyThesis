<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SignatureForStoreTransaction
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
        if ($request->signature) {
            try {
                $decryptSig =  $request->signature;
                $stringSig =
                md5($request->agentCode . $request->processIdentifier . $request->nation_id . $request->senderName . $request->senderPhone . $request->senderIdType . $request->senderId . $request->relation . $request->purpose . $request->sourceOfFund . $request->recipentName . $request->recipentPhone  .
                $request->recipentIdType . $request->recipentId. $request->paymentName . $request->paymentNumber . $request->sendingCountry . $request->receivingAmount . $request->receivingCurrency . $request->receivingCountry . $request->forexSession . $request->exRate);

                if ($stringSig == $decryptSig) {
                    return $next($request);
                } else {
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
                "message" => "There is no signature data!"
            ]);
        }

        return $next($request);
    }
}
