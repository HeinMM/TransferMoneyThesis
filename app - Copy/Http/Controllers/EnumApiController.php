<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankResource;
use App\Http\Resources\IdtypeResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PurposeOfRemitResource;
use App\Http\Resources\RelationResource;
use App\Http\Resources\RidtypeResource;
use App\Http\Resources\SourceOfFundResource;
use App\Models\Bank;
use App\Models\Idtype;
use App\Models\PaymentMethod;
use App\Models\PurposeOfRemit;
use App\Models\Relation;
use App\Models\Ridtype;
use App\Models\SourceOfFund;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class EnumApiController extends Controller
{
    public function getEnums(Request $request)
    {
        // return response()->json([
        //     Crypt::encryptString($request->type),
        //     Crypt::encryptString($request->processIdentifier),
        //     Crypt::encryptString($request->agentCode)
        // ]);


        // $testing = $request->agentCode . $request->processIdentifier . $request->type;
        // return md5($testing);

        Validator::make($request->all(), [
            'type' => 'required|string',
            'processIdentifier' => 'required|string',
            'agentCode' => 'required|string'
        ])->validate();


        $status = User::where('processIdentifier', $request->processIdentifier)
            ->where('agentCode', $request->agentCode)->first();

        if (isset($status->processIdentifier)) {
            switch ($request->type) {

                    //ID Type
                case '01':

                    $enums = Idtype::all();
                    return response()->json([
                        "code" => "0000",
                        "message" => "get enum success",
                        "processIdentifier" => $request->processIdentifier,
                        "Enums" => IdtypeResource::collection($enums)
                    ]);

                    break;

                    //Relation
                case '02':

                    $enums = Relation::all();
                    return response()->json([
                        "code" => "0000",
                        "message" => "get enum success",
                        "processIdentifier" => $request->processIdentifier,
                        "Enums" => RelationResource::collection($enums)
                    ]);

                    break;

                    //Payment method
                case '03':

                    $enums = PaymentMethod::all();
                    return response()->json([
                        "code" => "0000",
                        "message" => "get enum success",
                        "processIdentifier" => $request->processIdentifier,
                        "Enums" => PaymentMethodResource::collection($enums)
                    ]);

                    break;

                    //Bank
                case '04':

                    $enums = Bank::all();
                    return response()->json([
                        "code" => "0000",
                        "message" => "get enum success",
                        "processIdentifier" => $request->processIdentifier,
                        "Enums" => BankResource::collection($enums)
                    ]);

                    break;

                    //Transfer Reason
                case '05':

                    $enums = PurposeOfRemit::all();
                    return response()->json([
                        "code" => "0000",
                        "message" => "get enum success",
                        "processIdentifier" => $request->processIdentifier,
                        "Enums" => PurposeOfRemitResource::collection($enums)
                    ]);

                    break;

                    //FundSource
                case '06':

                    $enums = SourceOfFund::all();
                    return response()->json([
                        "code" => "0000",
                        "message" => "get enum success",
                        "processIdentifier" => $request->processIdentifier,
                        "Enums" => SourceOfFundResource::collection($enums)
                    ]);

                    break;

                    //rIdTypes
                case '07':

                    $enums = Ridtype::all();
                    return response()->json([
                        "code" => "0000",
                        "message" => "get enum success",
                        "processIdentifier" => $request->processIdentifier,
                        "Enums" => RidtypeResource::collection($enums)
                    ]);

                    break;

                default:

                    return response()->json([
                        "code" => "106",
                        "message" => "Type's code number is something wrong!"
                    ]);

                    break;
            }
        } else {
            return response()->json([
                "code" => "107",
                "message" => "ProcessIdentifier's code number is something wrong!"
            ]);
        }
    }
}
