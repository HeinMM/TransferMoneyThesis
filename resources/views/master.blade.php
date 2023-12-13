<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/js/app.js')
</head>

<body  class="bg-light">

    <div class="">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    121 Exchange Dashboard
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <main class="py-3">
        @auth
            <div class="ml-2">
                <div class="row g-2 d-flex justify-content-center ">
                    <div class="col-lg-2">
                        <div class="list-group mb-3">
                            <a class="list-group-item list-group-item-action" href="/">Home</a>
                        </div>

                        <p class="small text-black-50 mb-1">Rate</p>
                        <div class="list-group mb-3">


                            <a class="list-group-item list-group-item-action" href="{{ route('rate.index') }}">Today
                                Rate</a>


                        </div>

                        <p class="small text-black-50 mb-1">Manage Today Transaction</p>
                        <div class="list-group mb-3">
                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transaction.todayIndex') }}">Today Transaction</a>
                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transaction.todayUncompleteIndex') }}">Today UnComplete
                                Transaction</a>
                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transaction.todayCompleteIndex') }}">Today Complete Transaction</a>
                        </div>






                        <p class="small text-black-50 mb-1">History</p>
                        <div class="list-group mb-3">


                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transactions.index') }}">Transaction</a>

                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transaction.uncompleteIndex') }}">UnComplete Transaction</a>


                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transaction.completeIndex') }}">Complete Transaction</a>


                        </div>


                        <p class="small text-black-50 mb-1">Search</p>
                        <div class="list-group mb-3">


                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transaction.searchByDateShow') }}">Search by Date</a>

                            <a class="list-group-item list-group-item-action"
                                href="{{ route('transaction.searchTrNumber') }}">Search by TR Number</a>


                        </div>

                         <p class="small text-black-50 mb-1">Downlad</p>
                        <div class="list-group mb-3">

                            <a class="list-group-item list-group-item-action"
                                href="{{ route('download.downloadbydate') }}">Download by Date</a>

                        </div>

                    </div>
                    <div class="col-lg-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        @endauth



    </main>





</body>

</html>
