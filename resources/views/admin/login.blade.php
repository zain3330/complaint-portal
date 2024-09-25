@extends('admin.layout.layout-login')
<!-- Content Wrapper. Contains page content -->
@section('content-section')
    <body class="login-page" style="min-height: 496.781px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Complaint-Portal</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Error message below input field -->
                        @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Error message below input field -->
                        @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Remember Me and Sign In Button -->
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <!-- Error and Success Messages -->
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
    </body>
@endsection
