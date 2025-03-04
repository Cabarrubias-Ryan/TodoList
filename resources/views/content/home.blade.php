@extends('layouts.app')

@section('title','Home')

@section('content')
<main class="container mt-4">
    @if(session('login_success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
            <span>{{ session('login_success')}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section class="mt-4 d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="mt-3">
                <button type="button" class="btn btn-primary rounded-pill btn-sm" id="task-btn" data-bs-toggle="modal" data-bs-target="#modalAddTask">
                    <i class="fa-solid fa-plus me-1"></i>Add Task
                </button>
            </div>
            <div class="mt-4">
                <div class="border rounded-top p-4 outer-box">
                    <div class="mb-2">
                        <h3 class="fw-bold">Todo List</h3>
                        <p>Stay on top of your ro-dos and boost productivity with ease.</p>
                    </div>
                    <div class="inner-box m-2">
                        @foreach ($task as $item)
                        <ul class="list-group mt-2" style="cursor: pointer;">
                            <li class="list-group-item d-flex justify-content-between align-items-center displayData">
                                <div>
                                    <h6 id="displayData"
                                    data-display-title="{{ $item->title}}" data-display-description="{{ $item->description}}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"> {{ $item->title}}</h6>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-outline-success btn-sm btnUpdate" data-bs-toggle="modal" data-bs-target="#modalUpdateTask"
                                            data-id="{{ $item->id }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" id="btnDelete" data-id-delete="{{ $item->id}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>
</main>
<div class="col-lg-3 col-md-6">
    <div class="mt-4">
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
          <h5  class="offcanvas-title" id="title-display"></h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
          <p class="text-center" id="description-display"></p>
          <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">Close</button>
        </div>
      </div>
    </div>
  </div>
{{-- Add Task --}}
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
                            <textarea name="description" id="description" class="form-control" placeholder="Text here.." rows="10" style="resize: none;"></textarea>
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
{{-- Update Task --}}
<div class="modal fade" id="modalUpdateTask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
            <form id="taskForm_update">
                <div class="mt-3 mb-2">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                        <input type="hidden" id="id_update" name="id_update" class="form-control">
                        <input type="text" id="title_update" name="title_update" class="form-control" placeholder="Title">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb3">
                            <textarea name="description_update" id="description_update" class="form-control" placeholder="Text here.." rows="10" style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="updateBtn"  class="btn btn-primary">Submit</button>
        </div>
    </div>
    </div>
</div>
<script src="{{ asset('js/task.js') }}"></script>
@endsection
