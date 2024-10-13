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
            <h3>All Personal Expenses</h3>
        </center>
        <br>
        <b>From : </b><span>{{ $from }}</span><br>
        <b>To : </b><span>{{ $to }}</span>
       <br><br> 
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
    <center>
        <button class="btn btn-primary" id="btn_print" onclick="print_clk()">Print</button>
    </center>
</body>

</html>
