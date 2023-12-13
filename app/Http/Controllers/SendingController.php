<?php

namespace App\Http\Controllers;

use App\Models\Sending;
use App\Http\Requests\StoreSendingRequest;
use App\Http\Requests\UpdateSendingRequest;
use App\Models\Temp;
use Illuminate\Support\Facades\Request;

class SendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("sending.home");
    }



    public function signIndex()
    {
        return view("sending.sign");
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
     * @param  \App\Http\Requests\StoreSendingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSendingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sending  $sending
     * @return \Illuminate\Http\Response
     */
    public function show(Sending $sending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sending  $sending
     * @return \Illuminate\Http\Response
     */
    public function edit(Sending $sending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSendingRequest  $request
     * @param  \App\Models\Sending  $sending
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSendingRequest $request, Sending $sending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sending  $sending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sending $sending)
    {
        //
    }
}
