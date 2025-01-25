@extends('layouts.app')

@section('title','Login Page')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center vh-100">
                <div class="border rounded shadow-lg bg-white p-4" style="max-width: 400px; width: 100%;">
                    <div class="">
                        <h2 class="text-center mt-5 fw-bold">Login</h2>
                        <div>
                            <form class="p-3 mt-3">
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
                                    <a href="{{ route('auth.google.redirect')}}" class="btn btn-primary border rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                        <i class="fa-brands fa-google"></i>
                                    </a>
                                    <button class="btn btn-danger border rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                        <i class="fa-brands fa-facebook"></i>
                                    </button>
                                    <button class="btn btn-success rounded-circle d-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                        <i class="fa-brands fa-github"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
