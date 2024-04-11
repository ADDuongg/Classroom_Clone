<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="d-flex justify-content-center align-content-center flex-wrap">
    <div class="container-div">
        <div class="heading">Register</div>
        <form action="{{route('register')}}" class="form" method="POST">
            @csrf
            <input required="" class="input" type="name" name="name" id="name" placeholder="Name" value="{{old('name')}}">
            <input required="" class="input" type="email" name="email" id="email" placeholder="E-mail">
            <input required="" class="input" type="password" name="password" id="password" placeholder="Password">
            <input required="" class="input" type="password" name="password_confirm" id="password_confirm" placeholder="Password Confirm">
            <div class="d-flex justify-content-between">
                <!-- <span class="forgot-password"><a href="#">Forgot Password ?</a></span> -->
                <!-- <span class="forgot-password"><a href="{{route('register')}}">Register</a></span> -->
            </div>
            <input class="login-button" type="submit" value="Register">

        </form>
        <a class="button" href="{{ route('login') }}" style="text-decoration: none; color: white; text-align: center;">Back</a>
        <span class="agreement"><a href="#">Learn user licence agreement</a></span>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>