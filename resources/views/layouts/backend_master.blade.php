<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name=  "csrf-token" content="{{ csrf_token() }}">
    <title>Admin area</title>
    <meta name="description" content="admin panel description" />
    <meta name="author" content="DHB Design"/>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- select2 CSS -->
    <link href="{{ asset('backend/vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- switchery CSS -->
    <link href="{{ asset('backend/vendors/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- bootstrap-select CSS -->
    <link href="{{ asset('backend/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- bootstrap-tagsinput CSS -->
    <link href="{{ asset('backend/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
    <!-- bootstrap-touchspin CSS -->
    <link href="{{ asset('backend/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- multi-select CSS -->
    <link href="{{ asset('backend/vendors/bower_components/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Switches CSS -->
    <link href="{{ asset('backend/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Colorpicker CSS -->
    <link href="{{ asset('backend/vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Datetimepicker CSS -->
    <link href="{{ asset('backend/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{ asset('backend/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('backend/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Fancy-Buttons CSS -->
    <link href="{{ asset('backend/dist/css/fancy-buttons.css') }}" rel="stylesheet" type="text/css">
    <!-- notifications css -->
    <link href="{{ asset('backend/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.css') }}" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="{{ asset('backend/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Summernote css -->
    <link rel="stylesheet" href="{{ asset('backend/vendors/bower_components/summernote/dist/summernote.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/dist/css/custom.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" integrity="sha256-bLNUHzSMEvxBhoysBE7EXYlIrmo7+n7F4oJra1IgOaM=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js" integrity="sha256-JIBDRWRB0n67sjMusTy4xZ9L09V8BINF0nd/UUUOi48=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" integrity="sha256-e47xOkXs1JXFbjjpoRr1/LhVcqSzRmGmPqsrUQeVs+g=" crossorigin="anonymous" />
</head>

<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->
<div class="wrapper theme-1-active pimary-color-green">
    <!-- Top Menu Items -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="mobile-only-brand pull-left">
            <div class="nav-header pull-left">
                <div class="logo-wrap">
                    <a href="#">
                        <img class="brand-img" src="{{ asset('dhb-logo.png') }}" alt="brand"/>
                        {{--                        <span class="brand-text">DHB GRAPHICS</span>--}}
                    </a>
                </div>
            </div>
            <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);">
                <i class="zmdi zmdi-menu"></i>
            </a>
            <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view"
               href="javascript:void(0);">
                <i class="zmdi zmdi-search"></i>
            </a>
            <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);">
                <i class="zmdi zmdi-more"></i>
            </a>
            {{--            <form id="search_form" role="search" class="top-nav-search collapse pull-left">--}}
            {{--                <div class="input-group">--}}
            {{--                    <input type="text" name="example-input1-group2" class="form-control" placeholder="Search">--}}
            {{--                    <span class="input-group-btn">--}}
            {{--						<button type="button" class="btn  btn-default"  data-target="#search_form"--}}
            {{--                                data-toggle="collapse" aria-label="Close" aria-expanded="true">--}}
            {{--                            <i class="zmdi zmdi-search"></i>--}}
            {{--                        </button>--}}
            {{--					</span>--}}
            {{--                </div>--}}
            {{--            </form>--}}
        </div>


        <div id="mobile_only_nav" class="mobile-only-nav pull-right">

            <ul class="nav navbar-right top-nav pull-right">
                <li>
                    <a id="open_right_sidebar" href="#"><i class="zmdi zmdi-settings top-nav-icon"></i></a>
                </li>

                <!--notification li -->
                <li class="dropdown alert-drp">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="zmdi zmdi-notifications top-nav-icon"></i>
                        <span class="top-nav-icon-badge">0</span>
                    </a>
                    <ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                        <li>
                            <div class="notification-box-head-wrap">
                                <span class="notification-box-head pull-left inline-block">notifications</span>
                                <a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all </a>
                                <div class="clearfix"></div>
                                <hr class="light-grey-hr ma-0"/>
                            </div>
                        </li>
                        <li>
                            <div class="streamline message-nicescroll-bar">
                                <div class="sl-item">
                                    <a href="javascript:void(0)">
                                        <div class="icon bg-green">
                                            <i class="zmdi zmdi-flag"></i>
                                        </div>

                                        <div class="sl-content">
												<span class="inline-block capitalize-font  pull-left truncate head-notifications">
												New notification title</span>
                                            <span class="inline-block font-11  pull-right notifications-time">2pm</span>
                                            <div class="clearfix"></div>
                                            <p class="truncate">notification text here</p>
                                        </div>
                                    </a>
                                </div>
                                <hr class="light-grey-hr ma-0"/>

                                <div class="sl-item">
                                    <a href="javascript:void(0)">
                                        <div class="icon bg-red">
                                            <i class="zmdi zmdi-storage"></i>
                                        </div>
                                        <div class="sl-content">
                                            <span class="inline-block capitalize-font  pull-left truncate head-notifications txt-danger">
                                               notofication title</span>
                                            <span class="inline-block font-11  pull-right notifications-time">1pm</span>
                                            <div class="clearfix"></div>
                                            <p class="truncate">notification body text</p>
                                        </div>
                                    </a>
                                </div>

                                <hr class="light-grey-hr ma-0"/>
                            </div>
                        </li>
                        <li>
                            <div class="notification-box-bottom-wrap">
                                <hr class="light-grey-hr ma-0"/>
                                <a class="block text-center read-all" href="javascript:void(0)"> read all </a>
                                <div class="clearfix"></div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!--notification li end-->



                <!-- PROFILE LI START -->
                <li class="dropdown auth-drp">
                    <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                        <img src="{{ asset('avatar.png') }}"
                             alt="{{ Auth::User()->first_name }}"
                             title="{{ Auth::User()->first_name }}"
                             class="user-auth-img img-circle"/>
                        <span class="user-online-status"></span></a>
                    <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                        <li>
                            <a ><i class="zmdi zmdi-account"></i><span>{{ Auth::User()->first_name }}</span></a>
                        </li>
                        <!--  <li>
                              <a href="#"><i class="zmdi zmdi-card"></i><span>my balance</span></a>
                          </li>-->
                        {{--                        <li>--}}
                        {{--                            <a href="#"><i class="zmdi zmdi-email"></i><span>Inbox</span></a>--}}
                        {{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="{{ route('view.profile') }}"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>--}}
{{--                        </li>--}}
                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('logout') }}"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                        </li>
                    </ul>
                </li>

                <!--END  PROFILE LI START -->
            </ul>
        </div>
    </nav>
    <!-- /Top Menu Items -->



    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li class="navigation-header">
                <span>Main</span>
                <i class="zmdi zmdi-more"></i>
            </li>
            <li>
                <a href="{{ route('home') }}" >
                    <div class="pull-left">
                        <i class="zmdi zmdi-home mr-20"></i>
                        <span class="right-nav-text">Dashboard</span></div>
                </a>
            </li>




            <li><hr class="light-grey-hr mb-10"/></li>
            <li class="navigation-header">
                <span>Active Rights.</span>
                <i class="zmdi zmdi-more"></i>
            </li>
            @if(Auth::user()->role === 2)
                {{--            <!-- ****************************** EDITOR ROUTES START **************************** -->--}}

                <li>
                    <a href="#"  >
                        <div class="pull-left">
                            <i class="zmdi zmdi-border-color"></i>
                            <span class="right-nav-text">Example</span>
                        </div>
                        <div class="clearfix">
                        </div>
                    </a>
                </li>

                {{--  <!-- ****************************** EDITOR ROUTES END **************************** -->--}}
            @endif


            @if(Auth::user()->role === 1)
                {{-- <!-- ****************************** ADMIN ROUTES START **************************** -->--}}
                <li>
                    <a href="#" >
                        <div class="pull-left">
                            <i class="zmdi zmdi-border-color"></i>
                            <span class="right-nav-text">Example</span>
                        </div>
                        <div class="clearfix">
                        </div>
                    </a>
                </li>

                {{--            <!-- ******************************  ADMIN ROUTES START **************************** -->--}}
            @endif





            {{--            <!-- ****************************** SUPER ADMIN ROUTES START **************************** -->--}}
            @if(Auth::user()->role === 0)


                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr1">
                        <div class="pull-left">
                            <i class="zmdi zmdi-ticket-star mr-20"></i>
                            <span class="right-nav-text">Categories</span>
                        </div>
                        <div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                        <div class="clearfix"></div></a>
                    <ul id="ui_dr1" class="collapse collapse-level-1 two-col-list">
                        <li>
                            <a href="{{ route('category.index') }}"> List</a>
                        </li>

                        <li>
                            <a href="{{ route('category.create') }}">Add New</a>
                        </li>

                    </ul>
                </li>



                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_attribute">
                        <div class="pull-left">
                            <i class="zmdi zmdi-label mr-20"></i>
                            <span class="right-nav-text">Attributes</span>
                        </div>
                        <div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                        <div class="clearfix"></div></a>
                    <ul id="ui_attribute" class="collapse collapse-level-1 two-col-list">
                        <li>
                            <a href="{{ route('attribute.index') }}">Attribute List</a>
                        </li>

                        <li>
                            <a href="{{ route('attribute.create') }}">Add New</a>
                        </li>

                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_attributedetail">
                        <div class="pull-left">
                            <i class="zmdi zmdi-labels mr-20"></i>
                            <span class="right-nav-text">Attributes Values</span>
                        </div>
                        <div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                        <div class="clearfix"></div></a>
                    <ul id="ui_attributedetail" class="collapse collapse-level-1 two-col-list">
                        <li>
                            <a href="{{ route('attribute-detail.index') }}"> List</a>
                        </li>

                        <li>
                            <a href="{{ route('attribute-detail.create') }}">New</a>
                        </li>

                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_location">
                        <div class="pull-left">
                            <i class="zmdi zmdi-google-maps mr-20"></i>
                            <span class="right-nav-text">Locations</span>
                        </div>
                        <div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                        <div class="clearfix"></div></a>
                    <ul id="ui_location" class="collapse collapse-level-1 two-col-list">
                        <li>
                            <a href="{{ route('locations.index') }}"> List</a>
                        </li>

                        <li>
                            <a href="{{ route('locations.create') }}">New</a>
                        </li>

                    </ul>
                </li>




                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr">
                        <div class="pull-left">
                            <i class="zmdi zmdi-accounts mr-20"></i>
                            <span class="right-nav-text">Users</span>
                        </div>
                        <div class="pull-right">
                            <i class="zmdi zmdi-caret-down"></i>
                        </div>
                        <div class="clearfix"></div></a>
                    <ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
                        <li>
                            <a href="{{ route('users.index') }}">
                                <i class="zmdi zmdi-assignment"></i>
                                User List</a>
                        </li>

                        <li>
                            <a href="{{ route('users.create') }}">
                                <i class="zmdi zmdi-accounts-add"></i>   Add New</a>
                        </li>

                    </ul>
                </li>

            @endif
            {{--<!-- ****************************** SUPER ADMIN ROUTES END **************************** -->--}}




            <li>
                <hr class="light-grey-hr mb-10"/></li>
            <li class="navigation-header">
                <span>featured</span>
                <i class="zmdi zmdi-more"></i>
            </li>

            <li>
                <a target="_blank" href="{{ url('/') }}"><div class="pull-left">
                        <i class="zmdi zmdi-view-web"></i>
                        <span class="right-nav-text">Visit Website</span>
                    </div>
                    <div class="clearfix"></div></a>
            </li>

        </ul>
    </div>
    <!-- /Left Sidebar Menu -->


    <!-- Main Content -->
    <div class="page-wrapper">

        @yield('content')

        @yield('scripts')

        <div class="container-fluid">
            <!-- Footer -->
            <footer class="footer container-fluid pl-30 pr-30">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="pull-right">2019 &copy; Comapany Name. Developed by DHB Graphics.</p>
                    </div>
                </div>
            </footer>
            <!-- /Footer -->
        </div>
    </div>
    <!-- /Main Content -->
</div>
<!-- /#wrapper -->
<!-- JavaScript -->


<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Moment JavaScript -->
<script type="text/javascript" src="{{ asset('backend/vendors/bower_components/moment/min/moment-with-locales.min.js') }}"></script>
<!-- Bootstrap Colorpicker JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Switchery JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
<!-- Select2 JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<!-- Bootstrap Select JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<!-- Bootstrap Tagsinput JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<!-- Bootstrap Touchspin JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
<!-- Multiselect JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
<!-- Bootstrap Switch JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
<!-- Form Advance Init JavaScript -->
<script src="{{ asset('backend/dist/js/form-advance-data.js') }}"></script>
<!-- Slimscroll JavaScript -->
<script src="{{ asset('backend/dist/js/jquery.slimscroll.js') }}"></script>
<!-- Fancy Dropdown JS -->
<script src="{{ asset('backend/dist/js/dropdown-bootstrap-extended.js') }}"></script>
<!-- Owl JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<!-- Init JavaScript -->
<script src="{{ asset('backend/dist/js/init.js') }}"></script>
<!-- Form Flie Upload Data JavaScript -->
<script src="{{ asset('backend/dist/js/form-file-upload-data.js') }}"></script>
<!-- Bootstrap Colorpicker JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Bootstrap Datetimepicker JavaScript -->
<script type="text/javascript" src="{{ asset('backend/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- Bootstrap Daterangepicker JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- Form Picker Init JavaScript -->
<script src="{{ asset('backend/dist/js/form-picker-data.js') }}"></script>
<!-- Bootstrap Daterangepicker JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
<!-- notifications JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
<!-- Init JavaScript -->
<script src="{{ asset('backend/dist/js/toast-data.js') }}"></script>
<!-- Summernote Plugin JavaScript -->
<script src="{{ asset('backend/vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>
<!-- Summernote Wysuhtml5 Init JavaScript -->
<script src="{{ asset('backend/dist/js/summernote-data.js') }}"></script>
<!-- Gallery JavaScript -->
<script src="{{ asset('backend/dist/js/isotope.js') }}"></script>
<script src="{{ asset('backend/dist/js/lightgallery-all.js') }}"></script>
<script src="{{ asset('backend/dist/js/froogaloop2.min.js') }}"></script>
<script src="{{ asset('backend/dist/js/gallery-data.js') }}"></script>
{{-- JS assets at the bottom --}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js" integrity="sha256-cs4thShDfjkqFGk5s2Lxj35sgSRr4MRcyccmi0WKqCM=" crossorigin="anonymous"></script>
<script src="{{ asset('backend/dhb_dev/dhb.js') }}"></script>
@yield('scripts')
</body>
</html>
