@section('content')
    <style>
        body {
            background-image: url({{ asset('image/bg2.jpg') }});
            background-size: cover;
            /* Memastikan bahwa gambar latar belakang menutupi seluruh area body */
            background-position: center;
            /* Posisikan gambar latar belakang di tengah */
            background-repeat: no-repeat;
            /* Mencegah gambar latar belakang diulang */
            height: 60vh;
            /* Memberikan ketinggian (height) 100% dari viewport (tinggi layar) */
        }

        .ghoib {
            margin-bottom: 9.5rem;
        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Center horizontally */
            position: relative;
            background-color: #240046;
            max-height: 420px;
            overflow: hidden;
            border-radius: 12px;
            margin-top: 50px;
            /* Add margin-top to create space */
            box-shadow: 7px 7px 10px 3px #24004628;
            max-width: 20%;
            margin: auto;
            /* Center the main container */
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 14px;
            padding: 24px;
        }

        /* Checkbox to switch from sign up to login */
        #chk {
            display: none;
        }

        /* Login */
        .login {

            width: 100%;
            height: 100%;
        }

        .login label {
            margin: 30% 0 5%;
        }

        label {
            color: #fff;
            font-size: 2rem;
            justify-content: center;
            display: flex;
            font-weight: bold;
            cursor: pointer;
            transition: .5s ease-in-out;
        }

        .form-control {
            width: 100%;
            height: 40px;
            background: #e0dede;
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 4px;
            justify-content: center;
        }

        /* Register */
        .register {
            background: #eee;
            border-radius: 60% / 10%;
            transition: .8s ease-in-out;
            transform: translateY(-10%);
            margin-top: 10px;
        }

        .register label {
            color: #573b8a;
            transform: scale(.6);
        }

        #chk:checked~.register {
            transform: translateY(-60%);
        }

        #chk:checked~.register label {
            transform: scale(1);
            margin: 10% 0 5%;
        }

        #chk:checked~.login label {
            transform: scale(.6);
            margin: 5% 0 5%;
        }

        /* Button */
        .form button {
            width: 85%;
            height: 40px;
            margin: 12px auto 10%;
            color: #fff;
            background: #573b8a;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: .2s ease-in;
        }

        .form button:hover {
            background-color: #6d44b8;
        }
    </style>

    <div class="ghoib">

    </div>

    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="login">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <label for="chk" aria-hidden="true">Login</label> <!-- Updated label for login -->
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                    placeholder="Email" value="{{ old('email') }}" autocomplete="email">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                    placeholder="Password" required autocomplete="current-password">

                <button type="submit">Login</button> <!-- Updated button text -->
            </form>
        </div>

        <div class="register">
            <form class="form" method="POST" action="{{ route('register') }}">
                @csrf
                <label for="chk" aria-hidden="true">Register</label> <!-- Original label for register -->
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" placeholder="Nama" required autocomplete="name" autofocus>

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Password" required autocomplete="new-password">

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    placeholder="Confirm Password" autocomplete="new-password">
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
