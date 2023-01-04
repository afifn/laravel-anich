<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; Anich</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">

    <link rel="stylesheet" href="{{ asset('stisla/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @stack('css')

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            @include('admin.layouts.navbar')

            @include('admin.layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title')</h1>
                        @yield('breadcrumbs')
                    </div>

                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
            </div>

            @yield('modal')

            @include('admin.layouts.footer')

        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('stisla/assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('stisla/stisla/assets/modules/popper.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

        <!-- JS Libraies -->
        <script src="{{ asset('stisla/assets/modules/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/chart.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/summernote/summernote-bs4.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('stisla/assets/js/page/index.js') }}"></script>

        <!-- Template JS File -->
        <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
        <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

        <!-- JS Table -->
        <script src="{{ asset('stisla/assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
        </script>
        <script src="{{ asset('stisla/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('stisla/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

        <script src="{{ asset('stisla/assets/js/page/modules-datatables.js') }}"></script>
        @stack('js')
</body>

</html>
