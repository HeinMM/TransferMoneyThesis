@extends('master')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Rate</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-around align-items-center">




                <div class="card ">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center ">
                        <h3 class="text-uppercase">Current Rate</h3>
                        <h4 class="font-weight-bold text-success">{{ $current_rate->rate }}</h4>
                    </div>
                </div>



                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <form action="{{ route('rate.store') }}" method="POST">
                            @csrf

                            <div>
                                <h4>Rate For Korea</h4>
                            </div>

                            <div class="input-group  mt-1">


                                <input type="text" class="form-control" placeholder="Manage today's rate"
                                    aria-label="Recipient's username" aria-describedby="button-addon2" name="rate">
                                <button class="btn btn-outline-primary">Update</button>

                            </div>

                            <input type="hidden" name="receivingCountry" value="MMR">
                            <input type="hidden" name="sendingCountry" value="KR">
                            <input type="hidden" name="receivingCurrency" value="MMK">

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <h3 class="text-uppercase text-center">Rate History</h3>
            <hr>
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th>Id</th>
                        <th>Date</th>
                        <th>Rate</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rates as $rate)
                        <tr class="text-center">
                            <td class="text-black-500    ">{{ $rate->id }}</td>
                            <td>{{ $rate->created_at }}</td>
                            <td class="font-weight-bold text-success">{{ $rate->rate }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">There is no data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>


        <div class="p-2">
            {{ $rates->onEachSide(1)->links() }}
        </div>
    </div>
@endsection
