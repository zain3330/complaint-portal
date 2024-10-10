@extends('frontend.layout.layout')
<!-- Content Wrapper. Contains page content -->
@section('content-section-frontend')
    <body class="bg-white">
    <div class="main-container bg-white">
        <div role="main" class="main-content">
            <div class="page-content p-0">
                <div class="bg-white pt-5">
                    <div class="container mx-auto relative -mt-5 py-2">
                        <form method="POST" id="status-form" enctype="multipart/form-data" action="{{ route('complaint.checkStatus') }}" novalidate>
                            @csrf
                            <div class="col-span-12">
                                <div class="p-4 md:p-8 lg:p-12 xl:p-16">
                                    <div class="flex flex-wrap -mx-4 fade-right">
                                        <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0 text-center">
                                            <img class="mx-auto mb-4" src="https://complaints.nadra.gov.pk/img/track_complaint.png" alt="New Complaint">
                                            <h3 class="text-2xl font-bold mb-2">Track Complaint</h3>
                                            <h5 class="text-gray-600 mb-5">Please provide your Complaint Number or Email</h5>
                                        </div>
                                        <div class="w-full lg:w-2/3 px-4">
                                            <h3 class="text-2xl font-bold mb-6">Enter Your Information Below</h3>

                                            <!-- Single Input Field for Complaint Number or Email -->
                                            <div class="mb-4">
                                                <label for="complaintInfo" class="block text-gray-700 text-sm font-bold mb-2">Complaint Number or Email</label>
                                                <input type="text" id="complaintInfo" name="complaintInfo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="mb-6">
                                                <button type="submit" id="submitComplaint" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline sm:w-full md:w-[8rem] lg:w-[8rem] xl:w-40">
                                                    Track Complaint
                                                </button>

                                            </div>

                                            <!-- Status Message Container -->
                                            <div id="statusMessageContainer"></div>
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
