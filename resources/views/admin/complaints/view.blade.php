@extends('admin.layout.layout')

@section('css')
    <style>
        .bordered {
            margin-bottom: 20px;
            border-radius: 4px;
            background-color: #343a40; /* Dark background color */
        }
        .bordered dt, .bordered dd {
            border: 1px solid #495057; /* Darker border color */
            padding: 8px;
        }
        .bordered dt {
            font-weight: bold;
            color: #f8f9fa; /* Light text color for dt */
        }
        .bordered dd {
            margin-bottom: 0;
            background-color: #495057; /* Darker background for dd */
            color: #f8f9fa; /* Light text color for dd */
        }
    </style>
@endsection

@section('content-section')
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Complaint Details</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Complaint Details -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Complaint Details</h3>
                            </div>
                            <div class="card-body">
                                <!-- Complaint Details -->
                                <dl class="row bordered">
                                    <div class="col-sm-6">
                                        <dt>Complainant Name:</dt>
                                        <dd>{{ $complaint->name }}</dd>

                                        <dt>Email:</dt>
                                        <dd>{{ $complaint->email }}</dd>

                                        <dt>Department:</dt>
                                        <dd>{{ $complaint->department }}</dd>

                                        <dt>Complaint Type:</dt>
                                        <dd>{{ $complaint->complaint_type }}</dd>

                                        <dt>Status:</dt>
                                        <dd>{{ $complaint->status }}</dd>
                                    </div>
                                    <div class="col-sm-6">
                                        <dt>Details:</dt>
                                        <dd>{{ $complaint->details }}</dd>

                                        <dt>Date Submitted:</dt>
                                        <dd>{{ $complaint->created_at->format('d-m-Y') }}</dd>
                                    </div>
                                </dl>

                                <!-- Forward History Section -->
                                @if($complaint->status == 'Forwarded')
                                    <div class="bordered">
                                        <h4>Forward History</h4>
                                        <ul>
                                            @php
                                                $forwardHistory = json_decode($complaint->forward_history, true) ?? [];
                                            @endphp
                                            @forelse ($forwardHistory as $forward)
                                                <li>From {{ $forward['from'] }} to {{ $forward['to'] }} on {{ $forward['forwarded_at'] }}</li>
                                            @empty
                                                <li>No forward history available.</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                @endif

                                <!-- Resolved Information Section -->
                                @if($complaint->status == 'Resolved')
                                    <div class="bordered">
                                        <h4>Resolved Information</h4>
                                        <dl class="row">
                                            <div class="col-sm-12">
                                                <!-- Display resolver's name -->
                                                <dt>Resolved By:</dt>
                                                <dd>{{ $complaint->resolver ? $complaint->resolver->name : 'Unknown' }}</dd>

                                                <!-- Display comments -->
                                                <dt>Comments:</dt>
                                                <dd>{{ $complaint->comments ?? 'No comments provided' }}</dd>

                                                <!-- Display attachment if exists -->
                                                @if($complaint->attachment)
                                                    <dt>Attachment:</dt>
                                                    <dd>
                                                        <a href="{{ asset('attachments/' . $complaint->attachment) }}" target="_blank">View Attachment</a>
                                                    </dd>
                                                @endif
                                            </div>
                                        </dl>
                                    </div>
                                @endif

                                <!-- In Progress Section -->
                                @if($complaint->status == 'In Progress')
                                    <div class="bordered">
                                        <h4>Status: In Progress</h4>
                                        <p>This complaint is currently being worked on. Please check back later for updates.</p>
                                    </div>
                                @endif
                                <!-- Users Who Can See This Complaint Section -->
                                <div class="bordered">
                                    <h4>Users Who Can View This Complaint</h4>
                                    <ul>
                                        @php
                                            // Assuming you passed the $users variable from the controller which holds users who can view
                                            $authUserDepartments = auth()->user()->departments->pluck('name')->toArray();
                                        @endphp
                                        @foreach($users as $user)
                                            @if(in_array($user->role->name, ['Super Admin', 'Admin']) || in_array($complaint->department, $user->departments->pluck('name')->toArray()) || $complaint->resolver_id === $user->id)
                                                <li>{{ $user->name }} </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
