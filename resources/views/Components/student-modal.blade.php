<!-- Add Student Modal -->
<div id="addStudentModal" class="fixed inset-0 hidden bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
        <div class="pb-4 flex justify-between">
            <h2 class="text-lg font-semibold">Register Student</h2>
            <button onclick="closeAddStudentModal()" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>




        <form action="{{ route('store') }}" method="post">
            @csrf
                <div class="mb-4">
                    <label for="student_id"   class="block text-gray-700 font-medium mb-2">Student ID</label>
                    <input type="text" name="student_id" id="student_id" placeholder="Enter Student ID" value="{{ old('student_id') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                @if ($errors->any())
        <div class="alert alert-danger text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 font-medium mb-2">First Name</label>
                    <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="{{ old('first_name') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 font-medium mb-2">Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" value="{{ old('last_name') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-gray-700 font-medium mb-2">Gender</label>
                    <select name="gender" id="gender" value="{{ old('gender') }}" class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400" required>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="contact" class="block text-gray-700 font-medium mb-2">Contact</label>
                    <input type="text" name="contact" id="contact" placeholder="Enter Contact Number" value="{{ old('contact') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                    <input type="text" name="address" id="address" placeholder="Enter Address" value="{{ old('address') }}" required class="w-full border rounded-md p-3 outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <div class="mt-6">
                    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-md transition" type="submit">Register</button>
                    <a href="/admin/studentsList" class="block mt-3 text-center bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 rounded-md transition">Back</a>
                </div>
            </form>
    </div>
</div>

<script>
    function openAddStudentModal() {
        document.getElementById('addStudentModal').classList.remove('hidden');
    }

    function closeAddStudentModal() {
        document.getElementById('addStudentModal').classList.add('hidden');
    }
</script>




