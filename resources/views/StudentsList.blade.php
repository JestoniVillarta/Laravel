<x-Navigation>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>

        <!-- Student List Table -->


        <div class="bg-white pb-4 px-4 rounded-md w-full">
            <div class="flex justify-between w-full pt-6">
                <p class="ml-3">Student List</p>

                <a href="/Add_student">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Add Student
                    </button>
                </a>

            </div>

            <div class="w-full flex justify-end px-2 mt-2">
                <div class="w-full sm:w-64 inline-block relative">
                    <input type="text" class="leading-snug border border-gray-300 block w-full appearance-none bg-gray-100 text-sm text-gray-600 py-1 px-4 pl-8 rounded-lg" placeholder="Search" />
                    <div class="pointer-events-none absolute pl-3 inset-y-0 left-0 flex items-center px-2 text-gray-300">
                        <svg class="fill-current h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M508.874 478.708L360.142 329.976c28.21-34.827 45.191-79.103 45.191-127.309C405.333 90.917 314.416 0 202.666 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c48.206 0 92.482-16.982 127.309-45.191l148.732 148.732c4.167 4.165 10.919 4.165 15.086 0l15.081-15.082c4.165-4.166 4.165-10.92-.001-15.085zM202.667 362.667c-88.229 0-160-71.771-160-160s71.771-160 160-160 160 71.771 160 160-71.771 160-160 160z" />
                        </svg>
                    </div>
                </div>

            </div>
            <div class="overflow-x-auto mt-6">

                <table class="table-auto border-collapse w-full">
                    <thead>
                        <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
                            <th class="px-4 py-2 bg-gray-200">Student ID</th>
                            <th class="px-4 py-2 bg-gray-200">First Name</th>
                            <th class="px-4 py-2 bg-gray-200">Last Name</th>
                            <th class="px-4 py-2 bg-gray-200">Gender</th>
                            <th class="px-4 py-2 bg-gray-200">Contact</th>
                            <th class="px-4 py-2 bg-gray-200">Address</th>
                            <th class="px-4 py-2 bg-gray-200">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>

        <style>
            thead tr th:first-child {
                border-top-left-radius: 10px;
                border-bottom-left-radius: 10px;
            }

            thead tr th:last-child {
                border-top-right-radius: 10px;
                border-bottom-right-radius: 10px;
            }

            tbody tr td:first-child {
                border-top-left-radius: 5px;
                border-bottom-left-radius: 0px;
            }

            tbody tr td:last-child {
                border-top-right-radius: 5px;
                border-bottom-right-radius: 0px;
            }
        </style>

    </body>

    </html>
</x-Navigation>