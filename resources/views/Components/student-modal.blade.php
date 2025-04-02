<!-- Add Student Modal -->
<div id="addStudentModal" class="fixed inset-0 hidden bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
        <div class="pb-4 flex justify-between">
            <h2 class="text-lg font-semibold">Register Student</h2>
            <button onclick="closeAddStudentModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <form id="addStudentForm" action="{{ route('store') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="student_id" class="block text-gray-700 font-medium mb-2">Student ID</label>
                <input type="text" name="student_id" id="student_id" placeholder="Enter Student ID" value="{{ old('student_id') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                <span id="student_id_error" class="text-red-500 text-sm hidden"></span>
            </div>

            <div class="mb-4">
                <label for="first_name" class="block text-gray-700 font-medium mb-2">First Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                <span id="first_name_error" class="text-red-500 text-sm hidden"></span>
            </div>
            <div class="mb-4">
                <label for="last_name" class="block text-gray-700 font-medium mb-2">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                <span id="last_name_error" class="text-red-500 text-sm hidden"></span>
            </div>
            <div class="mb-4">
                <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                <select name="gender" id="gender" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400" required>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
                <span id="gender_error" class="text-red-500 text-sm hidden"></span>
            </div>
            <div class="mb-4">
                <label for="contact" class="block text-gray-700 font-medium mb-2">Contact</label>
                <input type="text" name="contact" id="contact" placeholder="Enter Contact Number" value="{{ old('contact') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                <span id="contact_error" class="text-red-500 text-sm hidden"></span>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                <input type="text" name="address" id="address" placeholder="Enter Address" value="{{ old('address') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                <span id="address_error" class="text-red-500 text-sm hidden"></span>
            </div>
            <div class="mt-6">
                <button id="registerBtn" type="button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-md transition">Register</button>
                <a href="/admin/studentsList" class="block mt-3 text-center bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-md transition">Back</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Open the modal
    function openAddStudentModal() {
        document.getElementById('addStudentModal').classList.remove('hidden');
    }

    // Close the modal
    function closeAddStudentModal() {
        document.getElementById('addStudentModal').classList.add('hidden');
    }

    // Clear all error messages
    function clearErrorMessages() {
        document.querySelectorAll('[id$="_error"]').forEach(element => {
            element.textContent = '';
            element.classList.add('hidden');
        });
        
        // Reset input highlighting
        document.querySelectorAll('#addStudentForm input, #addStudentForm select').forEach(element => {
            element.classList.remove('border-red-500');
        });
    }

    // Handle the form submission confirmation
    document.getElementById('registerBtn').addEventListener('click', function () {
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
                $('#addStudentForm').submit();  // This will trigger the form submit and the AJAX handler
            }
        });
    });

    // Handle the form submission via AJAX
    $(document).ready(function() {
        $('#addStudentForm').submit(function(event) {
            event.preventDefault();  // Prevent the form from submitting normally
            clearErrorMessages(); // Clear any previous error messages

            // Send the form data via AJAX
            $.ajax({
                url: '{{ route("store") }}',  // Use the correct route for storing the student
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Student Added!',
                            text: response.message,
                        }).then(() => {
                            location.reload();  // Reload the page after successful submission
                        });
                    } else if (response.status === 'error') {
                        // Handle general errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,  // Display the specific error message from the response
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
                                    errorElement.classList.remove('hidden');
                                    
                                    // Highlight the input field
                                    const inputField = document.getElementById(field);
                                    if (inputField) {
                                        inputField.classList.add('border-red-500');
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
                                document.getElementById('student_id').classList.add('border-red-500');
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