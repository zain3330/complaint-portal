@extends('admin.layout.layout')

<!-- Content Wrapper. Contains page content -->
@section('content-section')
    <div class="content-wrapper" style="min-height: 1302.12px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Complaints List</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Complaints</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-flex  justify-content-between  align-items-center">
                                    <!-- Filter Form -->
                                    <form method="GET" action="{{ route('complaints.index') }}" class="form-inline">
                                        <div class="form-group mr-2">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Select Complaint Status</option>
                                                <option value="In Progress">In Progress</option>
                                                <option value="Resolved">Resolved</option>
                                                <option value="Forwarded">Forwarded</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </form>
                                </div>
                                <table id="complaints-table" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                    <tr>
                                        <th>Complaint ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
{{--                                        <th>Complaint Type</th>--}}
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Actions</th> <!-- Column for actions -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($complaints as $complaint)
                                        <tr>
                                            <td>{{ $complaint->id }}</td>
                                            <td>{{ $complaint->name }}</td>
                                            <td>{{ $complaint->email }}</td>
                                            <td>{{ $complaint->department }}</td>
{{--                                            <td>{{ $complaint->complaint_type }}</td>--}}
                                            <td>{{ Str::limit($complaint->details, 50) }}</td>
                                            <td id="status-{{ $complaint->id }}">{{ $complaint->status }}</td>
                                            <td>
                                                <a href="{{ route('complaint.view', $complaint->id) }}" class="btn btn-primary btn-sm">View</a>
                                                <button class="btn btn-warning btn-sm change-status" data-id="{{ $complaint->id }}">Change Status</button>
                                                <button class="btn btn-secondary btn-sm forward-complaint" data-id="{{ $complaint->id }}">Forward</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- Modal for Changing Status -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Change Complaint Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="statusForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="complaintId" name="complaint_id">

                        <!-- Status Field -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="statusSelect" name="status" class="form-control">
                                <option value="In Progress">In Progress</option>
                                <option value="Resolved">Resolved</option>
                            </select>
                        </div>

                        <!-- Message/Comments Field (Initially Hidden) -->
                        <div class="form-group" id="commentsSection" style="display: none;">
                            <label for="comments">Comments or Message (optional)</label>
                            <textarea name="comments" class="form-control" id="comments" rows="3"></textarea>
                        </div>

                        <!-- Attachment Field (Initially Hidden) -->
                        <div class="form-group" id="attachmentSection" style="display: none;">
                            <label for="attachment">Attachment (optional)</label>
                            <input type="file" name="attachment" class="form-control" id="attachment">
                            <div class="error-message"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    //forward complaint
    <div class="modal fade" id="forwardModal" tabindex="-1" role="dialog" aria-labelledby="forwardModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forwardModalLabel">Forward Complaint</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="forwardForm">
                        @csrf
                        <input type="hidden" id="forwardComplaintId" name="complaint_id">
                        <div class="form-group">
                            <label for="resolver_id">Select User to Forward</label>
                            <select id="resolver_id" name="resolver_id" class="form-control">
                                <!-- Options will be filled by AJAX -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Forward</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Event delegation for dynamically loaded "Change Status" buttons
            $(document).on('click', '.change-status', function() {
                var complaintId = $(this).data('id');
                $('#complaintId').val(complaintId);
                $('#statusModal').modal('show');
            });

            // Show/hide resolved by field based on status
            $('#statusSelect').on('change', function() {
                if ($(this).val() === 'Resolved') {
                    $('#commentsSection').show();    // Show comments section
                    $('#attachmentSection').show();  // Show attachment section
                } else {
                    $('#commentsSection').hide();    // Hide comments section
                    $('#attachmentSection').hide();  // Hide attachment section
                }
            });

            $('#statusForm').on('submit', function(e) {
                e.preventDefault();

                // Create a FormData object to handle form data including files
                var formData = new FormData(this);

                $.ajax({
                    url: '{{ route("complaints.updateStatus") }}',
                    method: 'POST',
                    data: formData,
                    contentType: false, // Important for file uploads
                    processData: false, // Important for file uploads
                    success: function(response) {
                        if (response.success) {
                            // Update the status in the table
                            $('#status-' + response.complaint_id).text(response.status);
                            $('#statusModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 4000,
                                showConfirmButton: false
                            });
                        } else {
                            // Show the message if the complaint is already resolved or forwarded
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                timer: 4000,
                                showConfirmButton: false
                            });
                            $.each(response.errors, function(field, messages) {
                                messages.forEach(function(message) {
                                    $('#' + field + 'Section').append('<div class="error-message text-danger">' + message + '</div>');
                                });
                            });
                        }
                    },
                    error: function(xhr) {
                        // Log the full error response for debugging
                        console.error('AJAX Error:', xhr);

                        // Show a more detailed alert based on the response
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            alert('Error: ' + xhr.responseJSON.message);
                        } else {
                            alert('An error occurred while updating the status.');
                        }
                    }
                });
            });

            // Initialize DataTable
            $('#complaints-table').DataTable({
                dom: 'Bfrtip',
                buttons: []
            });
            $('#forwardForm').submit(function (e) {
                e.preventDefault(); // Prevent default form submission

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('complaints.forward') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.success) {
                            var complaintId = $('#forwardComplaintId').val();
                            $('#status-' + complaintId).text('Forwarded');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                timer: 4000,
                                showConfirmButton: false
                            });

                            $('#forwardModal').modal('hide');

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                timer: 4000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function (xhr) {
                        // Log the actual error response for debugging
                        console.log(xhr.responseText);
                        try {
                            var jsonResponse = JSON.parse(xhr.responseText);
                            alert(jsonResponse.message || 'An error occurred. Please try again.'); // Show specific error message
                        } catch (e) {
                            alert('An unexpected error occurred. Please try again.'); // Fallback for non-JSON errors
                        }
                    }
                });
            });
        });

        $('.forward-complaint').on('click', function() {
            var complaintId = $(this).data('id');
            $('#forwardComplaintId').val(complaintId)

            // Fetch and populate user list via AJAX
            $.ajax({
                url: '{{ route("complaints.getUsers") }}', // Route to get the list of users
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        var users = response.users;
                        var options = '';
                        users.forEach(function(user) {
                            options += '<option value="' + user.id + '">' + user.name + '</option>';
                        });
                        $('#resolver_id').html(options);
                    }
                    $('#forwardModal').modal('show');
                }
            });
        });
        // Forward request

    </script>
@endsection
