<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function update(Request $request, $id)
    {
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

    function resetPassword(Request $request)
    {
        $request->validate([
            "agentCode" => "required",
            "processIdentifier" => "required",

            'old_password' => 'required|min:8|max:100',
            'new_password' => 'required|min:8|max:100',
            'confirm_password' => 'required|same:new_password',
            'signature' => 'required'
        ]);

        // $testSig = $request->agentCode . $request->processIdentifier . $request-> old_password . $request->new_password . $request->confirm_password;
        // return Crypt::encryptString($testSig);


        if ($request->processIdentifier == "D4BBBC5-B738-4275-85C8-26F03A93DB24" && $request->agentCode == "121Hanpass") {

            $current_user = auth()->user();
            if (Hash::check($request->old_password, $current_user->password)) {
                $current_user->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return response()->json([
                    "code" => "0000",
                    "message" => "Password successfully updated"
                ]);
            } else {
                return response()->json([
                    "code" => "103",
                    "message" => "Old password does not matched!"
                ]);
            }
        } else {
            return response()->json([
                "code" => "110",
                "message" => "Check your processIdentifier and agentCode!"
            ]);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new UsersExport($request->from, $request->to, $request->nationId), 'transactions.xlsx');
        // return Excel::download(new UsersExport , 'users.xlsx');
    }
}
