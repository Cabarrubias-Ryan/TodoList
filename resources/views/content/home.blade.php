@extends('layouts.app')

@section('title','Home')

@section('content')
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">Todoist</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav d-flex justify-content-end w-100">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }} <i class="fa-solid fa-user" style="margin-left: 8px;"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <main class="container mt-4">
        @if(session('login_success'))
            <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                <span>{{ session('login_success')}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section>
            <div class="mt-3">
                <button type="button" class="btn btn-primary rounded-pill btn-sm" id="task-btn" data-bs-toggle="modal" data-bs-target="#modalAddTask">
                    <i class="fa-solid fa-plus me-1"></i>Add Task
                </button>
            </div>
        </section>
    </main>
    <div class="modal fade" id="modalAddTask" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="taskForm">
                    <div class="mt-3 mb-2">
                        @csrf
                        <div class="row">
                            <div class="col mb-3">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb3">
                                <textarea name="description" id="description" class="form-control" placeholder="Text here.." rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveBtn"  class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
</div>
<script src="{{ asset('js/task.js') }}"></script>
@endsection
