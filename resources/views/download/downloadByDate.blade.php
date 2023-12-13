@extends('master')

@section('content')
    <div class="col-12 ">
        <div class="card">
            <div class="card-body text-center">
                <form action="{{ route('download.export') }}" method="POST">
                    @csrf
                    <div class="">

                        <div class="form-group mb-3">
                            <select id="quantityPercentageInput" name="nationId" class="custom-select">
                                <option selected value="1">Korea</option>
                                <option value="2">Singapore</option>
                                <option value="3">Other</option>
                            </select>
                        </div>


                        <label for="from">FROM:</label>
                        <input type="date" name="from">

                        <label for="to">TO:</label>
                        <input type="date" name="to">



                    </div>
                    <div class="pt-3">
                        <button class="btn btn-primary">Download</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
