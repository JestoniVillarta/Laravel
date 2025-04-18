<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" rel="stylesheet">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addStudentForm">
                <div class="modal-header">
                    <h1 class="modal-title fs-4 fw-bold" id="addStudentModalLabel">Add New Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    @csrf
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Student ID</label>
                            <input type="text" name="student_id" class="form-control" placeholder="Enter Student ID">
                            <small class="text-danger error-student_id"></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                            <small class="text-danger error-first_name"></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                            <small class="text-danger error-last_name"></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <small class="text-danger error-gender"></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Contact</label>
                            <input type="text" name="contact" class="form-control" placeholder="Enter Contact Number">
                            <small class="text-danger error-contact"></small>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2" placeholder="Enter Address"></textarea>
                            <small class="text-danger error-address"></small>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <a href="/admin/studentsList" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Adjust Modal Width */
    .modal-title {
        color: #333;
    }

    .form-label {
        font-weight: 500;
    }

    .modal-footer .btn {
        font-size: 16px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $('#addStudentForm').submit(function(e) {
      e.preventDefault();

      // Clear previous errors
      $('.text-danger').text('');

      var formData = $(this).serialize();

      $.ajax({
        url: "{{ route('store') }}", // adjust this route
        method: "POST",
        data: formData,
        success: function(response) {
          if (response.status === 'success') {
            $('#addStudentModal').modal('hide');
            $('#addStudentForm')[0].reset();

            // SweetAlert Success Message
            Swal.fire({
              icon: 'success',
              title: 'Student Added!',
              text: response.message,
              confirmButtonColor: '#4e73df'
            }).then(() => {
              location.reload(); // Reload the page to see the new student
            });
          }
        },
        error: function(xhr) {
          const response = xhr.responseJSON;
          if (xhr.status === 422) {
            // Validation errors
            $.each(response.errors, function(key, value) {
              $('.error-' + key).text(value[0]);
            });

            // Check specifically for student_id duplicate error
            if (response.errors && response.errors.student_id) {
              const studentIdErrors = response.errors.student_id;
              // Look for unique/duplicate error messages
              const hasDuplicateError = studentIdErrors.some(error =>
                error.toLowerCase().includes('already') ||
                error.toLowerCase().includes('taken') ||
                error.toLowerCase().includes('exists') ||
                error.toLowerCase().includes('unique') ||
                error.toLowerCase().includes('duplicate')
              );

              if (hasDuplicateError) {
                // Highlight the student_id field more prominently
                $('input[name="student_id"]').addClass('is-invalid border-danger');

                // Special SweetAlert for duplicate student ID
                Swal.fire({
                  icon: 'error',
                  title: 'Duplicate Student ID',
                  text: 'This Student ID already exists in the database. Please use a different ID.',
                  confirmButtonColor: '#e74a3b'
                });
                return;
              }
            }

            // General validation error alert (for other validation errors)
            Swal.fire({
              icon: 'error',
              title: 'Validation Error',
              text: 'Please check the form for errors.',
              confirmButtonColor: '#e74a3b'
            });
          } else {
            // Server or other errors
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Something went wrong. Please try again.',
              confirmButtonColor: '#e74a3b'
            });
          }
        }
      });
    });

    // Remove error highlighting when user starts typing again
    $('input[name="student_id"]').on('input', function() {
      $(this).removeClass('is-invalid border-danger');
    });
</script>
