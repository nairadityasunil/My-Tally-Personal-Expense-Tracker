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
            <h3>All Receivables</h3>
        </center>
        <b>From : </b><span>{{ $from }}</span><br>
        <b>To : </b><span>{{ $to }}</span>
        <table class="table table-stripped table-hover border-dark text-center">
            <thead class="thead-dark" style="position:sticky; top:-17px;">
                <tr>
                    <th>Sr no.</th>
                    <th>Recievable Id</th>
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

                @foreach ($all_recievables->reverse() as $recievables)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $recievables->id }}</td>
                        <td>{{ $recievables->name }}</td>
                        <td>{{ $recievables->purpose }}</td>
                        <td>{{ $recievables->mode }}</td>
                        <td style="color:green;"><b>{{ $recievables->amount }}</b></td>
                        <td>{{ $recievables->transaction_id }}</td>
                        <td>{{ $recievables->created_at }}</td>
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
