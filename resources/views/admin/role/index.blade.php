@extends('admin.layout.layout')

<!-- Content Wrapper. Contains page content -->
@section('content-section')
    <div class="content-wrapper" style="min-height: 1302.12px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Roles List</h1>
                    </div>

                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">  <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Roles</h3>
                                @php
                                    $authUserRole = auth()->user()->role ? auth()->user()->role->name : null;
                                @endphp

                                @if(in_array($authUserRole, ['Super Admin', 'Admin']))
                                    <a href="{{ route('create-role') }}" class="btn btn-success ml-auto">Add Role</a>
                                @endif

                            </div>
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger mt-3">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <table id="jobs-table" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Actions</th> <!-- New column for action buttons -->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td>
{{--                                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary btn-sm">View</a>--}}
                                                @php
                                                    $authUserRole = auth()->user()->role ? auth()->user()->role->name : null;
                                                @endphp
                                                @if(in_array($authUserRole, ['Super Admin', 'Admin']))

                                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                @endif
                                                <form action="{{ route('role.destroy', $role->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    @php
                                                        $authUserRole = auth()->user()->role ? auth()->user()->role->name : null;
                                                    @endphp
                                                    @if(in_array($authUserRole, ['Super Admin', 'Admin']))

                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    @endif
                                                </form>
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

@section('script') <script>
    $(document).ready(function() {
        $('#jobs-table').DataTable({      dom: 'Bfrtip',
            buttons: [

            ]
        });
    });
</script>


@endsection
