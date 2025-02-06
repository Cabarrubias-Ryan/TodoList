@extends('layouts.app')

@section('title','Login Page')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center vh-100">
                @if (Auth::check())
                <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Go to Home</a>
                @else
                <div class="border rounded shadow-lg bg-white p-4" style="max-width: 400px; width: 100%;">
                    <div class="">
                        <h2 class="text-center mt-5 fw-bold">Login</h2>
                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="p-3 mt-3">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Username">
                                </div>
                                <div class="form-group mt-4">
                                  <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Password">
                                </div>
                                <div class="mt-5" class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded-pill">Login</button>
                                </div>
                                <div class="text-center mt-4">
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
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
