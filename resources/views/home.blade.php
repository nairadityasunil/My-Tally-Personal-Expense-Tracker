<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My-Tally Dashboard</title>
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
            <div class="col-sm-10" style="overflow-y: scroll; height:90vh;">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="card card-height text-success" style="margin-top : 10px;background-color:white;">
                            <div class="card-body">
                                <div class="container">
                                    <h6 class="text-center">Recd. Today</h6>
                                </div>
                                <div class="container">
                                    <h3 class="text-center">Rs. {{ $r_today }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card card-height text-danger" style="margin-top : 10px; background-color:white;">
                            <div class="card-body">
                                <div class="container">
                                    <h6 class="text-center">Paid Today</h6>
                                </div>
                                <div class="container">
                                    <h3 class="text-center">Rs. {{ $p_today }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card card-height text-danger" style="margin-top : 10px;background-color:white;">
                            <div class="card-body">
                                <div class="container">
                                    <h6 class="text-center">Expense Today</h6>
                                </div>
                                <div class="container">
                                    <h3 class="text-center">Rs. {{ $per_today }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card card-height text-success" style="margin-top : 10px;background-color:white;">
                            <div class="card-body">
                                <div class="container">
                                    <h6 class="text-center">Receivables</h6>
                                </div>
                                <div class="container">
                                    <h3 class="text-center">Rs. {{ $t_rec }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="card card-height text-danger" style="margin-top : 10px;background-color:white;">
                            <div class="card-body">
                                <div class="container">
                                    <h6 class="text-center">Payables</h6>
                                </div>
                                <div class="container">
                                    <h3 class="text-center">Rs. {{ $t_pay }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card card-height text-danger" style="margin-top : 10px;background-color:white;">
                            <div class="card-body">
                                <div class="container">
                                    <h6 class="text-center">Exp. This Month</h6>
                                </div>
                                <div class="container">
                                    <h3 class="text-center">Rs. {{ $total_this_month }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Personal Expense (Today)</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-bordered  border-dark text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sr no.</th>
                                                    <th>Name</th>
                                                    <th>Purpose</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($personal_today->reverse() as $pt)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pt->name }}</td>
                                                        <td>{{ $pt->purpose }}</td>
                                                        <td style="color:red;"><b>{{ $pt->amount }}</b></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-danger font-weight-bold">
                                                Total :
                                            </div>
                                            <div class="col-sm-6 text-center text-danger  font-weight-bold">
                                                Rs. {{ $per_today }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Expense This Month</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-bordered  border-dark text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sr no.</th>
                                                    <th>Name</th>
                                                    <th>Purpose</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($this_month->reverse() as $tm)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $tm->name }}</td>
                                                        <td>{{ $tm->purpose }}</td>
                                                        <td style="color:red;"><b>{{ $tm->amount }}</b></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-danger font-weight-bold">
                                                Total :
                                            </div>
                                            <div class="col-sm-6 text-center text-danger  font-weight-bold">
                                                Rs. {{ $total_this_month }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Received Today</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-bordered  border-dark text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sr no.</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($recd_today->reverse() as $rt)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $rt->name }}</td>
                                                        <td style="color:green;"><b>{{ $rt->amount }}</b></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-success font-weight-bold">
                                                Total :
                                            </div>
                                            <div class="col-sm-6 text-center text-success  font-weight-bold">
                                                Rs. {{ $r_today }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Receivables</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-bordered  border-dark text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Transac. Id</th>
                                                    <th>Amount</th>
                                                    <th>Confirm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($total_receivables->reverse() as $tr)
                                                    <tr>
                                                        <td>{{ $tr->name }}</td>
                                                        <td>{{ $tr->transaction_id }}</td>
                                                        <td style="color:green;"><b>{{ $tr->amount }}</b></td>
                                                        <td>
                                                            <a href="{{ url('confirm_receivable') }}/{{ $tr->id }}"
                                                                class="btn btn-success" style="border : 0px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-check-square-fill"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                                                </svg> <b>Recd</b>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-success font-weight-bold">
                                                Total :
                                            </div>
                                            <div class="col-sm-6 text-center text-success  font-weight-bold">
                                                Rs. {{ $t_rec }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Payables</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-bordered  border-dark text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Transac. Id</th>
                                                    <th>Amount</th>
                                                    <th>Confirm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($total_payable->reverse() as $tp)
                                                    <tr>
                                                        <td>{{ $tp->name }}</td>
                                                        <td>{{ $tp->transaction_id }}</td>
                                                        <td style="color:red;"><b>{{ $tp->amount }}</b></td>
                                                        <td>
                                                            <a href="{{ url('confirm_payable') }}/{{ $tp->id }}"
                                                                class="btn btn-danger" style="border : 0px;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-check-square-fill"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z" />
                                                                </svg> <b>Paid</b>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-danger font-weight-bold">
                                                Total :
                                            </div>
                                            <div class="col-sm-6 text-center text-danger  font-weight-bold">
                                                Rs. {{ $t_pay }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card" style="margin-top : 10px; height:40vh;">
                            <div class="card-body">
                                <div class="container">
                                    <div>
                                        <h3 class="text-center">Paid Today</h3>
                                    </div>
                                    <br>
                                    <div class="overflow-auto" style="height: 21vh">
                                        <table class="table table-bordered  border-dark text-center">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sr no.</th>
                                                    <th>Name</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($paid_today->reverse() as $pt)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pt->name }}</td>
                                                        <td style="color:red;"><b>{{ $pt->amount }}</b></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="height: 5vh">
                                        <div class="row">
                                            <div class="col-sm-6 text-center text-danger font-weight-bold">
                                                Total :
                                            </div>
                                            <div class="col-sm-6 text-center text-danger  font-weight-bold">
                                                Rs. {{ $p_today }}
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
    </div>
</body>

</html>
