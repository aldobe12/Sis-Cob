<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

{{--	<meta charset="utf-8" />--}}

    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.ico')}}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SysCob</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <script src="extensions/export/bootstrap-table-export.js"></script>

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <div class="wrapper">
        <div class="sidebar" id="sidebar" data-color="blue">

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text logo-mini">

                    </a>
                    <a href="#" class="simple-text logo-normal">
                            {{--NOMBRE DEL DOMINIO--}}
                    </a>
                </div>
                <div class="user">
                    <div class="photo">
                        <img src="{{asset('assets/img/default-avatar.png')}}" />
                    </div>
                    <div class="info">
{{--                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">--}}
                        <a data-toggle="collapse"  class="collapsed">
                            <span> {{Auth::user()->name}}
                                <b class="caret"></b>
                            </span>
                        </a>
{{--                        <div class="collapse" id="collapseExample">--}}
{{--                            <ul class="nav" id="nav">--}}
{{--                                <li>--}}
{{--                                    <a class="profile-dropdown" href="#">--}}
{{--                                        <span class="sidebar-normal">Perfil</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="profile-dropdown" href="#">--}}
{{--                                        <span class="sidebar-normal">Editar Perfil</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a class="profile-dropdown" href="#pablo">--}}
{{--                                        <span class="sidebar-normal">Configuraci&oacute;n</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="/dashboard">
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <p>
                                Clientes
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse " id="componentsExamples">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('clientes.create') }}">
                                        <span class="sidebar-normal">Nuevo Cliente</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/clientes">
                                        <span class="sidebar-normal">Listado  clientes</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <p>
                                Prestamos
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse " id="formsExamples">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('prestamos.create') }}">
                                        <span class="sidebar-normal">Nuevo Prestamo</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/prestamos">
                                        <span class="sidebar-normal">Listado Prestamos</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/pagos/index" disabled="true">
                            <i class="fa fa-briefcase" aria-hidden="true"></i>
                            <p>Pagos</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="/cobros/index">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                            <p>Cobros</p>
                        </a>
                    </li>
                    @if(Auth::user()->roles->first()->name == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#componentsExamples1">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                                <p>
                                    Usuarios

                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse " id="componentsExamples1">
                                <ul class="nav">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="{{ route('usuarios.create') }}">
                                            <span class="sidebar-normal">Nuevo Usuario</span>
                                        </a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="/usuarios">
                                            <span class="sidebar-normal">Listado Usuarios</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endif


                </ul>
            </div>
        </div>



        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " >
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize" >
                            <button id="minimizeSidebar" class="btn btn-info btn-fill btn-round btn-icon d-none d-lg-block">
                                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="/dashboard"> Créditos BRATVA </a>
                    </div>
{{--                    <button id="btnopenMenu" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--                        <span class="navbar-toggler-bar burger-lines"></span>--}}
{{--                        <span class="navbar-toggler-bar burger-lines"></span>--}}
{{--                        <span class="navbar-toggler-bar burger-lines"></span>--}}
{{--                    </button>--}}
                    <div class="collapse navbar-collapse justify-content-center">
                        <ul class="nav navbar-nav mr-auto">
                            {{--<form class="navbar-form navbar-left navbar-search-form" role="search">--}}
                                {{--<div class="input-group">--}}
                                    {{--<i class="nc-icon nc-zoom-split"></i>--}}
                                    {{--<input type="text" value="" class="form-control" placeholder="Buscar...">--}}
                                {{--</div>--}}
                            {{--</form>--}}
                        </ul>
                        <ul class="navbar-nav" id="navbar">
                            {{--<li class="dropdown nav-item">--}}
                                {{--<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">--}}
                                    {{--<i class="nc-icon nc-bell-55"></i>--}}
                                    {{--<span class="notification">5</span>--}}
                                    {{--<span class="d-lg-none">Alerta</span>--}}
                                {{--</a>--}}
                                {{--<ul class="dropdown-menu">--}}
                                    {{--<a class="dropdown-item" href="#">Alerta 1</a>--}}
                                    {{--<a class="dropdown-item" href="#">Alerta 2</a>--}}
                                    {{--<a class="dropdown-item" href="#">Alerta 3</a>--}}
                                    {{--<a class="dropdown-item" href="#">Alerta 4</a>--}}
                                    {{--<a class="dropdown-item" href="#">Alerta 5</a>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="nc-icon nc-bullet-list-67"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    {{--<a class="dropdown-item" href="#">--}}
                                        {{--<i class="nc-icon nc-umbrella-13"></i> Ayuda--}}
                                    {{--</a>--}}
                                    {{--<a class="dropdown-item" href="#">--}}
                                        {{--<i class="nc-icon nc-settings-90"></i> Configuraci&oacute;n--}}
                                    {{--</a>--}}
                                    <div class=""></div>
                                    <a href="/logout" class="dropdown-item text-danger">
                                        <i class="nc-icon nc-button-power"></i> Cerrar sesi&oacute;n
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="data-pjax">
                @yield('content')
            </div>
        </div>
        <!-- /page content -->

    <!-- /footer content -->
    </div>
</div>



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
<script type="text/javascript">
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();

        $('#minimizeSidebar').click(function() {
            document.body.classList.toggle('sidebar-mini');
        });

    });
</script>
</body>
</html>