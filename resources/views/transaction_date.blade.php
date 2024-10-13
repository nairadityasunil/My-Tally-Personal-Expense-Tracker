<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Paid</title>
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ URL::asset('frontend/javascript/bootstrap.min.js') }}"></script>
    <script type="text/javascript " src="{{ URL::asset('frontend/javascript/bootstrap.bundle.min.js') }}"></script>
    {{-- <link rel="stylesheet" href="{{ URL::asset('frontend/css/style.css') }}"> --}}
    <script>
        function print_clk()
        {
            window.print();
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <center>
            <h3>All Transactions Report</h3>
        </center>
        <b>From : </b><span>{{ $from }}</span><br>
        <b>To : </b><span>{{ $to }}</span>
        <table class="table text-center table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Sr.no</th>
                    <th>Transaction Id</th>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Action</th>
                    <th>Mode</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->purpose }}</td>
                        <td>{{ $transaction->action }}</td>
                        <td>{{ $transaction->mode }}</td>
                        <td>{{ $transaction->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <center>
        <button class="btn btn-primary" id="btn_print" onclick="print_clk()">Print</button>
    </center>
</body>

</html>
