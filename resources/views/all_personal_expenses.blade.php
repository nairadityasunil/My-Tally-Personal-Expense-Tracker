<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Expense</title>
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ URL::asset('frontend/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript " src="{{ URL::asset('frontend/javascript/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/style.css') }}">
</head>

<body>
    <!-- Component Top Navbar -->
    <x-top_navbar />

    <div class="col-sm-12">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-10 py-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('search_personal_name') }}" method="post">
                                    @csrf
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col">
                                                <center>
                                                    <label for="">Name : </label>
                                                </center>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="" value="{{$name ?? ''}}">
                                                <br>
                                                <button type="submit" class="btn btn-dark">Fetch Data</button>
                                                <a href="{{ route('all_personal_expense') }}">
                                                    <button type="button" class="btn btn-danger">Clear</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('search_personal_date') }}" method="post">
                                    @csrf
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <center>
                                                    <label for="">From :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" name="from_date" class="form-control"
                                                    id="from_date" placeholder="" value="">
                                            </div>
                                            <div class="col-sm-2">
                                                <center>
                                                    <label for="">To :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="date" name="to_date" class="form-control" id="to_date"
                                                    placeholder="" value="">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-dark">Fetch Data</button>
                                                <a href="{{ route('all_personal_expense') }}">
                                                    <button type="button" class="btn btn-danger">Clear</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{ url('search_personal_date') }}">
                                    <button type="button" class="btn _btn"><b>New Personal Expense</b></button>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <h3>All Personal Expenses</h3>
                                </center>
                            </div>
                            <div class="col-sm-12">

                            </div>
                        </div>
                        <div class="container-fluid px-3 py-3 overflow-auto"
                            style="padding-right:10px; max-height:67vh; overflow-y:auto;">
                            <table class="table table-stripped table-hover border-dark text-center">
                                <thead class="thead-dark" style="position:sticky; top:-17px;">
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Expense Id</th>
                                        <th>Name</th>
                                        <th>Purpose</th>
                                        <th>Mode</th>
                                        <th>Amount</th>
                                        <th>Transaction Id</th>
                                        <!-- <th>View</th> -->
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($all_expenses->reverse() as $expenses)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $expenses->id }}</td>
                                            <td>{{ $expenses->name }}</td>
                                            <td>{{ $expenses->purpose }}</td>
                                            <td>{{ $expenses->mode }}</td>
                                            <td style="color:red;"><b>{{ $expenses->amount }}</b></td>
                                            <td>{{ $expenses->transaction_id }}</td>
                                            <td>{{ $expenses->created_at }}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
