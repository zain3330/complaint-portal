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
{{--                                <dd>{{ $complaint->status ? 'Resolved' : 'Pending' }}</dd>--}}
                            </div>
                            <div class="col-sm-6">
                                <dt>Details:</dt>
                                <dd>{{ $complaint->details }}</dd>

                                <dt>Date Submitted:</dt>
                                <dd>{{ $complaint->created_at->format('d-m-Y') }}</dd>



{{--                                <dt>IP Address:</dt>--}}
{{--                                <dd>{{ $complaint->ip_address }}</dd>--}}
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection
