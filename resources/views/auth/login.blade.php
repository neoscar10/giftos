<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        html, body {
            display: grid;
            height: 100%;
            width: 100%;
            place-items: center;
            background: linear-gradient(to right, #3a89e2, #87ceeb, #87ceeb, #81b8ec);
        }
        .wrapper {
            max-width: 390px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .title-text {
            display: flex;
            justify-content: center;
            position: relative;
            height: 40px;
            margin-bottom: 20px;
        }
        .title {
            position: absolute;
            font-size: 35px;
            font-weight: 600;
            text-align: center;
            transition: opacity 0.6s ease;
            opacity: 0;
        }
        .title.active {
            opacity: 1;
        }
        .slide-controls {
            display: flex;
            justify-content: space-between;
            position: relative;
            height: 50px;
            border: 1px solid lightgrey;
            border-radius: 15px;
            margin: 30px 0;
        }
        .slide-controls label {
            z-index: 1;
            width: 50%;
            line-height: 48px;
            text-align: center;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
        }
        .slide-controls .slider-tab {
            position: absolute;
            height: 100%;
            width: 50%;
            border-radius: 15px;
            background: linear-gradient(to right, #3a89e2, #87ceeb, #87ceeb, #81b8ec);
            transition: all 0.6s ease;
        }
        input[type="radio"] {
            display: none;
        }
        #signup:checked ~ .slider-tab {
            left: 50%;
        }
        #signup:checked ~ label.signup {
            color: #fff;
        }
        #signup:checked ~ label.login {
            color: #000;
        }
        #login:checked ~ label.signup {
            color: #000;
        }
        #login:checked ~ label.login {
            color: #fff;
        }
        .form-container {
            width: 100%;
            overflow: hidden;
        }
        .form-inner {
            display: flex;
            width: 200%;
        }
        .form-inner form {
            width: 50%;
            transition: all 0.6s ease;
        }
        form .field {
            height: 50px;
            margin-top: 20px;
        }
        form .field input {
            width: 100%;
            height: 100%;
            padding-left: 15px;
            border: 1px solid lightgrey;
            border-radius: 15px;
            font-size: 17px;
        }
        form .btn {
            margin-top: 20px;
        }
        form .btn input[type="submit"] {
            width: 100%;
            height: 50px;
            background: linear-gradient(to right, #3a89e2, #87ceeb, #87ceeb, #81b8ec);
            color: #fff;
            border: none;
            border-radius: 15px;
            font-size: 20px;
            font-weight: 500;
            cursor: pointer;
        }
        .link {
            margin-top: 10px;
            text-align: center;
            font-size: 15px;
        }
        .link a {
            text-decoration: none;
            color: #3a89e2;
            font-weight: 500;
        }
        .link a:hover {
            text-decoration: underline;
        }
        .social-login {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .social-login a {
            text-decoration: none;
            color: #fff;
            margin: 0 10px;
            padding: 10px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: 500;
        }
        .social-login a.google {
            background: #db4437;
        }
        .social-login a.facebook {
            background: #3b5998;
        }
        .social-login a i {
            margin-right: 8px;
        }

        .back-btn {
    position: absolute;
    top: 100px;
    left: 400px;
    text-decoration: none;
    color: #fff;
    background: #3a89e2;
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background 0.3s ease, transform 0.3s ease;
}
.back-btn:hover {
    background: #2f78c9;
    transform: scale(1.05);
}
.back-btn i {
    font-size: 18px;
}

    </style>
</head>
<body>
    <a href="{{url('/')}}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <div class="wrapper">
        <div class="title-text">
            <div class="title login active">Login</div>
            <div class="title signup">Signup</div>
        </div>
        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="">Signupp</label>
                <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
                <form action="{{ route('login') }}" method="POST" class="login">
                    @csrf
                    <div class="field">
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="field btn">
                        <input type="submit" value="Login">
                    </div>
                    <div class="link">
                        <a href="{{ route('password.request') }}">Forgot password?</a>
                    </div>
                    <div class="link">
                        {{-- Not a member? <a href="#" onclick="document.getElementById('signup').click()">Signup now</a> --}}
                        Not a member? <a href="{{url('/register')}}" >Signup now</a>
                    </div>
                    <div class="social-login">
                        <a href="{{route('auth.google')}}" class="google"><i class="fab fa-google"></i> Google</a>
                        {{-- <a href="#" class="facebook"><i class="fab fa-facebook-f"></i> Facebook</a> --}}
                    </div>
                </form>
                
                <form action="{{ route('register') }}" method="POST" class="signup">
                    @csrf
                    {{-- Name --}}
                    <div class="field">
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                    {{-- email --}}
                    <div class="field">
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    {{-- Phone --}}
                    <div class="field">
                        <input type="text" name="phone"  placeholder="Phone Number" required>
                    </div>
                    {{-- Address --}}
                    <div class="field">
                        <input type="text" name="address" placeholder="Address" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="field">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <div class="field btn">
                        <input type="submit" value="Signup">
                    </div>
                </form>                
            </div>
        </div>
    </div>
    <script>
        const loginRadio = document.getElementById("login");
        const signupRadio = document.getElementById("signup");
        const loginTitle = document.querySelector(".title-text .login");
        const signupTitle = document.querySelector(".title-text .signup");
        const loginForm = document.querySelector("form.login");

        signupRadio.addEventListener("click", () => {
            loginForm.style.marginLeft = "-50%";
            loginTitle.classList.remove("active");
            signupTitle.classList.add("active");
        });

        loginRadio.addEventListener("click", () => {
            loginForm.style.marginLeft = "0";
            signupTitle.classList.remove("active");
            loginTitle.classList.add("active");
        });
    </script>
</body>
</html>
