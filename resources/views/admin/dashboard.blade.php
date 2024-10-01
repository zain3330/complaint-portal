@extends('admin.layout.layout')
<!-- Content Wrapper. Contains page content -->
@section('content-section')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard </h1>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- Total Departments -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-building"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Departments</span>
                                <span class="info-box-number">{{ $departments }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Total Complaints -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-exclamation-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Complaints</span>
                                <span class="info-box-number">{{ $totalComplaints }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- In Process Complaints -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-spinner"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">In Process Complaints</span>
                                <span class="info-box-number">{{ $inProcessComplaints }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Resolved Complaints -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Resolved Complaints</span>
                                <span class="info-box-number">{{ $resolvedComplaints }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Forwarded Complaints -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-arrow-right"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Forwarded Complaints</span>
                                <span class="info-box-number">{{ $forwardedComplaints }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>


        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
