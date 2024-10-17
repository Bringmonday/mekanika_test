
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Mekanika Digital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/B/assets/images/mekanika.png">
        <!-- plugin css -->
        <link href="/B/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="/B/assets/css/preloader.min.css" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="/B/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/B/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/B/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />   
        <!-- jQuery -->
        <script src="/B/assets/libs/jquery/jquery.min.js"></script>
        <!-- DataTables JS -->
        <script src="/B/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="/B/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/B/assets/js/pages/datatables.init.js"></script>

        <!-- DataTables Template -->
        <link href="/B/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="/B/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Required datatable js -->
        <script src="/B/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="/B/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="/B/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="/B/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="/B/assets/libs/jszip/jszip.min.js"></script>
        <script src="/B/assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="/B/assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="/B/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="/B/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="/B/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <!-- Responsive examples -->
        <script src="/B/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/B/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Font Awesom -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <!-- Sweet Alert -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('include.navbar')
            @include('include.sidebar')
            @include('include.footer')
            <div class="main-content">
                @yield('content')
                @yield('style')
                @yield('scripts')
            </div>
            <!-- end main content-->
        </div>
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="/B/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/B/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/B/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/B/assets/libs/node-waves/waves.min.js"></script>
        <script src="/B/assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="/B/assets/libs/pace-js/pace.min.js"></script>

        
        <!-- apexcharts -->
        <script src="/B/assets/libs/apexcharts/apexcharts.min.js"></script>
        <script src="/B/assets/js/pages/apexcharts.init.js"></script>

        <!-- Plugins js-->
        <script src="/B/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/B/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

        <script src="/B/assets/js/pages/allchart.js"></script>
        <!-- dashboard init -->
        <script src="/B/assets/js/pages/dashboard.init.js"></script>

        <!-- echarts js -->
        <script src="/B/assets/libs/echarts/echarts.min.js"></script>
        <script src="/B/assets/js/pages/allchart.js"></script>
        
        <!-- echarts init -->
        <script src="/B/assets/js/pages/echarts.init.js"></script>

        <!-- App js -->
        <script src="/B/assets/js/app.js"></script>

        

    </body>

</html>