<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Receipts</title>
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
                <div class="row">
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('search_received_name')}}" method="post">
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
                                                <a href="{{route('all_received')}}">
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
                                <form action="{{route('search_received_date')}}" method="post">
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
                                                <a href="{{route('all_received')}}">
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
                            <div class="col-sm-4 px-4">


                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <h3>All Receipts</h3>
                                </center>
                            </div>
                            <div class="col-sm-4" style="justify-content:end;">

                            </div>
                        </div>
                        <div class="container-fluid px-3 py-3 overflow-auto"
                            style="padding-right:10px; max-height:67vh; overflow-y:auto;">
                            <!--  -->
                            <table class="table table-stripped table-hover border-dark text-center">
                                <thead class="thead-dark" style="position:sticky; top:-17px;">
                                    <tr style=" padding-top:0;">
                                        <th>Sr no.</th>
                                        <th>Transaction Id</th>
                                        <th>Name</th>
                                        <th>Purpose</th>
                                        <th>Action</th>
                                        <th>Mode</th>
                                        <th>Amount</th>
                                        <!-- <th>View</th> -->
                                        <th>Date & Time</th>
         
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($all_received->reverse() as $transactions)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transactions->id }}</td>
                                            <td>{{ $transactions->name }}</td>
                                            <td>{{ $transactions->purpose }}</td>

                                            @if ($transactions->action == 'paid')
                                                <td style="color:red;"><b>{{ $transactions->action }}</b></td>
                                            @else
                                                <td style="color:green;"><b>{{ $transactions->action }}</b></td>
                                            @endif
                                            <td>{{ $transactions->mode }}</td>
                                            <td style="color:green;"><b>{{ $transactions->amount }}</b></td>
                                            <td>{{ $transactions->created_at }}</td>
            
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
