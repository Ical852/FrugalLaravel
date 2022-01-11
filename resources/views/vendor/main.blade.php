<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Frugal</title>
    <!-- plugins:css -->
    <link rel="icon" href="{{ asset('admin/images/logo/android-icon-192x192.png') }}" rel="icon" type="image/png"
        sizes="192x192">
    <link rel="shortcut icon" href="{{ asset('admin/images/logo/android-icon-192x192.png') }}" rel="icon"
        type="image/png" sizes="192x192">
    <link rel="stylesheet" href="{{ asset('vendor/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendor/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('vendor/css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/vendor.css') }}">
    <!-- endinject -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
    <div class="container-scroller">

        @include('vendor/header')

        <div class="container-fluid page-body-wrapper">

            @include('vendor/sidebar')
            
            <div class="main-panel">

                @yield('content')

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.
                            All rights
                            reserved.</span>
                    </div>
                </footer>

            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('vendor/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendor/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendor/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('vendor/js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('vendor/js/off-canvas.js') }}"></script>
    <script src="{{ asset('vendor/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('vendor/js/template.js') }}"></script>
    <script src="{{ asset('vendor/js/settings.js') }}"></script>
    <script src="{{ asset('vendor/js/todolist.js') }}"></script>
    <script src="{{ asset('vendor/js/file-upload.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('vendor/js/dashboard.js') }}"></script>
    <script src="{{ asset('vendor/js/Chart.roundedBarCharts.js') }}"></script>
    <script src="{{ asset('vendor/jQuery/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('vendor/jQuery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/jQuery/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/vendors/ckeditor/ckeditor.js') }}"></script>
    <!-- panggil adapter jquery ckeditor -->
    <script type="text/javascript" src="{{ asset('vendor/vendors/ckeditor/adapters/jquery.js') }}"></script>
    <!-- End custom js for this page-->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $('textarea.texteditor').ckeditor();
    </script>
</body>

</html>