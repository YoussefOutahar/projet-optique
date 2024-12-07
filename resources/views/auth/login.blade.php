<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <style>
        /* Général */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            height: 600px;
            border-radius: 8px;
            overflow: hidden;
        }

        .left-panel {
            flex: 1;
            background: url('https://img.freepik.com/free-vector/ophthalmologist-concept-illustration_114360-6022.jpg') no-repeat center center;
            background-size: cover;
        }

        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            padding: 20px;
            position: relative;
        }

        .right-panel img {
            width: 150px;
            margin-bottom: 20px;
        }

        .right-panel h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .right-panel form {
            width: 100%;
            max-width: 400px;
        }

        .right-panel label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .right-panel input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .right-panel button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .right-panel button:hover {
            background-color: #0056b3;
        }

        .right-panel .links {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
            gap: 10px;
        }

        .right-panel .links a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .right-panel .links a:hover {
            text-decoration: underline;
        }

        .right-panel .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .right-panel .remember-me input {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <img src="https://img.freepik.com/free-vector/ophthalmologist-concept-illustration_114360-6022.jpg" alt="Image de Connexion">
        </div>
        <div class="right-panel">
            <!-- Logo -->
            <img src="https://digiup.ma/wp-content/uploads/2020/12/Capture_d_ecran_2022-08-26_153120-removebg-preview.png" alt="Logo">

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="text-red-600 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <br><br>
         

                <!-- Submit Button -->
                <button type="submit">
                    {{ __('Log in') }}
                </button>
            </form>

            <!-- Links -->
            <div class="links">
                <a href="{{ route('register') }}" class="btn btn-primary">Register?</a>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
