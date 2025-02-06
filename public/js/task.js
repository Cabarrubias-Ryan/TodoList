
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


document.getElementById('saveBtn').addEventListener('click', function (event) {
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
            $('.preloader').show();
          },
        success: function (data) {
            $('.preloader').hide();
            if (data.Error == 1) {
                $('#modalAddTask').modal('hide');
                Swal.fire('Error!', data.Message, 'error');
            } else if (data.Error == 0) {
                $('#modalAddTask').modal('hide');
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
            $('#modalAddTask').modal('hide');
            Swal.fire('Error!', 'Something went wrong, please try again.', 'error');
        }
    });
});
