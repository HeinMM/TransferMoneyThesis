@extends('master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card mt-3">


                    <div class="card-body">

                        <h3 class="text-success text-center text-uppercase mt-3 fw-bold">Login successful , <span
                                class="text-danger">{{ Auth::user()->name }}</span></h3>

                        <div class="d-flex justify-content-around mt-5 mb-5">
                            <div class="col-12 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <h4 class="text-center text-black">Current Rate</h4>
                                            <h5 class="text-center text-success fw-bold">{{ $current_rate->rate }}</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <h4 class="text-center text-black">Today Transaction</h4>
                                            <h5 class="text-center text-success fw-bold">{{ $todayCount }}</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="">
                                            <h4 class="text-center text-black">Transaction Count</h4>
                                            <h5 class="text-center text-success fw-bold">{{ $allCount }}</h5>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
