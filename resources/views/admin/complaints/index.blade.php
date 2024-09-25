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
                                <table id="complaints-table" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                    <tr>
                                        <th>Complaint ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Complaint Type</th>
                                        <th>Details</th>
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
                                            <td>{{ $complaint->complaint_type }}</td>
                                            <td>{{ Str::limit($complaint->details, 50) }}</td>
                                            <td>
                                                <a href="{{ route('complaint.view', $complaint->id) }}" class="btn btn-primary btn-sm">View</a>




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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#complaints-table').DataTable({
                dom: 'Bfrtip',
                buttons: []
            });
        });
    </script>
@endsection
