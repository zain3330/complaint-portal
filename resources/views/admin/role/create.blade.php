@extends('admin.layout.layout')

<!-- Content Wrapper. Contains page content -->
@section('content-section')
    <div class="content-wrapper" style="min-height: 1345.31px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Role</h1>
                    </div>
                    {{--                    <div class="col-sm-6">--}}
                    {{--                        <ol class="breadcrumb float-sm-right">--}}
                    {{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--                            <li class="breadcrumb-item active">General Form</li>--}}
                    {{--                        </ol>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add Role</h3>
                            </div>

                            <form action="{{ route('role.store') }}" method="POST" id="jobForm">
                                @csrf
                                <div class="card-body">
                                    <!-- Role -->
                                    <div class="form-group">
                                        <label for="name">Role*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter role" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

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
                        </div>
                    </div>
                </div>
            </div>
        </section>



    </div>

@endsection

