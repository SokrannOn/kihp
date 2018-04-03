<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KIHP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

    {{--sweet alert--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    {{--  select2 css  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    {{--data table--}}
    <link rel="stylesheet" href="{{asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    {{--end data table--}}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{asset('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js')}}"></script>
    <script src="{{asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    {{--sweet aler--}}
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js')}}"></script>

    <!-- Google Font -->
    <link rel="stylesheet" href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic')}}">

    {{--dateTime Picker--}}
    {{--<link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">--}}

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">KIHP</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">KIHP</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->


                    <!-- <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success">4</span>
                        </a>
                    </li> -->
                    <!-- Notifications: style can be found in dropdown.less -->


                   <!--  <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">10</span>
                        </a>

                    </li>


                    Tasks: style can be found in dropdown.less

                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">9</span>
                        </a>

                    </li> -->

                    <li class="dropdown tasks-menu">
                        {!! Form::select('locale',['en'=>'English','kh'=>'ខ្មែរ'],Lang::locale(),['id'=>'locale','class'=>'margin-top-23 kh-os']) !!}
                    </li>

                    {{--start user log out--}}
                <!-- start User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/photo/{{Auth::user()->photo}}" class="user-image" alt="User Image" style="background: white;border:2px solid green;padding:1px;">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{!! Auth::user()->username !!}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="/photo/{{Auth::user()->photo}}" class="img-circle" alt="User Image" style="background: white;border:2px solid blue;padding:1px;">

                                <p>
                                    {!! Auth::user()->username !!} - {!! Auth::user()->position->name !!}
                                    <small>{!! Auth::user()->email !!} </small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" onclick='viewUser("{!! Auth::user()->id !!}")' class="btn btn-default btn-flat" data-toggle="modal" data-target="#viewUser" style="border-radius: 5px;"><i class="fa fa-eye"></i> <span class="{{Lang::locale()==='kh'? 'kh-os': 'arial'}}">{{trans('label.profile')}}</span></a>
                                </div>
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();" style="border-radius: 5px;"><i class="fa fa-sign-out"></i>
                                        <span class="{{Lang::locale()==='kh'? 'kh-os': 'arial'}}">{{trans('label.logout')}}</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    {{--end user log out--}}

                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/photo/{{Auth::user()->photo}}" class="img-circle" style="background: white;border:2px solid green;padding:1px; height: 46px" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{!! Auth::user()->username !!}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                          <i class="fa fa-search"></i>
                        </button>
                      </span>
                </div>
            </form>
            @include('admin.nav.admin')

        {{--@include('admin.nav.aside')--}}
            <!-- sidebar: style can be found in sidebar.less -->
        {{--  @include('admin.nav.aside')  --}}
        {{--@php--}}
            {{--$collection1 = Session::get('collection1');--}}
        {{--@endphp--}}
        {{--@foreach($collection1 as $menu)--}}
            {{--@include($menu)--}}
        {{--@endforeach--}}

        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <!-- Modal -->
        <div id="viewUser" class="modal fade" role="dialog">
            <div id="viewUser">

            </div>
        </div>
        @yield('content')

        {{--@yield('datetimepicker')--}}
        {{--<script src="{{asset('js/jquery-1.8.3.min.js')}}"></script>--}}

    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">

            <b>Develop By &nbsp;</b> Oem Sroun

        </div>
        <strong>Copyright &copy; 2017-2018</strong>
    </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap  -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('bower_components/Chart.js/Chart.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->

{{--text editor--}}
<script src="{{asset('//cdn.tinymce.com/4/tinymce.min.js')}}"></script>



<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('//cdn.tinymce.com/4/tinymce.min.js')}}"></script>

@yield('script')
{{--datetimepicker--}}
{{--<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>--}}
{{--  select2  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('js/query.js')}}"></script>


<script type="text/javascript">
    $('#locale').on('change',function () {
        var locale= $('#locale').val();
        $.ajax({
            type : 'get',
            url  : "{{url('/admin/locale')}}"+"/"+locale,
            success:function(){
                window.location.reload();
            }
        });
    });

    function viewUser(id) {
        $.ajax({
            type: 'get',
            url:"{{url('/admin/user/view')}}"+"/"+id,
            dataType: 'html',
            success:function (data) {
                $('#viewUser').html(data);
            },
            error:function (error) {
                console.log(error);
            }

        });
    }
</script>



</body>
</html>
