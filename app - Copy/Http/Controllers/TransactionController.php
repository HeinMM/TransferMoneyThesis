<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
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
        })->latest('id')->paginate(10)->withQueryString();

        return view('transaction.transaction', compact('orders'));
    }

    public function uncompleteIndex()
    {
        $orders = Transaction::where("state", false)->latest('id')->paginate(10)->withQueryString();

        return view('transaction.transaction', compact('orders'));
    }

    public function completeIndex()
    {
        $orders = Transaction::where("state", true)->latest('id')->paginate(10)->withQueryString();

        return view('transaction.transaction', compact('orders'));
    }



    public function todayIndex()
    {
        $orders = Transaction::whereDate('created_at', Carbon::today())->latest('id')->paginate(10)->withQueryString();

        return view('transaction.transaction', compact('orders'));
    }

    public function todayUncompleteIndex()
    {
        $orders = Transaction::whereDate('created_at', Carbon::today())->where("state", false)->latest('id')->paginate(10)->withQueryString();

        return view('transaction.transaction', compact('orders'));
    }

    public function todayCompleteIndex()
    {
        $orders = Transaction::whereDate('created_at', Carbon::today())->where("state", true)->latest('id')->paginate(10)->withQueryString();

        return view('transaction.transaction', compact('orders'));
    }

    public function searchByDate(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $orders = Transaction::whereBetween('created_at', [$from, $to])->latest('id')->get();
        return view('search.searchByDate', compact('orders'));
    }

    public function searchByDateShow()
    {
        return view('search.searchByDate');
    }

    public function searchTrNumber()
    {
        $orders = Transaction::where("control_no", request('keyword'))->get();
        return view('search.searchByTrNumber', compact('orders'));
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
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {

        $transaction->state = $request->state;
        $transaction = $transaction->update();
        return redirect()->back()->with('status', 'Complete State Changed');
    }

    /**
     * Remove the specified resource from storage.ba
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function export(Request $request)
    {
        // $from = $request->from;
        // $to = $request->to;
        // $orders = Transaction::whereBetween('created_at', [$from, $to])->latest('id')->get();
        return Excel::download(new TransactionsExport($request->from, $request->to), 'transactions.xlsx');

    }

    public function downloadbydate(){
        return view('download.downloadByDate');
    }
}
