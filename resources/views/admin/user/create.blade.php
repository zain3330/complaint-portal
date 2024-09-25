@extends('admin.layout.layout')

<!-- Content Wrapper. Contains page content -->
@section('content-section')
    <div class="content-wrapper" style="min-height: 1345.31px;">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add User</h1>
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
                                <h3 class="card-title">Add User</h3>
                            </div>
                            <form action="{{ route('users.store') }}" method="POST" id="userForm">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">User Name*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email*</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="off">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password*</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password*</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role_id">Role*</label>
                                        <select class="form-control @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                                            <option value="">Select a Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="department_id">Department*</label>
                                        <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required>
                                            <option value="">Select a Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection

