<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    @vite(['resources/js/app.js'])
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <main class="container-fluid">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center vh-100">
                @if (Auth::check())
                <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Go to Home</a>
                @else
                <div class="border rounded shadow-lg bg-white p-4" style="max-width: 500px; width: 100%;">
                    <div class="">
                        <h2 class="text-center mt-4 fw-bold">Login</h2>
                        <div>
                            <div class="p-4 mt-3">
                                <form id="loginData">
                                    @csrf
                                    <div class="mt-4">
                                        <input type="text" class="form-control"  placeholder="Username" name="username" id="username">
                                    </div>
                                    <div class="mt-4">
                                        <input type="password" class="form-control"  placeholder="Password" name="password" id="password">
                                    </div>
                                    <div class="mt-5" class="form-group">
                                        <button type="button" class="form-control btn btn-primary rounded py-2" id="loginBtn">Login</button>
                                    </div>
                                </form>
                                <div class="text-center mt-3">
                                    <span>Or Sign with</span>
                                </div>
                                <div class="d-flex justify-content-center mt-3 gap-3">
                                    <a href="{{ route('auth.provider.redirect','google')}}" class="btn btn-primary border rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                        <i class="fa-brands fa-google"></i>
                                    </a>
                                    <a href="{{ route('auth.provider.redirect','facebook')}}" class="btn btn-danger border rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                        <i class="fa-brands fa-facebook"></i>
                                    </a>
                                    <a href="{{ route('auth.provider.redirect','github')}}" class="btn btn-success rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                        <i class="fa-brands fa-github"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="text-center">
                                <p>Don't you have a account? <a href="{{ route('auth.register')}}" class="text-decoration-none">Sign Up</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>
    <div class="preloader" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="mt-4">
            <span style="font-size: 1.7rem" class="text-primary">Logging in...</span>
        </div>
    </div>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
