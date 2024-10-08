<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .dataTables_wrapper {
            min-height: 400px; /* Adjust the min-height as needed */
        }

              Change the selected text color of the multi-select
         #department_id option:checked {
             color: blue; /* Change this to your desired color */
         }
        .select2-selection__choice {
            color: white !important; /* Change to your desired color */
            background-color: #0074f0!important; /* Optional: Change background color if needed */
        }
        .select2-selection select2-selection--multiple {
            color: blue !important; /* Change to your desired color */
        }


    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Portal Website</title>
    <link rel="icon" href="https://www.niu.edu.pk/wp-content/uploads/2020/09/favi.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{url('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin/css/adminlte.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('css')

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    {{--    <div class="preloader flex-column justify-content-center align-items-center">--}}
    {{--        <img class="animation__wobble" src="{{url('admin/images/AdminLTELogo.png')}}" alt="AdminLTELogo"--}}
    {{--             height="60" width="60">--}}
    {{--    </div>--}}

    @include('admin.layout.header')

    @include('admin.layout.sidebar')

    @yield('content-section')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    @include('admin.layout.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{url('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('admin/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{url('admin/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{url('admin/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{url('admin/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{url('admin/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('admin/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{url('admin/js/demo.js')}}"></script>
<!-- AdminLTE admin demo (This is only for demo purposes) -->
<script src="{{url('admin/js/pages/dashboard2.js')}}"></script>

<!-- DataTables & Plugins -->
<script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Select2 JS -->
<script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select Departments',
            allowClear: true // Allows user to clear selections
        });
    });
</script>


<!-- Initialize DataTables -->

@yield('script')
</body>
</html>
