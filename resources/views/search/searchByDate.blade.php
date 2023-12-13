@extends('master')

@section('content')
    <div class="col-12 ">
        <div class="card">
            <div class="card-body text-center">
                <form action="{{ route('transaction.searchByDate') }}" method="POST">
                    @csrf
                    <div class="">
                        <label for="to">FROM:</label>
                        <input type="date" name="from">

                        <label for="to">TO:</label>
                        <input type="date" name="to">

                    </div>
                    <div class="pt-3">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </form>

                {{-- @isset($orders)
                    <form action="{{ route('transaction.searchByDate') }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <button class="btn btn-primary">Export to Excel</button>
                        </div>
                    </form>
                @endisset --}}
            </div>
        </div>

        <div class="col-12 mt-3">
            @isset($orders)
                <div class="card">
                    <div class="card-body text-center">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>From</th>
                                    <th>Tr_number</th>
                                    <th>R Name</th>
                                    <th>Payment Name</th>
                                    <th>Amount</th>
                                    <th>State</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td class="p-3"><img
                                                src="{{ App\Models\NationImage::find($order->nation->id)->name }}"
                                                width="50" alt=""></td>
                                        <td class="p-3">{{ $order->control_no }}</td>
                                        <td class="p-3">{{ $order->recipentName }}</td>
                                        <td class="p-3">{{ $order->paymentName }}</td>
                                        <td class="p-3">{{ $order->receivingAmount }}</td>
                                        <td class="p-3">
                                            @if ($order->state == 1)
                                                <p class="mb-0 text-success">Complete</p>
                                            @else
                                                <p class="mb-0 text-warning">Not Complete</p>
                                            @endif

                                        </td>
                                        <td>
                                            <a href="{{ route('transactions.show', $order->id) }}" class="btn btn-primary"><i
                                                    class="bi bi-eye"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">There is no post</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>







                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
