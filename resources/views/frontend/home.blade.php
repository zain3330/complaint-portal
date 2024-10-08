@extends('frontend.layout.layout')
<!-- Content Wrapper. Contains page content -->
@section('content-section-frontend')
    <div class="content container mx-auto px-6 py-16 flex flex-col md:flex-row  items-center fade-right">
        <div class="md:w-1/2 flex flex-col items-start justify-center ">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">NUR International University<br>Customer Support</h1>
            <p class="text-gray-600 mb-8">NUR International University's online support system offers comprehensive assistance, advanced reporting features, and a platform for collaborative solutions, ensuring immediate feedback for students and faculty.</p>

            <div class="flex flex-col sm:flex-row ">
                <a href="{{route('complaint.register')}}" class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg mb-4 sm:mb-0 sm:mr-4 hover:bg-green-900 transition duration-300">Register Complaint</a>
                <a href="{{route('complaint.statusForm')}}" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-900 transition duration-300">Complaint Status</a>
            </div>
        </div>
        <div class="md:w-1/2 mt-8 md:mt-0">
            <img src="https://complaints.nadra.gov.pk/img/form_imgae.png" alt="Complaint Form" class="w-full h-auto rounded-lg shadow-lg">
        </div>
    </div>
@endsection
    {{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>NADRA Customer Care</title>--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>--}}

{{--    <script>--}}
{{--        AOS.init();--}}
{{--    </script>--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: 'Roboto', sans-serif;--}}
{{--            display: flex;--}}
{{--            flex-direction: column;--}}
{{--            min-height: 100vh; /* Ensures the body covers full viewport height */--}}
{{--        }--}}
{{--        .content {--}}
{{--            flex: 1; /* Allows content to grow and take available space */--}}
{{--        }--}}
{{--        @keyframes fadeRight {--}}
{{--            0% {--}}
{{--                opacity: 0;--}}
{{--                transform: translateX(-80px);--}}
{{--            }--}}
{{--            100% {--}}
{{--                opacity: 1;--}}
{{--                transform: translateX(0);--}}
{{--            }--}}
{{--        }--}}

{{--        .fade-right {--}}
{{--            animation: fadeRight 1s ease-out;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body class="bg-gray-100">--}}
{{--<nav class="bg-[#348C4B] shadow-md">--}}
{{--    <div class="container mx-auto px-6 py-6 flex justify-between items-center">--}}
{{--        <div class="flex items-center">--}}
{{--            <img src="https://www.niu.edu.pk/wp-content/uploads/2024/09/NIU-Logo-h-w.png" alt="NADRA Care Logo" class="h-16">--}}
{{--        </div>--}}
{{--        <div class="flex items-center space-x-4">--}}
{{--            <a href="/NewComplaint" class="text-white text-sm font-semibold hover:white-500 px-6 py-3 ">REGISTER COMPLAINT</a>--}}
{{--            <a href="/Track" class="text-white text-sm font-semibold bg-blue-600 px-6 py-3 rounded-full hover:bg-blue-900">COMPLAINT STATUS</a>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</nav>--}}

{{--<div class="content container mx-auto px-6 py-16 flex flex-col md:flex-row  items-center fade-right">--}}
{{--    <div class="md:w-1/2 flex flex-col items-start justify-center ">--}}
{{--        <h1 class="text-4xl font-bold text-gray-800 mb-4">NUR International University<br>Customer Support</h1>--}}
{{--        <p class="text-gray-600 mb-8">NUR International University's online support system offers comprehensive assistance, advanced reporting features, and a platform for collaborative solutions, ensuring immediate feedback for students and faculty.</p>--}}

{{--        <div class="flex flex-col sm:flex-row ">--}}
{{--            <a href="#" class="bg-green-600 text-white font-bold py-3 px-6 rounded-lg mb-4 sm:mb-0 sm:mr-4 hover:bg-green-900 transition duration-300">Register Complaint</a>--}}
{{--            <a href="#" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-900 transition duration-300">Complaint Status</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="md:w-1/2 mt-8 md:mt-0">--}}
{{--        <img src="https://complaints.nadra.gov.pk/img/form_imgae.png" alt="Complaint Form" class="w-full h-auto rounded-lg shadow-lg">--}}
{{--    </div>--}}
{{--</div>--}}

{{--<footer class="bg-gray-200 py-4">--}}
{{--    <div class="container mx-auto px-6 text-center">--}}
{{--        <p class="text-gray-600 text-sm">--}}
{{--            Copyright © 2024 <a href="https://www.nadra.gov.pk" class="text-blue-600 hover:underline">NIU</a>--}}
{{--        </p>--}}
{{--    </div>--}}
{{--</footer>--}}
{{--</body>--}}
{{--</html>--}}





{{--    <!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <title>NUR International University - Register Complaint</title>--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: 'Roboto', sans-serif;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body class="bg-gray-100">--}}
{{--<nav class="bg-white shadow-md">--}}
{{--    <div class="container mx-auto px-6 py-3 flex justify-between items-center">--}}
{{--        <div class="flex items-center">--}}
{{--            <img src="/placeholder.svg?height=40&width=120" alt="NUR University Logo" class="h-10">--}}
{{--        </div>--}}
{{--        <div class="flex items-center">--}}
{{--            <a href="#" class="text-gray-800 text-sm font-semibold hover:text-green-600 mr-4">REGISTER COMPLAINT</a>--}}
{{--            <a href="#" class="text-white text-sm font-semibold bg-blue-600 px-4 py-2 rounded-full hover:bg-blue-700">COMPLAINT STATUS</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

{{--<div class="container mx-auto px-4 py-8">--}}
{{--    <h1 class="text-3xl font-bold text-center mb-8">Register Complaint</h1>--}}

{{--    <div class="bg-white rounded-lg shadow-md p-6 md:p-8">--}}
{{--        <div class="flex flex-col md:flex-row">--}}
{{--            <div class="md:w-1/3 mb-6 md:mb-0">--}}
{{--                <img src="/placeholder.svg?height=200&width=200" alt="New Complaint" class="mx-auto mb-4">--}}
{{--                <h2 class="text-xl font-semibold text-center mb-2">New Complaint</h2>--}}
{{--                <p class="text-center text-gray-600 mb-4">Please provide your contact details and complaint message</p>--}}
{{--                <a href="#" class="block text-center bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-300">Track Complaint Status</a>--}}
{{--            </div>--}}

{{--            <div class="md:w-2/3 md:pl-8">--}}
{{--                <h3 class="text-lg font-semibold mb-2">ENTER YOUR INFORMATION BELOW</h3>--}}
{{--                <p class="text-red-500 mb-4">*Required Entry</p>--}}

{{--                <form id="complaint-form" method="post" enctype="multipart/form-data" action="/NewComplaint/Create">--}}
{{--                    <div class="space-y-4">--}}
{{--                        <div>--}}
{{--                            <label for="COMPLAINANT_NAME" class="block mb-2">FULL NAME / <span lang="ur">پورا نام</span></label>--}}
{{--                            <input type="text" id="COMPLAINANT_NAME" name="COMPLAINANT_NAME" class="w-full px-3 py-2 border rounded-md" required maxlength="128">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="STUDENT_ID" class="block mb-2">STUDENT ID</label>--}}
{{--                            <input type="text" id="STUDENT_ID" name="STUDENT_ID" class="w-full px-3 py-2 border rounded-md">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="EMAIL" class="block mb-2">EMAIL</label>--}}
{{--                            <input type="email" id="EMAIL" name="EMAIL" class="w-full px-3 py-2 border rounded-md" maxlength="32">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="CONTACT_NUMBER" class="block mb-2">CONTACT NUMBER</label>--}}
{{--                            <input type="tel" id="CONTACT_NUMBER" name="CONTACT_NUMBER" class="w-full px-3 py-2 border rounded-md" required maxlength="16">--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="CATEGORY" class="block mb-2">CATEGORY</label>--}}
{{--                            <select id="CATEGORY" name="CATEGORY" class="w-full px-3 py-2 border rounded-md" required>--}}
{{--                                <option value="">Select Category</option>--}}
{{--                                <option value="academic">Academic</option>--}}
{{--                                <option value="financial">Financial</option>--}}
{{--                                <option value="facilities">Facilities</option>--}}
{{--                                <option value="other">Other</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="COMPLAINT_DETAIL" class="block mb-2">COMPLAINT DETAIL</label>--}}
{{--                            <textarea id="COMPLAINT_DETAIL" name="COMPLAINT_DETAIL" rows="4" class="w-full px-3 py-2 border rounded-md" required maxlength="1024"></textarea>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <h4 class="font-semibold mb-2">Attachment Guidelines</h4>--}}
{{--                            <ul class="list-disc pl-5 text-sm text-gray-600">--}}
{{--                                <li>Only images are allowed as attachments</li>--}}
{{--                                <li>Attachments size must not exceed 2MB</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <label for="ATTACHMENT" class="block mb-2">Click or drop file here to add an attachment</label>--}}
{{--                            <input type="file" id="ATTACHMENT" name="ATTACHMENT" accept="image/*" class="w-full px-3 py-2 border border-dashed border-gray-300 rounded-md">--}}
{{--                        </div>--}}

{{--                        <div id="captcha" class="h-captcha"></div>--}}

{{--                        <div class="text-center">--}}
{{--                            <button type="submit" class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-green-600 transition duration-300">SUBMIT COMPLAINT</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<footer class="bg-gray-200 py-4 mt-8">--}}
{{--    <div class="container mx-auto px-6 text-center">--}}
{{--        <p class="text-gray-600 text-sm">--}}
{{--            Copyright © 2024 <a href="https://www.nur.edu.pk" class="text-blue-600 hover:underline">NUR International University</a>--}}
{{--        </p>--}}
{{--    </div>--}}
{{--</footer>--}}

{{--<script src="https://js.hcaptcha.com/1/api.js" async defer></script>--}}
{{--</body>--}}
{{--</html>--}}
