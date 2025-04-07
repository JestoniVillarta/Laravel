
@foreach ($students as $student)
<!-- Bootstrap Modal -->
<div class="modal fade" id="editModal-{{ $student->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $student->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel-{{ $student->id }}">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm-{{ $student->id }}">
          @method('PUT')
          @csrf
          
          <div class="row g-3">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="first_name-{{ $student->id }}" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name-{{ $student->id }}" value="{{ $student->first_name }}">
                <div id="first_name_error-{{ $student->id }}" class="invalid-feedback d-none"></div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-3">
                <label for="last_name-{{ $student->id }}" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name-{{ $student->id }}" value="{{ $student->last_name }}">
                <div id="last_name_error-{{ $student->id }}" class="invalid-feedback d-none"></div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-3">
                <label for="student_id-{{ $student->id }}" class="form-label">Student ID</label>
                <input type="text" class="form-control" name="student_id" id="student_id-{{ $student->id }}" value="{{ $student->student_id }}">
                <div id="student_id_error-{{ $student->id }}" class="invalid-feedback d-none"></div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-3">
                <label for="gender-{{ $student->id }}" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender-{{ $student->id }}">
                  <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                  <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                <div id="gender_error-{{ $student->id }}" class="invalid-feedback d-none"></div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-3">
                <label for="contact-{{ $student->id }}" class="form-label">Contact</label>
                <input type="text" class="form-control" name="contact" id="contact-{{ $student->id }}" value="{{ $student->contact }}">
                <div id="contact_error-{{ $student->id }}" class="invalid-feedback d-none"></div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-3">
                <label for="address-{{ $student->id }}" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" id="address-{{ $student->id }}" value="{{ $student->address }}">
                <div id="address_error-{{ $student->id }}" class="invalid-feedback d-none"></div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="/admin/studentsList" class="btn btn-secondary">Cancel</a>
        <button type="button" class="btn btn-primary" onclick="confirmUpdate('{{ $student->id }}')">Update Student</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Custom CSS -->
<style>
  .modal-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
  }
  
  .modal-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
  }
  
  .btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
  }
  
  .btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2653d4;
  }
  
  .form-control:focus, .form-select:focus {
    border-color: #bac8f3;
    box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
  }
  
  .is-invalid {
    border-color: #e3342f !important;
  }
</style>

<script>
  function openModal(id) {
    var myModal = new bootstrap.Modal(document.getElementById(`editModal-${id}`));
    myModal.show();
  }
  
  function closeModal(id) {
    var myModal = bootstrap.Modal.getInstance(document.getElementById(`editModal-${id}`));
    if (myModal) {
      myModal.hide();
    }
  }
  
  function clearEditErrors(id) {
    document.querySelectorAll(`#editForm-${id} [id$="_error-${id}"]`).forEach(element => {
      element.textContent = '';
      element.classList.add('d-none');
    });
    
    document.querySelectorAll(`#editForm-${id} .form-control, #editForm-${id} .form-select`).forEach(input => {
      input.classList.remove('is-invalid');
    });
  }
  
  function confirmUpdate(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you want to update this student's details?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#4e73df',
      cancelButtonColor: '#e74a3b',
      confirmButtonText: 'Yes, update it!'
    }).then((result) => {
      if (result.isConfirmed) {
        updateStudent(id);
      }
    });
  }
  
  function updateStudent(id) {
    clearEditErrors(id);
    
    $.ajax({
      url: `/admin/${id}/edit`,
      type: 'POST',
      data: $(`#editForm-${id}`).serialize(),
      success: function(response) {
        closeModal(id);
        Swal.fire({
          icon: 'success',
          title: 'Student Updated!',
          text: response.message,
          confirmButtonColor: '#4e73df'
        }).then(() => {
          location.reload();
        });
      },
      error: function(xhr) {
        const response = xhr.responseJSON;
        if (xhr.status === 422) {
          for (const field in response.errors) {
            const errorElement = document.getElementById(`${field}_error-${id}`);
            const inputElement = document.getElementById(`${field}-${id}`);
            
            if (errorElement) {
              errorElement.textContent = response.errors[field][0];
              errorElement.classList.remove('d-none');
            }
            
            if (inputElement) {
              inputElement.classList.add('is-invalid');
            }
          }
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Server Error',
            text: response.message || 'Something went wrong!',
            confirmButtonColor: '#4e73df'
          });
        }
      }
    });
  }
</script>