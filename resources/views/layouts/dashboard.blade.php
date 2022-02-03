<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <script src="js/jquery.min.js"></script>
    <script src="js/nprogress.js"></script>
    <script src="{{ asset('js/bookings.js') }}" defer></script>
    <script src="{{ asset('js/invoice.js') }}" defer></script>
    <script src="{{ asset('js/registerBedroom.js') }}" defer></script>
    <script src="{{ asset('js/checkin.js') }}" defer></script>
    <script src="{{ asset('js/order.js') }}" defer></script>
    <script src="{{ asset('js/report.js') }}" defer></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />




    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // NProgress.start();
    </script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]

        -->


</head>
<body class="nav-md">

    <script>
        $(document).ready(function()
        {
           // $(".bs-report-modal-lg").modal("show");
        });
    </script>
    @include('dashboard.sections.modal_invoice')
    @include('dashboard.sections.modal_bedrooms')
    @include('dashboard.sections.modal_booking')
    @include('dashboard.sections.modal_checkin')
    @include('dashboard.sections.modal_order')
    @include('dashboard.sections.modal_report')
    @yield('content')
</body>

</html>
