<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="{{asset('assets/img/favicon.ico')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SysCob</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/light-bootstrap-dashboard.css?v=2.0.1')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

<script src="{{asset('assets/js/jquery.3.2.1.min.js')}}"></script>
    <!--  Notifications Plugin    -->
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

</head>
<body>
    <div class="wrapper wrapper-full-page">
        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-transparent navbar-absolute ">
            <div class="container">
{{--                <div class="collapse navbar-collapse justify-content-end" id="navbar">--}}
{{--                    <ul class="navbar-nav">--}}
{{--                        <li class="nav-item ">--}}
{{--                            <a href="/register" class="nav-link">--}}
{{--                                <i class="nc-icon nc-badge"></i> Registrarse--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="/login" class="nav-link">--}}
{{--                                <i class="nc-icon nc-mobile"></i> Iniciar sesión--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="full-page  section-image" id="bg" data-color="black" data-image="{{asset('assets/img/prestamos-personales.jpg')}}" ;>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/version3/bootstrap.switch/ -->
<script src="{{asset('assets/js/bootstrap-switch.js')}}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
<!--  Chartist Plugin  -->
<script src="{{asset('assets/js/chartist.min.js')}}"></script>
<!--  Share Plugin -->
<script src="{{asset('assets/js/jquery.sharrre.js')}}"></script>
<!--  jVector Map  -->
<script src="{{asset('assets/js/jquery-jvectormap.js')}}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<!--  DatetimePicker   -->
<script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}"></script>
<!--  Sweet Alert  -->
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<!--  Tags Input  -->
<script src="{{asset('assets/js/bootstrap-tagsinput.js')}}"></script>
<!--  Sliders  -->
<script src="{{asset('assets/js/nouislider.js')}}"></script>
<!--  Bootstrap Select  -->
<script src="{{asset('assets/js/bootstrap-selectpicker.js')}}"></script>
<!--  jQueryValidate  -->
<!-- <script src="{{asset('assets/js/validate.min.js')}}"></script> -->
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('assets/js/jquery.bootstrap-wizard.js')}}"></script>
<!--  Bootstrap Table Plugin -->
<script src="{{asset('assets/js/bootstrap-table.js')}}"></script>
<!--  DataTable Plugin -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<!--  Full Calendar   -->
<script src="{{asset('assets/js/fullcalendar.min.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=2.0.1')}}"></script>
<!-- Light Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>
<script>
    $(document).ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>
<style>
    #bg {
        position: fixed;
        top: 0;
        left: 0;

        /* Preserve aspet ratio */
        min-width: 100%;
        min-height: 100%;
    }
</style>
</body>
</html>