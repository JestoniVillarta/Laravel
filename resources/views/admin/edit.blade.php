{{-- <!-- Edit Modal -->
<div id="editModal-{{ $student->id }}" class="fixed inset-0 hidden bg-gray-600 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-4xl">
        <div class="pb-4 flex justify-between">
            <h2 class="text-lg font-semibold">Edit Student</h2>
            <button onclick="closeModal('{{ $student->id }}')" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <form action="{{ url('admin/' . $student->id . '/edit') }}" method="POST">
            @method('PUT')
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="student_id-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Student ID</label>
                    <input type="text" name="student_id" id="student_id-{{ $student->id }}" value="{{ $student->student_id }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="first_name-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" id="first_name-{{ $student->id }}" value="{{ $student->first_name }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="last_name-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" id="last_name-{{ $student->id }}" value="{{ $student->last_name }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="gender-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                    <select name="gender" id="gender-{{ $student->id }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div>
                    <label for="contact-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Contact</label>
                    <input type="text" name="contact" id="contact-{{ $student->id }}" value="{{ $student->contact }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="address-{{ $student->id }}" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" id="address-{{ $student->id }}" value="{{ $student->address }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button type="button" onclick="closeModal('{{ $student->id }}')" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">Cancel</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">Update Student</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript for Modal -->
<script>
    function openModal(id) {
        document.getElementById(`editModal-${id}`).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(`editModal-${id}`).classList.add('hidden');
    }
</script>



 --}}
