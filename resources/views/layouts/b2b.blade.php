<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>B2B</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{asset('assets/css/turbo.css')}}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/drop-down.css')}}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="logo">
                <a href="#" class="simple-text">
                    B2B Admin
                </a>
            </div>
            <div class="logo logo-mini">
                <a href="#" class="simple-text">
                    T
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                 
                   <!--   <li>
                        <a href="{{ url('b2bcustomers') }}">
                            <i class="material-icons">dashboard</i>
                            <p>B2B Customers</p>
                        </a>
                    </li> -->

                    <li>
                        <a href="{{ url('B2BCustomerCategory') }}">
                            <i class="material-icons">dashboard</i>
                            <p>B2B Customer Category</p>
                        </a>
                    </li> 

                    <li>
                        <a href="{{ url('B2BCustomerProduct') }}">
                            <i class="material-icons">dashboard</i>
                            <p>B2B Customer Product</p>
                        </a>
                    </li> 

                    <!--  <li>
                        <a href="{{ url('solutionfeature') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Solution Feature</p>
                        </a>
                    </li> -->

                   <!--  <li>
                        <a href="{{ url('tagmanufacturer') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Tag Manufacturer</p>
                        </a>
                    </li>  -->

                    <li>
                        <a href="{{ url('B2BCustomerSelection?flag=catpro') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Categories & Products</p>
                        </a>
                    </li>

                     <li>
                        <a href="{{ url('B2BCustomerSelection?flag=custag') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Customer Tag Group</p>
                        </a>
                    </li>

                     <li>
                        <a href="{{ url('B2BCustomerSelection?flag=cussol') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Customer Solution Feature</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('B2BCustomerSelection?flag=cuscam') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Campaign Management</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('B2BCustomerSelection?flag=custer') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Territory Management</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('B2BCustomerSelection?flag=camter') }}">
                            <i class="material-icons">dashboard</i>
                            <p>B2B Campaign Territory</p>
                        </a>
                    </li>

                    <!--  <li>
                        <a href="{{ url('B2BCustomerSelection?flag=camtag') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Campaign Tag Management</p>
                        </a>
                    </li> -->

                     <!-- <li>
                        <a href="{{ url('B2BCustomerSelection?flag=camqr') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Campaign - QR Code</p>
                        </a>
                    </li> -->

                    <li>
                        <a href="{{ url('TagCustomerSelection') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Campaign Tag Management</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('QRCustomerSelection') }}">
                            <i class="material-icons">dashboard</i>
                            <p>Campaign - QR Code</p>
                        </a>
                    </li>

                     <li>
                        <a href="{{ url('QRCode') }}">
                            <i class="material-icons">dashboard</i>
                            <p>QR Code</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('NFCTagsRollManagement') }}">
                            <i class="material-icons">dashboard</i>
                            <p>NFCTags - Roll Management</p>
                        </a>
                    </li>
                  
                   
                </ul>

            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-absolute" data-topbar-color="blue">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
							<i class="material-icons visible-on-sidebar-regular f-26">keyboard_arrow_left</i>
                            <i class="material-icons visible-on-sidebar-mini f-26">keyboard_arrow_right</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> B2B </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">6</span>
                                    <p class="hidden-lg hidden-md">
                                        Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">You have 5 new messages</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Mike</a>
                                    </li>
                                    <li>
                                        <a href="#">Wish Mary on her birthday!</a>
                                    </li>
                                    <li>
                                        <a href="#">5 warnings in Server Console</a>
                                    </li>
                                    <li>
                                        <a href="#">Jane completed 'Induction Training'</a>
                                    </li>
                                    <li>
                                        <a href="#">'Prepare Marketing Report' is overdue</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">apps</i>
                                    <p class="hidden-lg hidden-md">Apps</p>
                                </a>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">settings</i>
                                    <p class="hidden-lg hidden-md">Settings</p>
                                </a>
                            </li>
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
             		@yield('content')
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('assets/vendors/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/material.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
<!-- Forms Validations Plugin -->
<script src="{{asset('assets/vendors/jquery.validate.min.js')}}"></script>
<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
<script src="{{asset('assets/vendors/moment.min.js')}}"></script>
<!--  Charts Plugin -->
<script src="{{asset('assets/vendors/chartist.min.js')}}"></script>
<!--  Plugin for the Wizard -->
<script src="{{asset('assets/vendors/jquery.bootstrap-wizard.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/vendors/bootstrap-notify.js')}}"></script>
<!-- DateTimePicker Plugin -->
<script src="{{asset('assets/vendors/bootstrap-datetimepicker.js')}}"></script>
<!-- Vector Map plugin -->
<script src="{{asset('assets/vendors/jquery-jvectormap.js')}}"></script>
<!-- Sliders Plugin -->
<script src="{{asset('assets/vendors/nouislider.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js')}}"></script>
<!-- Select Plugin -->
<script src="{{asset('assets/vendors/jquery.select-bootstrap.js')}}"></script>
<!--  DataTables.net Plugin    -->
<script src="{{asset('assets/vendors/jquery.datatables.js')}}"></script>
<!-- Sweet Alert 2 plugin -->
<script src="{{asset('assets/vendors/sweetalert2.js')}}"></script>
<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('assets/vendors/jasny-bootstrap.min.js')}}"></script>
<!--  Full Calendar Plugin    -->
<script src="{{asset('assets/vendors/fullcalendar.min.js')}}"></script>
<!-- TagsInput Plugin -->
<script src="{{asset('assets/vendors/jquery.tagsinput.js')}}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{asset('assets/js/turbo.js')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>

<script src="{{asset('assets/js/custom_form_validation.js')}}"></script>

<script src="{{asset('assets/js/custom_js.js')}}"></script>

<script>
    $(document).ready(function() {
        //md.initSliders()
        demo.initFormExtendedDatetimepickers();

        $('#datatables').DataTable();
        $('#datatables2').DataTable();
    });
</script>
</html>

