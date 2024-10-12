<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ URL::asset('frontend/javascript/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/style.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #dcdcdc !important;
        }

        .login-card {
            display: flex;
            flex-direction: row;
            align-items: center;
            max-width: 800px;
            width: 100%;
            height: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 4px 0px 2px -2px rgba(0, 0, 0, 0.2) !important;
        }

        .login-card img {
            width: 50%;
            height: 100%;
            object-fit: cover;
        }

        .login-card .card-body {
            flex: 1;
            padding: 2rem;
            background: white !important;
        }

        .card-body h4 {
            margin-bottom: 2rem;
            color: #04444D; /* Heading color */
        }

        input {
            background: #e6e6e6 !important;
            box-shadow: 4px 0px 2px -2px rgba(0, 0, 0, 0.2) !important;
            font-weight: bold !important;
            text-align: center; /* Center text inside input */
        }

        #submit_btn {
            background: #04444D !important;
            color: white !important;
            border: 2px solid #04444D;
            width: 100%; /* Full width */
        }

        .btn {
            border-radius: 25px; /* Rounded button */
        }

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="card login-card shadow-sm">
        <img class="ayyappa_img" src="{{ URL::asset('Images/login_page_image.jpg') }}" alt="Login Image">
        <div class="card-body overflow-auto">
            <h4 class="text-center">Login</h4>

            <!-- Display the error message if it exists in the session -->
            @if(session('status'))
                <div class="error-message">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('authenticate') }}" method="POST">
                @csrf <!-- CSRF Token for security -->
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" id="submit_btn" class="btn btn-dark">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
