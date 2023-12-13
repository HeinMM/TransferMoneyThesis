@extends('master')

@section('content')
    <div class="col-12 mr-3 text-center">
        <div class="col-12 col-lg-6">
            <form action="" class="my-3" name="keyword">
                <div class="input-group col-12 col-lg-6">
                    <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}">
                    <button class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
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
                             <td class="p-3"><img src="{{ App\Models\NationImage::find($order->nation->id)->name }}" width="50" alt=""></td>
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
    </div>
@endsection
