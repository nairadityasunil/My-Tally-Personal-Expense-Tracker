<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My-Tally</title>
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
            <div class="col-sm-10 px-0">
                <div class="container-fluid px-3">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card" style="margin-top : 10px; max-height:93vh;">
                                <div class="card-body overflow-auto">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <h1 class="text-center">Update User</h1>
                                    <br>
                                    <form action="{{ route('save_user_update') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="name" class="col-form-label">Old Username :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="old_username" class="form-control"
                                                    id="name" placeholder="" value="{{ $details->username }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="old_password" class="col-form-label">Old Password
                                                        :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="old_password" class="form-control"
                                                    id="name" placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="name" class="col-form-label">New Username :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="new_username" class="form-control"
                                                    id="name" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="old_password" class="col-form-label">New Password
                                                        :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="new_password" class="form-control"
                                                    id="name" placeholder="" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <center>
                                                    <label for="old_password" class="col-form-label">Email :</label>
                                                </center>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" name="email" class="form-control" id="name"
                                                    placeholder="" value="{{ $details->email }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-sm-12">
                                            <center>
                                                <button type="submit" class="btn" id="submit_btn">Update</button>
                                                <button type="reset" class="btn btn-danger">Clear Form</button>
                                            </center>
                                        </div>
                                    </form>
                                    <br>
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

</html>
