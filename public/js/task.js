
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function validateForm(fields) {
let valid = true;

// Loop through all fields to check if any are empty
fields.forEach(field => {
    const input = document.getElementById(field.id);
    const value = input.value.trim();
    const errorMessages = [];

    // Check for empty fields
    if (!value) {
    valid = false;
    errorMessages.push(`${field.label} is required.`);
    }

    if (errorMessages.length > 0) {
    input.classList.add('is-invalid'); // Add Bootstrap 'is-invalid' class
    let errorMessageContainer = input.parentNode.querySelector('.invalid-feedback');
    if (!errorMessageContainer) {
        errorMessageContainer = document.createElement('div');
        errorMessageContainer.classList.add('invalid-feedback');
        input.parentNode.appendChild(errorMessageContainer);
    }
    errorMessageContainer.innerHTML = errorMessages.join('<br>'); // Display all errors for this field
    } else {
    input.classList.remove('is-invalid'); // Remove 'is-invalid' class if valid
    let errorMessageContainer = input.parentNode.querySelector('.invalid-feedback');
    if (errorMessageContainer) {
        errorMessageContainer.remove(); // Remove error messages
    }
    }
});

return valid;
}

$(document).ready(function () {
    $('#saveBtn').on('click', function() {
        const fields = [
            { id: 'title', label: 'Title' },
            { id: 'description', label: 'Description' },
        ];

        const isValid = validateForm(fields);

        if (!isValid) {
            event.preventDefault();
            return;
        }

        $.ajax({
            type: 'POST',
            url: '/home/addtask',
            cache: false,
            data: $("#taskForm").serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#modalAddTask').modal('hide');
                $('.preloader').show();
              },
            success: function (data) {
                $('.preloader').hide();
                if (data.Error == 1) {
                    Swal.fire('Error!', data.Message, 'error');
                } else if (data.Error == 0) {
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Saved!',
                    text: data.Message,
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                    }).then(result => {
                    location.reload();
                    });
                }
            },
            error: function () {
                $('.preloader').hide();
                Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
            }
        });
    })
});


$(document).ready(function () {
    $('body').on('click', '.btnUpdate', function() {

        var id = $(this).data('id');
        var title = $(this).data('title');
        var description = $(this).data('description');  // Corrected this line

        $('#id_update').val(id);
        $('#title_update').val(title);
        $('#description_update').val(description);


        $('#updateBtn').on('click', function () {
            const fields = [
                { id: 'title_update', label: 'Title' },
                { id: 'description_update', label: 'Description' },
            ];

            const isValid = validateForm(fields);

            if (!isValid) {
                event.preventDefault();
                return;
            }

            $.ajax({
                type: 'POST',
                url: '/home/update',
                cache: false,
                data: $('#taskForm_update').serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#modalUpdateTask').modal('hide');
                    $('.preloader').show();
                },
                success: function (data) {
                    $('.preloader').hide();

                    if (data.Error == 1) {
                        Swal.fire('Error!', data.Message, 'error');
                    } else if (data.Error == 0) {
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved!',
                        text: data.Message,
                        showConfirmButton: true,
                        confirmButtonText: 'OK'
                        }).then(result => {
                        location.reload();
                        });
                    }
                },
                error: function () {
                    $('.preloader').hide();
                    Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                }
            })
        });
    });
});

$(document).ready(function () {
    $('body').on('click', '#btnDelete', function() {
        var data_id = $(this).data('id-delete');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
             $.ajax({
                type: 'POST',
                url: '/home/delete',
                cache: false,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: data_id
                  },
                dataType: 'json',
                beforeSend: function () {
                    $('.preloader').show();
                },
                success: function (data) {
                    $('.preloader').hide();
                    if (data.Error == 1) {
                        Swal.fire('Error!', data.Message, 'error');
                      } else if (data.Error == 0) {
                        Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: 'Saved!',
                          text: data.Message,
                          showConfirmButton: true,
                          confirmButtonText: 'OK'
                        }).then(result => {
                          location.reload();
                        });
                      }
                },
                error: function () {
                    $('.preloader').hide();
                    Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                }

             })
            }
          });
    })
})



$(document).ready(function () {
    $('body').on('click', '#displayData', function() {

        var $title = $(this).data('display-title');
        var $description = $(this).data('display-description');
        var $status = $(this).data('status');
        var $statusID = $(this).data('id');

        $('#title-display').text($title);
        $('#description-display').text($description);

        if($status == "0"){
            $('#task_status').text('Complete');
        }
        else{
            $('#title-display').addClass('text-decoration-line-through');
            $('#description-display').addClass('text-decoration-line-through');
            $('#task_status').text('Undo');
        }

        $('body').on('click', '#task_status', function () {
            $.ajax({
                type: 'POST',
                url: '/home/status',
                cache: false,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    status: $status,
                    statusID: $statusID,
                },
                dataType: 'json',
                success: function(){
                    location.reload();
                },
                error: function () {
                    Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                }
            });
        });

    })
})

$(document).ready(function () {
    $('#search').on('keyup', function() {
        var data = $(this).val().toLowerCase();

        if(data.length >= 1){
            $.ajax({
                type: 'POST',
                url: '/home/search',
                cache: false,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search: data
                  },
                dataType: 'json',
                success: function (data) {
                    if (data.Error == 1) {
                        Swal.fire('Error!', data.Message, 'error');
                    } else if (data.Error == 0) {
                        renderTaskList(data.html);
                    }
                },
                error: function () {
                    Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                }
            })
        }else{
            $.ajax({
                type: 'GET',
                url: '/home',
                cache: false,
                success: function (data) {
                    if (data.Error == 1) {
                        Swal.fire('Error!', data.Message, 'error');
                      } else if (data.Error == 0) {

                        renderTaskList(data.html);
                      }
                },
                error: function () {
                    Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
                }
            })
        }
    })

    function renderTaskList(tasks) {
        let taskListHtml = ''; // Initialize an empty string for task list HTML

        // Loop through each task and generate the HTML
        tasks.forEach(function (task) {
            taskListHtml += `
                <ul class="list-group mt-2" style="cursor: pointer;">
                    <li class="list-group-item d-flex justify-content-between align-items-center displayData">
                        <div>
                            <h6 id="displayData"
                                class="task-title ${task.is_complete === 1 ? 'text-decoration-line-through' : ''}"
                                data-display-title="${task.title}"
                                data-display-description="${task.description}"
                                data-status="${task.is_complete}"
                                data-id="${task.id}"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasEnd"
                                aria-controls="offcanvasEnd">
                                ${task.title}
                            </h6>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-success btn-sm btnUpdate" data-bs-toggle="modal" data-bs-target="#modalUpdateTask"
                                    data-id="${ task.id }" data-title="${ task.title }" data-description="${ task.description }">
                                <i class="fa-solid fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" id="btnDelete" data-id-delete="${task.id}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </li>
                </ul>
            `;
        });

        if (tasks.length === 0) {
            taskListHtml = `
                <div class="text-center mt-4">
                    <h5 class="text-muted">No Task Found</h5>
                </div>
            `;
        }

        // Update the task list container with the generated HTML
        $('#taskList').html(taskListHtml);
    }
})

