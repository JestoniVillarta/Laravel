@foreach ($students as $student)
<!-- Bootstrap Modal for Editing Student -->
<div class="modal fade" id="editModal-{{ $student->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-{{ $student->id }}">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm-{{ $student->id }}" class="editStudentForm" method="POST" action="{{ route('students.update', $student->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <!-- First Name Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name-{{ $student->id }}" class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name-{{ $student->id }}" value="{{ $student->first_name }}">
                                <div class="invalid-feedback error-first_name"></div>
                            </div>
                        </div>

                        <!-- Last Name Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="last_name-{{ $student->id }}" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name-{{ $student->id }}" value="{{ $student->last_name }}">
                                <div class="invalid-feedback error-last_name"></div>
                            </div>
                        </div>

                        <!-- Student ID Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="student_id-{{ $student->id }}" class="form-label">Student ID</label>
                                <input type="text" class="form-control" name="student_id" id="student_id-{{ $student->id }}" value="{{ $student->student_id }}">
                                <div class="invalid-feedback error-student_id"></div>
                            </div>
                        </div>

                        <!-- Gender Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="gender-{{ $student->id }}" class="form-label">Gender</label>
                                <select class="form-select" name="gender" id="gender-{{ $student->id }}">
                                    <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                <div class="invalid-feedback error-gender"></div>
                            </div>
                        </div>

                        <!-- Contact Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contact-{{ $student->id }}" class="form-label">Contact</label>
                                <input type="text" class="form-control" name="contact" id="contact-{{ $student->id }}" value="{{ $student->contact }}">
                                <div class="invalid-feedback error-contact"></div>
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address-{{ $student->id }}" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address-{{ $student->id }}" value="{{ $student->address }}">
                                <div class="invalid-feedback error-address"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" form="editForm-{{ $student->id }}">Update Student</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Handle form submission for editing student
        $('.editStudentForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Get the current form
            const form = $(this);
            const formId = form.attr('id');
            const studentId = formId.split('-')[1]; // Extract student ID from form ID

            // Clear previous errors
            form.find('.invalid-feedback').empty().hide();
            form.find('.form-control, .form-select').removeClass('is-invalid');

            // Get form data
            const formData = form.serialize();
            const actionUrl = form.attr('action');

            // Perform AJAX request to submit the form data
            $.ajax({
                url: actionUrl,
                method: "POST", // Use POST for PUT method submission via _method
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        // Hide the modal after success
                        $('#editModal-' + studentId).modal('hide');

                        // Show success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Student Updated!',
                            text: response.message || 'Student information has been updated successfully.',
                            confirmButtonColor: '#4e73df'
                        }).then(() => {
                            location.reload(); // Reload the page to reflect updated data
                        });
                    }
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    if (xhr.status === 422) {
                        // Validation errors handling
                        $.each(response.errors, function(key, value) {
                            const errorField = form.find('.error-' + key);
                            const inputField = form.find('[name="' + key + '"]');

                            errorField.text(value[0]).show();
                            inputField.addClass('is-invalid');
                        });

                        // Show SweetAlert for validation errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Please check the form for errors.',
                            confirmButtonColor: '#e74a3b'
                        });
                    } else {
                        // Show SweetAlert for other errors (e.g., server errors)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Something went wrong. Please try again.',
                            confirmButtonColor: '#e74a3b'
                        });
                    }
                }
            });
        });
    });
</script>
