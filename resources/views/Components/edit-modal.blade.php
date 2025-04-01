<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg p-8 w-96">

        <h2 class="text-xl font-semibold mb-4">Edit Student Record</h2>
        <form id="editForm" action="{{ url('/admin/student/update') }}" method="POST">
            @csrf
            <input type="hidden" id="editStudentId" name="id">

            <div class="mb-4">
                <label for="editStudentIdInput" class="block text-sm font-semibold text-gray-700">Student ID</label>
                <input type="text" id="editStudentIdInput" name="student_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" readonly>
            </div>

            <div class="mb-4">
                <label for="editFirstName" class="block text-sm font-semibold text-gray-700">First Name</label>
                <input type="text" id="editFirstName" name="first_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="editLastName" class="block text-sm font-semibold text-gray-700">Last Name</label>
                <input type="text" id="editLastName" name="last_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="editGender" class="block text-sm font-semibold text-gray-700">Gender</label>
                <select id="editGender" name="gender" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="editContact" class="block text-sm font-semibold text-gray-700">Contact</label>
                <input type="text" id="editContact" name="contact" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="editAddress" class="block text-sm font-semibold text-gray-700">Address</label>
                <textarea id="editAddress" name="address" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md"></textarea>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" class="px-6 py-2 text-sm font-semibold bg-gray-500 text-white rounded-md" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="px-6 py-2 text-sm font-semibold bg-blue-500 text-white rounded-md">Save Changes</button>
            </div>
        </form>
    </div>
</div>
