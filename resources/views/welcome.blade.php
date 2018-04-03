
@if (Route::has('login'))
    @if (Auth::check())
        <a href="{{ url('/admin') }}">Home</a>
    @else
        <!DOCTYPE html>
        <html lang="{{ app()->getLocale() }}">
        <head>
            <meta charset="utf-8">
            <title>KIHP</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta content="" name="keywords">
            <meta content="" name="description">

            <!-- Favicons -->
            <link href="img/favicon.png" rel="icon">
            <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
            {{--style Css--}}
            <link rel="stylesheet" href="{{asset('css/style_front.css')}}">


            <!-- Google Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

            <!-- Bootstrap CSS File -->
            <link href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

            <!-- Libraries CSS Files -->
            <link href="{{asset('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
            <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
            <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
            <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
            <link href="{{asset('lib/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
            <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

            <!-- Main Stylesheet File -->
            <link href="{{asset('css/style.css')}}" rel="stylesheet">

            <!-- =======================================================
              Theme Name: Reveal
              Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
              Author: BootstrapMade.com
              License: https://bootstrapmade.com/license/
            ======================================================= -->
        </head>

        <body id="body">

        <!--==========================
          Top Bar
        ============================-->
        <section id="topbar" class="d-none d-lg-block">
            <div class="container clearfix">
                <div class="contact-info float-left">
                    <i class="fa fa-envelope-o"></i> <a href="mailto:contact@example.com">contact@example.com</a>
                    <i class="fa fa-phone"></i> +885 123-456
                </div>

                <div class="social-links float-right">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="linkedin">
                        <i>
                        </i>
                    </a>
                </div>
            </div>
        </section>

        <!--==========================
          Header
        ============================-->
        <header id="header">
            <div class="container">

                <div id="logo" class="pull-left">
                    <h1><a href="#body" class="scrollto">KH<span>IP</span></a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
                </div>
                @php
                    $locale = Lang::locale();
                    $lid = \App\Language::where('code',$locale)->value('id');
                    $language = \App\Language::find($lid);
                    $category = $language->categories()->where([['trash',0],['parent',null]])->get();
                @endphp
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="{{route('front')}}">Home</a></li>
                        @foreach($category as $cat)
                            @if(count($chil = \App\Category::where('parent',$cat->id)->get()))
                                <li class="menu-has-children"><a href="">{{$cat->pivot->name}}</a>
                                    <ul>
                                        @foreach($chil as $c)
                                            @foreach($language->categories()->where('category_id',$c->id)->get() as $v)
                                                <li><a href="#">{{$v->pivot->name}}</a></li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="#about">{{$cat->pivot->name}}</a></li>
                            @endif
                        @endforeach
                        {{--<li><a href="#services">Services</a></li>--}}
                        {{--<li><a href="#portfolio">Portfolio</a></li>--}}
                        {{--<li><a href="#team">Team</a></li>--}}
                        {{--<li class="menu-has-children"><a href="">Drop Down</a>--}}
                            {{--<ul>--}}
                                {{--<li><a href="#">Drop Down 1</a></li>--}}
                                {{--<li><a href="#">Drop Down 3</a></li>--}}
                                {{--<li><a href="#">Drop Down 4</a></li>--}}
                                {{--<li><a href="#">Drop Down 5</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        <li><a href="#contact">Contact</a></li>
                        <li><a>
                                @php
                                    $language = \App\Language::where('active',1)->pluck('name','code');
                                @endphp
                                {!! Form::select('locale',$language,Lang::locale(),['id'=>'locale','onchange'=>'switchLang()','class'=> Lang::locale()=='kh' ? 'kh-os' : 'arial','style'=>'border:none;outline:none']) !!}
                        </a></li>

                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->

        <!--==========================
          Intro Section
        ============================-->
        <section id="intro">

            <div class="intro-content">
                <h2>Making <span>your ideas</span><br>happen!</h2>
                <div>
                    <a href="#about" class="btn-get-started scrollto">Get Started</a>
                    <a href="#portfolio" class="btn-projects scrollto">Our Projects</a>
                </div>
            </div>

            <div id="intro-carousel" class="owl-carousel" >
                <div class="item" style="background-image: url('img/intro-carousel/1.jpg');"></div>
                <div class="item" style="background-image: url('img/intro-carousel/2.jpg');"></div>
                <div class="item" style="background-image: url('img/intro-carousel/3.jpg');"></div>
                <div class="item" style="background-image: url('img/intro-carousel/4.jpg');"></div>
                <div class="item" style="background-image: url('img/intro-carousel/5.jpg');"></div>
            </div>

        </section><!-- #intro -->

        <main id="main">
            @yield('content')
        </main>

        <!--==========================
          Footer
        ============================-->
        <footer id="footer">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong>Reveal</strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!--
                      All the links in the footer should remain intact.
                      You can delete the links only if you purchased the pro version.
                      Licensing information: https://bootstrapmade.com/license/
                      Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
                    -->
                    <a href="https://bootstrapmade.com/">Free Bootstrap Templates</a> by BootstrapMade
                </div>
            </div>
        </footer><!-- #footer -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="{{asset('lib/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('lib/jquery/jquery-migrate.min.js')}}"></script>
        <script src="{{asset('lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('lib/easing/easing.min.js')}}"></script>
        <script src="{{asset('lib/superfish/hoverIntent.js')}}"></script>
        <script src="{{asset('lib/superfish/superfish.min.js')}}"></script>
        <script src="{{asset('lib/wow/wow.min.js')}}"></script>
        <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('lib/magnific-popup/magnific-popup.min.js')}}"></script>
        <script src="{{asset('lib/sticky/sticky.js')}}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
        <!-- Contact Form JavaScript File -->
        <script src="{{asset('contactform/contactform.js')}}"></script>

        <!-- Template Main Javascript File -->
        <script src="{{asset('js/main.js')}}"></script>
        @yield('script')
        <script type="text/javascript">

            function switchLang() {
                var code = $('#locale').val();
                $.ajax({
                    type : 'get',
                    url  : "{{url('/admin/locale/front')}}"+"/"+code,
                    success:function(){
                        window.location.reload();
//                        alert('message.....');
                    }
                });
            }
        </script>
        </body>
        </html>

    @endif
@endif