<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Accounts</title>
    <link rel="stylesheet" href="{{URL::asset('frontend/css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{URL::asset('frontend/javascript/bootstrap.min.js')}}"></script>
    <script type="text/javascript " src="{{URL::asset('frontend/javascript/bootstrap.bundle.min.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('frontend/css/style.css')}}">
</head>
<body>
    <!-- Component Top Navbar -->
    <x-top_navbar/>

    <div class="col-sm-12">
        <div class="row">
            <x-side_navbar/>
            <div class="col-sm-10 py-3">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('search_receivable')}}" method="post">
                        @csrf   
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <label for="">Name : </label>
                                        </center>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{$name ?? ''}}">
                                        <br>
                                        <button type="submit" class="btn btn-dark">Submit</button>
                                        <a href="">
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card my-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <a href="{{url('new_receivable')}}">
                                    <button type="button" class="btn _btn"><b>New Recievable</b></button>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <center>
                                    <h3>All Recievables</h3>
                                </center>
                            </div>
                            <div class="col-sm-12">
    
                            </div>
                        </div>
                        <div class="container-fluid px-3 py-3 overflow-auto" style="padding-right:10px; max-height:67vh; overflow-y:auto;">
                            <table class="table table-stripped table-hover border-dark text-center">
                                <thead class="thead-dark"  style="position:sticky; top:-17px;">
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
                                        <th>Confirm</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($all_recievables->reverse() as $recievables)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$recievables->id}}</td>
                                            <td>{{$recievables->name}}</td>
                                            <td>{{$recievables->purpose}}</td>
                                            <td>{{$recievables->mode}}</td>
                                            <td style="color:green;"><b>{{$recievables->amount}}</b></td>
                                            <td>{{$recievables->transaction_id}}</td>
                                            <td>{{$recievables->created_at}}</td>
                                            <td>
                                                <a href="{{url('confirm_receivable')}}/{{$recievables->id}}" class="btn btn-success" style="border : 0px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
</svg> <b>Recd</b>
                                                </a>
                                            </td>
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

