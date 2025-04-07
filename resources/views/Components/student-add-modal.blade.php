<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentModalLabel">Register Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addStudentForm" action="{{ route('store') }}" method="post">
          @csrf
          <div class="row g-3">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" 
                  required class="form-control">
                <div id="first_name_error" class="invalid-feedback d-none"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" 
                  required class="form-control">
                <div id="last_name_error" class="invalid-feedback d-none"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" name="student_id" id="student_id" placeholder="Enter Student ID" value="{{ old('student_id') }}" 
                  required class="form-control">
                <div id="student_id_error" class="invalid-feedback d-none"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select" required>
                  <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                  <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                <div id="gender_error" class="invalid-feedback d-none"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" name="contact" id="contact" placeholder="Enter Contact Number" value="{{ old('contact') }}" 
                  required class="form-control">
                <div id="contact_error" class="invalid-feedback d-none"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter Address" value="{{ old('address') }}" 
                  required class="form-control">
                <div id="address_error" class="invalid-feedback d-none"></div>
              </div>
            </div>
          </div>
          <div class="mt-4 d-flex justify-content-between">
            <a href="/admin/studentsList" class="btn btn-secondary">Cancel</a>
            <button id="registerBtn" type="button" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Include Required Bootstrap JS and CSS -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // Open the modal
  function openAddStudentModal() {
    var myModal = new bootstrap.Modal(document.getElementById('addStudentModal'));
    myModal.show();
  }

  // Clear all error messages
  function clearErrorMessages() {
    document.querySelectorAll('[id$="_error"]').forEach(element => {
      element.textContent = '';
      element.classList.add('d-none');
    });

    // Reset input highlighting
    document.querySelectorAll('#addStudentForm input, #addStudentForm select').forEach(element => {
      element.classList.remove('is-invalid');
    });
  }

  // Handle the form submission confirmation
  document.getElementById('registerBtn').addEventListener('click', function() {
    clearErrorMessages(); // Clear any previous error messages

    Swal.fire({
      title: "Are you sure?",
      text: "Please confirm your registration details before submitting.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, submit"
    }).then((result) => {
      if (result.isConfirmed) {
        // Trigger form submission
        $('#addStudentForm').submit(); // This will trigger the form submit and the AJAX handler
      }
    });
  });

  // Handle the form submission via AJAX
  $(document).ready(function() {
    $('#addStudentForm').submit(function(event) {
      event.preventDefault(); // Prevent the form from submitting normally
      clearErrorMessages(); // Clear any previous error messages

      // Send the form data via AJAX
      $.ajax({
        url: '{{ route("store") }}', // Use the correct route for storing the student
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          if (response.status === 'success') {
            Swal.fire({
              icon: 'success',
              title: 'Student Added!',
              text: response.message,
            }).then(() => {
              location.reload(); // Reload the page after successful submission
            });
          } else if (response.status === 'error') {
            // Handle general errors
            Swal.fire({
              icon: 'error',
              title: 'Error!',
              text: response.message, // Display the specific error message from the response
            });
          }
        },
        error: function(xhr, status, error) {
          // Parse the JSON response
          try {
            const response = JSON.parse(xhr.responseText);

            // Check if this is a validation error
            if (xhr.status === 422) {
              // Display validation errors
              const errors = response.errors;

              // Loop through each error field
              for (const field in errors) {
                // Show error message under the corresponding field
                const errorElement = document.getElementById(`${field}_error`);
                if (errorElement) {
                  errorElement.textContent = errors[field][0];
                  errorElement.classList.remove('d-none');

                  // Highlight the input field
                  const inputField = document.getElementById(field);
                  if (inputField) {
                    inputField.classList.add('is-invalid');
                  }
                }
              }

              // Special handling for duplicate student ID
              if (errors.student_id && errors.student_id[0].includes('already exists')) {
                Swal.fire({
                  icon: 'error',
                  title: 'Duplicate Student ID',
                  text: 'This Student ID is already registered in the system.',
                });

                // Highlight the student ID field
                document.getElementById('student_id').classList.add('is-invalid');
              }
            } else {
              // For other types of errors
              Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: response.message || 'Something went wrong with the server!',
              });
            }
          } catch (e) {
            // If not valid JSON or other parsing error
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'An unexpected error occurred!',
            });
          }
        }
      });
    });
  });
</script>