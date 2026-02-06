<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- bootstrap links --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Css link --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('style/style.css') }}">
    <title>Login</title>
    <style>
        .container {
            width: 80%;
            height: 60vh;
            background-color: aliceblue
        }
    </style>
</head>

<body class="bg-light">

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg border-0" style="width: 420px;">
            <div class="card-body p-4">

                <!-- Logo / Title -->
                <div class="text-center mb-4">
                    <i class="bi bi-shield-lock fs-1 text-primary"></i>
                    <h3 class="mt-2 fw-bold">Welcome back</h3>
                    <p class="text-muted">Sign in to your account</p>
                </div>

                {{-- Erreurs --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Login Form -->
                <form action="{{ route('login.check') }}" method="POST" >
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com" required value="{{ old('email')}}">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Remember + Forgot -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="text-decoration-none small">Forgot password?</a>
                    </div>

                    <!-- Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Sign In
                        </button>
                    </div>
                </form>

                <!-- Register -->
                <div class="text-center mt-4">
                    <span class="text-muted">Don’t have an account?</span>
                    <a href="{{ route('register.index') }}" class="fw-semibold text-decoration-none">Sign up</a>
                </div>

            </div>
        </div>
    </div>

</body>

</html>