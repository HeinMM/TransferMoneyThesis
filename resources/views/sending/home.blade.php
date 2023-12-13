<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer To Korea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body onload="init()">
    <div class="container vh-90 mt-3">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-7 ">
                <div class="card m-3 p-3  vh-90">
                    <div class="card-body ">
                        <div class="text-center">
                            <h3>Transfer To Korea</h3>
                        </div>
                        <form action="{{ route('temp.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="" id="firstPage">
                                <div class="p-1 form-group-lg">
                                    <label for="senderName" class="form-label ">Sender Name</label>
                                    <input type="text"
                                        class="form-control input-lg @error('senderName') is-invalid @enderror "
                                        name="senderName">
                                    @error('senderName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="p-1 form-group-lg">
                                    <label for="senderPhone" class="form-label">Sender Phone</label>
                                    <input type="text"
                                        class="form-control input-lg @error('senderPhone') is-invalid @enderror"
                                        name="senderPhone">
                                    @error('senderPhone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="p-1 form-group-lg">
                                    <label for="recipientName" class="form-label">Recipient Name</label>
                                    <input type="text"
                                        class="form-control input-lg @error('recipientName') is-invalid @enderror"
                                        name="recipientName">
                                    @error('recipientName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="p-1 form-group-lg">
                                    <label for="recipientPhone" class="form-label">Recipient Phone</label>
                                    <input type="text"
                                        class="form-control input-lg @error('recipientPhone') is-invalid @enderror"
                                        name="recipientPhone">
                                    @error('recipientPhone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="p-1 form-group-lg">
                                    <label for="bankName" class="form-label">Bank Name</label>
                                    <input type="text"
                                        class="form-control input-lg @error('bankName') is-invalid @enderror"
                                        name="bankName">
                                    @error('bankName')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class=" p-1 form-group-lg">
                                    <label for="bankNumber" class="form-label">Bank Number</label>
                                    <input type="text"
                                        class="form-control input-lg @error('bankNumber') is-invalid @enderror"
                                        name="bankNumber">
                                    @error('bankNumber')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="p-1 form-group-lg">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text"
                                        class="form-control input-lg @error('description') is-invalid @enderror"
                                        name="description">
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="p-1 form-group-lg">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="text"
                                        class="form-control input-lg @error('amount') is-invalid @enderror"
                                        name="amount">
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="mt-3 p-2">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cumque sequi error ipsa id
                                    nemo
                                    deserunt neque quisquam possimus explicabo, fugit debitis, quod similique. Saepe
                                    laboriosam aut culpa provident autem qui.</p>
                            </div> --}}

                            <div class="text-center mb-0 mt-3">
                                <button class="btn btn-primary m-3">Transfer Complete</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
