@extends('master')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">All Transaction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transaction Detail</li>
        </ol>
    </nav>

    <div class="card text-center">
        <div class="card-body ">
            <div class="">
                @if ($transaction->state == 1)
                         <h3 class="text-success">COMPLETE <i class="bi bi-check2"></i></h3>
                @else
                        <h3 class="text-warning">NOT COMPLETE <i class="bi bi-clock-history"></i></h3>
                @endif

            </div>
            <hr>
            <div class="col-12 col-lg-8 d-inline">
                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Transaction Number</h5>
                        <p class="mb-0">{{ $transaction->control_no }}</p>
                    </div>
                </div>
                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Date</h5>
                        <p class="mb-0">{{ $transaction->created_at }}</p>
                    </div>
                </div>

                <hr>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Sender Name</h5>
                        <p class="mb-0">{{ $transaction->senderName }}</p>
                    </div>
                </div>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Sender Phone</h5>
                        <p class="mb-0">{{ $transaction->senderPhone }}</p>
                    </div>
                </div>

                <hr>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Recipent Name</h5>
                        <p class="mb-0">{{ $transaction->recipentName }}</p>
                    </div>
                </div>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Recipent Phone</h5>
                        <p class="mb-0">{{ $transaction->recipentPhone }}</p>
                    </div>
                </div>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Recipent Id Type</h5>
                        <p class="mb-0">{{ $transaction->recipentIdType }}</p>
                    </div>
                </div>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Recipent ID</h5>
                        <p class="mb-0">{{ $transaction->recipentId }}</p>
                    </div>
                </div>

                <hr>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Payment Name</h5>
                        <p class="mb-0">{{ $transaction->paymentName }}</p>
                    </div>
                </div>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Payment Number</h5>
                        <p class="mb-0">{{ $transaction->paymentNumber }}</p>
                    </div>
                </div>

                <div class="p-2">
                    <div class="d-flex justify-content-around">
                        <h5>Amount</h5>
                        <p class="mb-0 text-danger fw-bold">{{ $transaction->receivingAmount }} {{ $transaction->receivingCurrency }}</p>
                    </div>
                </div>

                <hr>


                @if ($transaction->state==0)
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    COMPLETE
                </button>
                @endif

                {{-- model start --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure want to change Complete
                                    Transaction?Please Check Again!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex justify-content-between">
                                    <h6>Recipent Name</h6>
                                    <p>{{ $transaction->recipentName }}</p>
                                </div>
                                 <div class="d-flex justify-content-between">
                                    <h6>Payment Name</h6>
                                    <p>{{ $transaction->paymentName }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>Payment Number</h6>
                                    <p>{{ $transaction->paymentNumber }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6>Amount</h6>
                                    <p>{{ $transaction->receivingAmount }} {{ $transaction->receivingCurrency }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    {{-- @if ($transaction->state==false) --}}
                                        <input type="hidden" value="{{ !$transaction->state }}" name="state">
                                    {{-- @endif --}}

                                    <button class="btn btn-success">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- model end --}}




            </div>

        </div>
    </div>
@endsection
