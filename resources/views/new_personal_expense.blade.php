<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Expense</title>
    <link rel="stylesheet" href="frontend/css/bootstrap.min.css">
    <script type="text/javascript" src="frontend/javascript/bootstrap.min.js"></script>
    <script type="text/javascript " src="frontend/javascript/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/frontend/css/style.css">
</head>

<body>
    <!-- Component Top Navbar -->
    <x-top_navbar />

    <div class="col-sm-12">
        <div class="row">
            <x-side_navbar />
            <div class="col-sm-10 px-0">
                <div class="container-fluid px-3">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card" style="margin-top : 10px; max-height:93vh;">
                                <div class="card-body overflow-auto">
                                    <h1 class="text-center">New Personal Expense</h1>
                                    <br>
                                    <form action="{{ route('save_personal_expense') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">

                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="name" class="col-form-label">Name :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="purpose" class="col-form-label">Purpose :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="purpose" class="form-control" id="purpose"
                                                    placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="mode" class="col-form-label">Mode :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="mode">
                                                    <option value="" selected>-</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="bank transfer">Bank Transfer</option>
                                                    <option value="net banking">Net Banking</option>
                                                    <option value="upi">UPI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="total_amount" class="col-form-label">Amount :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="total_amount" class="form-control"
                                                    id="name" placeholder="" value="">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <center>
                                                <button type="submit" class="btn" id="submit_btn">Submit</button>
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                            </center>
                                        </div>
                                    </form>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="container-fluid">
                                <div class="card" style="margin-top : 10px;">
                                    <div class="card-body">
                                        <div class="container">
                                            <h3 class="text-center">Today's Expenses</h3>
                                            <hr>
                                            <div style="height: 5vh">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center text-danger">
                                                        <h5><b>Total : Rs. {{ $todays_total }}</b></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped  border-dark text-center">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Sr No.</th>
                                                        <th>Name</th>
                                                        <th>Purpose</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($todays_expenses as $transaction)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $transaction->name }}</td>
                                                            <td>{{ $transaction->purpose }}</td>
                                                            @if ($transaction->action == 'received')
                                                                <td style="color:green;">
                                                                    <b>{{ $transaction->amount }}</b></td>
                                                            @else
                                                                <td style="color:red;"><b>{{ $transaction->amount }}</b>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- component Side Navbar -->

    <!-- Main Form -->
</body>
