<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use App\Http\Requests\StoreTempRequest;
use App\Http\Requests\UpdateTempRequest;
use App\Models\Transaction;
use Carbon\Carbon;

class TempController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Temp::when(request('keyword'), function ($q) {
            $keyword = request('keyword');
            $q->orWhere("state", $keyword);
        })->get();

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
     * @param  \App\Http\Requests\StoreTempRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTempRequest $request)
    {
        $tempTable = new Temp();
        $mytime = Carbon::now();
        $mytime->toDateTimeString();

        $length = 3;

        $tempTable->tr_number = $mytime->toDateString() . rand(1000, 9999) . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, $length);

        $tempTable->sender_name = $request->senderName;
        $tempTable->sender_phone = $request->senderPhone;
        $tempTable->recipent_name = $request->recipientName;
        $tempTable->recipent_phone = $request->recipientPhone;
        $tempTable->payment_name = $request->bankName;
        $tempTable->payment_number = $request->bankNumber;
        $tempTable->amount = $request->amount;
        $tempTable->description = $request->description;

        $tempTable->save();
        return view('sending.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function show(Temp $temp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function edit(Temp $temp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTempRequest  $request
     * @param  \App\Models\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTempRequest $request, Temp $temp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temp  $temp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temp $temp)
    {
        //
    }
}
