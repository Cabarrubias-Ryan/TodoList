<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
                        <h2 class="text-center mt-5 fw-bold">Register</h2>
                        <div>
                            <form id="registerAccount" class="p-4 mt-2">
                                @csrf
                                <div class="mt-3">
                                    <input type="text" class="form-control"  placeholder="Username" name="username" id="username">
                                </div>
                                <div class="mt-4">
                                    <input type="password" class="form-control"  placeholder="Password" name="password" id="password">
                                </div>
                                <div class="mt-4">
                                    <input type="email" class="form-control"  placeholder="Email" name="email" id="email">
                                </div>
                                <div class="mt-4">
                                    <input type="text" class="form-control"  placeholder="Name" name="name" id="name">
                                </div>
                                <div class="mt-5" class="form-group">
                                    <button type="button" class="form-control btn btn-primary rounded py-2" id="btnRegister">Register</button>
                                </div>
                            </form>
                            <div class="text-center mt-2">
                                <p>Already have an account? <a href="{{ route('login')}}" class="text-decoration-none">Sign in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="preloader" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="mt-4">
                <span style="font-size: 1.2rem" class="text-primary">Loading please wait....</span>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
