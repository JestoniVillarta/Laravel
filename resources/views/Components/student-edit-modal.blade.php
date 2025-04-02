@foreach ($students as $student)
<div id="editModal-{{ $student->id }}" class="fixed inset-0 hidden bg-gray-600 bg-opacity-75 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl overflow-auto">
        <div class="pb-4 flex justify-between">
            <h2 class="text-lg font-semibold">Edit Student</h2>
            <button onclick="closeModal('{{ $student->id }}')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <form id="editForm-{{ $student->id }}">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label for="first_name-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" id="first_name-{{ $student->id }}" value="{{ $student->first_name }}" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                    <p id="first_name_error-{{ $student->id }}" class="text-red-500 text-xs hidden"></p>
                </div>
                <div>
                    <label for="last_name-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" id="last_name-{{ $student->id }}" value="{{ $student->last_name }}" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                    <p id="last_name_error-{{ $student->id }}" class="text-red-500 text-xs hidden"></p>
                </div>

                <div>
                    <label for="student_id-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                    <input type="text" name="student_id" id="student_id-{{ $student->id }}" value="{{ $student->student_id }}" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                    <p id="student_id_error-{{ $student->id }}" class="text-red-500 text-xs hidden"></p>
                </div>

                <div>
                    <label for="gender-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" id="gender-{{ $student->id }}" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <p id="gender_error-{{ $student->id }}" class="text-red-500 text-xs hidden"></p>
                </div>
                <div>
                    <label for="contact-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
                    <input type="text" name="contact" id="contact-{{ $student->id }}" value="{{ $student->contact }}" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                    <p id="contact_error-{{ $student->id }}" class="text-red-500 text-xs hidden"></p>
                </div>
                <div>
                    <label for="address-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" id="address-{{ $student->id }}" value="{{ $student->address }}" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                    <p id="address_error-{{ $student->id }}" class="text-red-500 text-xs hidden"></p>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">

                <a href="/admin/studentsList" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">Cancel</a>

                <button type="button" onclick="confirmUpdate('{{ $student->id }}')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Update Student</button>
            </div>
        </form>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function openModal(id) {
        document.getElementById(`editModal-${id}`).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(`editModal-${id}`).classList.add('hidden');
    }

    function clearEditErrors(id) {
        document.querySelectorAll(`#editForm-${id} [id$="_error-${id}"]`).forEach(element => {
            element.textContent = '';
            element.classList.add('hidden');
        });
    }

    function confirmUpdate(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to update this student's details?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
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
            Swal.fire({
                icon: 'success',
                title: 'Student Updated!',
                text: response.message,
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
                        errorElement.classList.remove('hidden');
                    }

                    if (inputElement) {
                        inputElement.classList.add('border-red-500');
                    }
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: response.message || 'Something went wrong!',
                });
            }
        }
    });
}
</script>
