<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheckTransactionResource;
use App\Http\Resources\CommitResource;
use App\Models\Rate;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class TransactionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Transaction::when(request('keyword'), function ($q) {
            $keyword = request('keyword');
            $q->orWhere("state", $keyword);
        })->where("nation_id", 1)->latest('id')->paginate(10)->withQueryString();

        return response()->json($orders);
    }

    public function completeTransaction()
    {
        $orders = Transaction::when(request('keyword'), function ($q) {
            $keyword = request('keyword');
            $q->orWhere("state", $keyword);
        })->where("nation_id", 1)->where("state", 1)->latest('id')->paginate(10)->withQueryString();

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            "agentCode" => "required",
            "processIdentifier" => "required",

            "nation_id" => "required",

            "senderName" => "required",
            "senderPhone" => "required",
            "senderIdType" => "required",
            "senderId" => "required",

            "relation" => "required",
            "purpose" => "required",
            "sourceOfFund" => "required",

            "recipentName" => "required",
            "recipentPhone" => "required",
            "recipentIdType" => "required",
            "recipentId" => "required",

            "paymentName" => "required",
            "paymentNumber" => "required",

            // "sendingAmount" => "required",
            // "sendingCurrency" => "required",
            "sendingCountry" => "required",

            "receivingAmount" => "required",
            "receivingCurrency" => "required",
            "receivingCountry" => "required",

            "forexSession" => "required",
            "exRate" => "required",

            "signature" => "required",
        ]);

        // $testSig =
        //     $request->agentCode . $request->processIdentifier . $request->nation_id . $request->senderName . $request->senderPhone . $request->senderIdType . $request->senderId . $request->relation . $request->purpose . $request->sourceOfFund . $request->recipentName . $request->recipentPhone  .
        //     $request->recipentIdType . $request->recipentId . $request->paymentName . $request->paymentNumber . $request->sendingCountry . $request->receivingAmount . $request->receivingCurrency . $request->receivingCountry . $request->forexSession . $request->exRate;
        // return md5($testSig);

        if ($validator->fails()) {
            return response()->json([
                "code" => "108",
                "message" => "Some data are missing!"
            ]);
        } else {



            if (Rate::where('forexSession', '=', $request->forexSession)->exists()) {
                $transaction = new Transaction();

                $length = 3;
                $mytime = Carbon::now();
                $mytime->toDateTimeString();

                $transaction->agentCode = $request->agentCode;
                $transaction->control_no = $mytime->toDateString() . rand(10000, 99999) . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);
                $transaction->processIdentifier = $request->processIdentifier;

                $transaction->nation_id = $request->nation_id;


                $transaction->senderName = $request->senderName;
                $transaction->senderPhone = $request->senderPhone;
                $transaction->senderIdType = $request->senderIdType;
                $transaction->senderId = $request->senderId;

                $transaction->relation = $request->relation;
                $transaction->purpose = $request->purpose;
                $transaction->sourceOfFund = $request->sourceOfFund;

                $transaction->recipentName = $request->recipentName;
                $transaction->recipentPhone = $request->recipentPhone;
                $transaction->recipentIdType = $request->recipentIdType;
                $transaction->recipentId = $request->recipentId;


                $transaction->paymentName = $request->paymentName;
                $transaction->paymentNumber = $request->paymentNumber;

                $mmRate = Rate::all()->last()->rate;

                // $amount = $request->receivingAmount / $mmRate;
                // $sendingAmount = $amount * 1350;
                // $transaction->sendingAmount = $sendingAmount;

                $usdAmount = $request->receivingAmount / $mmRate;


                // $transaction->sendingAmount = $request->sendingAmount;
                // $transaction->sendingCurrency = "KRW";
                $transaction->sendingCountry = $request->sendingCountry;

                $transaction->receivingAmount = $request->receivingAmount;
                $transaction->receivingCurrency = $request->receivingCurrency;
                $transaction->receivingCountry = $request->receivingCountry;

                $transaction->forexSession = $request->forexSession;
                $transaction->exRate = $request->exRate;



                $transaction->state = false;

                $transaction->isApproved = false;

                $transaction->isCancel = false;

                $transaction->save();

                //    $partnerTranNo =  Transaction::where("processIdentifier", "D4BBBC5-B738-4275-85C8-26F03A93DB24")->where("control_no",$transaction->control_no)->first();



                return response()->json([
                    "code" => "0000",
                    'message' => 'Transaction Sending success',
                    'processIdentifier' => Auth::user()->processIdentifier,
                    'detail' => [
                        "usdAmount" => $usdAmount,
                        "contolNo" => $transaction->control_no
                    ]
                ]);
            } else {
                return response()->json([
                    "code" => "115",
                    'message' => "Check your Forex's Session!"
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            "agentCode" => "required",
            "controlNo" => "required",

            // "senderName" => "required",
            // "senderIdType" => "required",
            // "senderId" => "required",

            // "recipentName" => "required",
            // "recipentPhone" => "required",

            // "paymentName" => "required",
            // "paymentNumber" => "required",

            "processIdentifier" => "required",
            "signature" => "required",
        ]);


        // $testSig = $request->agentCode . $request->controlNo . $request->senderName . $request->senderIdType . $request->senderId . $request->recipentName . $request->recipentPhone . $request->paymentName . $request->paymentNumber . $request->processIdentifier;
        // return Crypt::encryptString($testSig);

        if ($validator->fails()) {
            return response()->json([
                "code" => "108",
                "message" => "Some data are missing!"
            ]);
        } else {
            if ($request->processIdentifier == "D4BBBC5-B738-4275-85C8-26F03A93DB24" && $request->agentCode == "121Hanpass") {




                $transaction = Transaction::where('control_no', $request->controlNo)->where('processIdentifier', $request->processIdentifier)->first();

                if (is_null($transaction)) {
                    return response()->json([
                        "code" => "111",
                        'message' => 'Transaction is not found!'
                    ]);
                }

                if ($transaction->isCancel == 1) {
                    return response()->json([
                        "code" => "114",
                        'message' => 'This Transaction is already cancel!'
                    ]);
                }



                if ($transaction->state === 0) {

                    if ($request->has('senderName')) {
                        $transaction->senderName = $request->senderName;
                    }
                    if ($request->has('senderIdType')) {
                        $transaction->senderIdType = $request->senderIdType;
                    }
                    if ($request->has('senderId')) {
                        $transaction->senderId = $request->senderId;
                    }
                    if ($request->has('recipentName')) {
                        $transaction->recipentName = $request->recipentName;
                    }
                    if ($request->has('recipentPhone')) {
                        $transaction->recipentPhone = $request->recipentPhone;
                    }
                    if ($request->has('paymentName')) {
                        $transaction->paymentName = $request->paymentName;
                    }
                    if ($request->has('paymentNumber')) {
                        $transaction->paymentNumber = $request->paymentNumber;
                    }


                    $transaction->update();


                    return response()->json([
                        "code" => "0000",
                        'message' => 'Transaction modify success',
                        'Detail' => new CommitResource($transaction)
                    ]);
                } else {
                    return response()->json([
                        "code" => "113",
                        'message' => 'This transaction is already transfer you can not modify!'
                    ]);
                }
            } else {
                return response()->json([
                    "code" => "110",
                    "error" => "ProcessIdentifier is invalid!"
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cancel(Request $request)
    {

        $validator =  Validator::make($request->all(), [

            "agentCode" => "required",
            "controlNo" => "required",
            "processIdentifier" => "required",
            "reason" => "required",
            "signature" => "required",
        ]);


        if ($validator->fails()) {
            return response()->json([
                "code" => "108",
                "message" => "Some data are missing!"
            ]);
        } else {
            if ($request->processIdentifier == "D4BBBC5-B738-4275-85C8-26F03A93DB24" && $request->agentCode == "121Hanpass") {


                // $testSig = $request->agentCode. $request-> controlNo . $request->reason . $request->processIdentifier;
                //  return Crypt::encryptString($testSig);

                $transaction = Transaction::where('control_no', $request->controlNo)->where('processIdentifier', $request->processIdentifier)->first();

                if (is_null($transaction)) {
                    return response()->json([
                        "code" => "111",
                        'message' => 'Transaction is not found!'
                    ]);
                }


                if ($transaction->isCancel == 1) {
                    return response()->json([
                        "code" => "114",
                        'message' => 'This Transaction is already cancel!'
                    ]);
                }



                if ($transaction->state === 0) {
                    $transaction->cancelReason = $request->cancelReason;
                    $transaction->isCancel = 1;
                    $transaction->update();
                    return response()->json([
                        "code" => "0000",
                        'message' => 'Transaction Cancel success',
                        'Detail' => new CommitResource($transaction)
                    ]);
                } else {
                    return response()->json([
                        "code" => "112",
                        'message' => 'This transaction is already transfer'
                    ]);
                }
            } else {
                return response()->json([
                    "code" => "110",
                    "error" => "ProcessIdentifier is invalid!"
                ]);
            }
        }
    }

    public function commit(Request $request)
    {


        $validator =  Validator::make($request->all(), [

            "agentCode" => "required",
            "controlNo" => "required",
            "processIdentifier" => "required",
            "isApproved" => "required",
            "signature" => "required",
        ]);


        if ($validator->fails()) {
            return response()->json([
                "code" => "108",
                "message" => "Some data are missing!"
            ]);
        } else {
            if ($request->processIdentifier == "D4BBBC5-B738-4275-85C8-26F03A93DB24" && $request->agentCode == "121Hanpass") {


                // $testSig = $request->agentCode. $request-> controlNo . $request->isApproved . $request->processIdentifier;
                //  return Crypt::encryptString($testSig);

                $transaction = Transaction::where('control_no', $request->controlNo)->where('processIdentifier', $request->processIdentifier)->first();

                if (is_null($transaction)) {
                    return response()->json([
                        "code" => "111",
                        'message' => 'Transaction is not found!'
                    ]);
                }


                if ($transaction->isCancel == 1) {
                    return response()->json([
                        "code" => "114",
                        'message' => 'This Transaction is already cancel!'
                    ]);
                }



                if ($transaction->state === 0) {
                    if ($request->isApproved == "true") {
                        $transaction->isApproved = 1;
                    } else {
                        $transaction->isApproved = 0;
                    }
                    $transaction->update();
                    return response()->json([
                        "code" => "0000",
                        'message' => 'Transaction Commit success',
                        'Detail' => new CommitResource($transaction)
                    ]);
                } else {
                    return response()->json([
                        "code" => "112",
                        'message' => 'This transaction is already transfer'
                    ]);
                }
            } else {
                return response()->json([
                    "code" => "110",
                    "error" => "ProcessIdentifier is invalid!"
                ]);
            }
        }
    }

    public function check(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            "agentCode" => "required",
            "controlNo" => "required",
            "processIdentifier" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "code" => "108",
                "message" => "Some data are missing!"
            ]);
        } else {
            if ($request->processIdentifier == "D4BBBC5-B738-4275-85C8-26F03A93DB24" && $request->agentCode == "121Hanpass") {


                // $testSig = $request->agentCode. $request-> controlNo . $request->processIdentifier;
                //  return Crypt::encryptString($testSig);

                $transaction = Transaction::where('control_no', $request->controlNo)->where('processIdentifier', $request->processIdentifier)->first();

                if (is_null($transaction)) {
                    return response()->json([
                        "code" => "111",
                        'message' => 'Transaction is not found!'
                    ]);
                }


                return response()->json([
                    "code" => "0000",
                    'message' => 'Check status success',
                    "Detail" => new CheckTransactionResource($transaction)
                ]);
            } else {
                return response()->json([
                    "code" => "110",
                    "error" => "ProcessIdentifier is invalid!"
                ]);
            }
        }
    }
}
