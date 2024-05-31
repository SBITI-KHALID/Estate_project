<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('css/Login.css') }}" rel='stylesheet'>
    <title>Login Page</title>
</head>

<body>

    <!----------------------- Main Container -------------------------->
    <main class="container d-flex justify-content-center align-items-center">

        <!----------------------- Login Container -------------------------->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">

           <!--------------------------- Left Box ----------------------------->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"></div>

                <!-------------------- ------ Right Box ---------------------------->
                <div class="col-md-6 right-box d-flex align-items-center justify-content-center">
                    <form action="{{route('loginF')}}" method="POST" class="d-flex flex-column align-items-center justify-content-center">
                        @csrf
                        @method('post')
                        <h1 class="titleForm">Log in</h1>
                        <div>
                            <label for="">Username</label>
                            <br>
                            <input type="text" name='name'  class="form-control border-dark">
                        </div>
                        <div>
                            <label for="">Password</label>
                            <br>
                            <input type="password" name="password" class="form-control border-dark">
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-center hover-zoom">
                            <button class="bg-dark text-light mt-2 pb-1">Login </button>
                        </div>
                        <div class="row">
                            <small>Don't have account ? <a href="{{route("Signup")}}">Sign Up</a> / 
                            <a href="/">Home page</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
