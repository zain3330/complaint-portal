@extends('frontend.layout.layout')
<!-- Content Wrapper. Contains page content -->
@section('content-section-frontend')
    <body class="bg-white">
    <div class="main-container bg-white">
        <div role="main" class="main-content">
            <div class="page-content p-0">
                <div class="bg-white pt-5">
                    <div class="container mx-auto relative -mt-5 py-2">
                            <form method="POST" id="complaint-form" enctype="multipart/form-data" action="{{ route('complaint.store') }}" novalidate>
                                @csrf
                                <div class="col-span-12">
                                    <div class="p-4 md:p-8 lg:p-12 xl:p-16">
                                        <div class="flex flex-wrap -mx-4 fade-right">
                                            <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0 text-center">
                                                <img class="mx-auto mb-4" src="https://complaints.nadra.gov.pk/img/launch_complaint.png" alt="New Complaint">
                                                <h3 class="text-2xl font-bold mb-2">New Complaint</h3>
                                                <h5 class="text-gray-600 mb-5">Please provide your contact details and complaint message</h5>
                                                <a class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" href="{{route('complaint.statusForm')}}">Track Complaint Status</a>
                                            </div>
                                            <div class="w-full lg:w-2/3 px-4">
                                                <h3 class="text-2xl font-bold mb-6">Enter Your Information Below</h3>

                                                <!-- Full Name -->
                                                <div class="mb-4">
                                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Full Name / <span lang="ur">پورا نام</span></label>
                                                    <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                </div>

                                                <!-- Email Field -->
                                                <div class="mb-4">
                                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                                    <div class="flex">
                                                        <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
{{--                                                        <button type="button" id="sendCode" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded ml-2">Verify Email</button>--}}
                                                    </div>
{{--                                                    <small id="emailStatus" class="text-gray-600 mt-2 block">A verification code will be sent to this email.</small>--}}
                                                </div>

                                                <!-- Code Verification Field (Initially Hidden) -->
                                                <div class="mb-4" id="codeVerificationField" style="display:none;">
                                                    <label for="verificationCode" class="block text-gray-700 text-sm font-bold mb-2">Enter Verification Code</label>
                                                    <input type="text" id="verificationCode" name="verificationCode" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                    <button type="button" id="verifyCode" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-2">Verify Code</button>
                                                    <small id="verificationStatus" class="text-red-500 mt-2"></small>
                                                </div>


                                                <!-- Department -->
                                                <div class="mb-4">
                                                    <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Department / <span lang="ur">محکمہ</span></label>
                                                    <select id="department" name="department" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                                        <option value="" disabled selected>Select Department</option>
                                                        <option value="HR">Human Resources</option>
                                                        <option value="IT">Information Technology</option>
                                                        <option value="Finance">Finance</option>
                                                        <option value="Marketing">Marketing</option>
                                                        <option value="Operations">Operations</option>
                                                    </select>
                                                </div>

                                                <!-- Complaint Detail -->
                                                <div class="mb-4">
                                                    <label for="details" class="block text-gray-700 text-sm font-bold mb-2">Complaint Detail / <span lang="ur">شکایت کی تفصیل</span></label>
                                                    <textarea id="details" name="details" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="mb-6">
                                                    <button type="submit" id="submitComplaint" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                                                        Submit Complaint
                                                    </button>
                                                </div>
                                                <div id="messageContainer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
