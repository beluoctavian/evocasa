<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Evocasa @yield('title', '- Agentie imobiliara')</title>
	<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <!-- Bootstrap Core CSS & Font-Awesome -->
    <link href="{{ URL::asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">


    <!-- jQuery -->
    <script src="{{ URL::asset('js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet">

    <!-- Select2 -->
    <link href="{{ URL::asset('library/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('library/select2/dist/js/select2.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

    <!-- Custom CSS & Javascript -->
    <link href="{{ URL::asset('css/defaults.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

    @yield('in-head')
</head>

<body>

<a href="javascript:" id="go-up"><i class="fa fa-chevron-up"></i></a>

@if(Auth::guest())
<!-- Top-bar -->
<section class="top-bar hidden-xs hidden-sm">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
                <a href="{{ URL::to('login') }}" class="last"><i class="fa fa-user"></i> Login</a>
            </div>
            <div class="col-xs-6">
                <div class="pull-right"><a href="http://www.octavianbelu.ro" target="_blank" class="last">Web design si dezvoltare: <b>OctavianBelu.ro</b></a></div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.section .top-bar -->
@else
<!-- Navigation for authenticated users-->
<div class="settings-sm hidden-md hidden-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="/advert/add"><i class="fa fa-file"></i> Adauga anunt</a>
                <a href="{{ URL::to('settings') }}"><i class="fa fa-cogs"></i> Setari</a>
                <a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-user hidden-xs hidden-sm" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#user-navigation-bar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="user-navigation-bar">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Esti logat ca: {{ Auth::user()->name }}</a>
                </li>
                <li>
                    <a href="{{ URL::to('advert/add') }}"><i class="fa fa-file"></i> Adauga anunt</a>
                </li>
                <li>
                    <a href="{{ URL::to('settings') }}"><i class="fa fa-cogs"></i> Setari</a>
                </li>
                <li class="last">
                    <a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
@endif
<!-- Logo-bar -->
<section class="logo-bar hidden-md hidden-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <a class="logo" href="{{ URL::to('/') }}"><img src="{{ URL::asset('img/evocasa_logo_big.jpg') }}"></a>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.section .logo-bar -->

<section class="logo-bar hidden-xs hidden-sm">
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                <a class="logo" href="{{ URL::to('/') }}"><img src="{{ URL::asset('img/evocasa_logo_big.jpg') }}"></a>
            </div>
            <div class="col-xs-8 text-right hidden-xs hidden-sm">
                <div class="info-block bordered">
                    <p class="title"><i class="fa fa-phone"></i> Telefon</p>
                    <p class="description">0773 937 205 | 0773 937 217</p>
                </div>
                <div class="info-block">
                    <p class="title"><i class="fa fa-envelope"></i> Adresa e-mail</p>
                    <p class="description">office@evocasainvest.ro</p>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.section .logo-bar -->

<!-- Navigation -->
<nav class="navbar navbar-guest hidden-xs hidden-sm" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand hidden-md hidden-lg" href="{{ URL::to('/') }}">Logo here</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="home-link">
                    <a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                <li class="apartament-link">
                    <a href="{{ URL::to('anunturi?tip=apartament') }}"><i class="fa fa-files-o"></i> Apartamente</a>
                </li>
                <li class="casa-link">
                    <a href="{{ URL::to('anunturi?tip=casa') }}"><i class="fa fa-home"></i> Case / Vile</a>
                </li>
                <li class="teren-link">
                    <a href="{{ URL::to('anunturi?tip=teren') }}"><i class="fa fa-globe"></i> Terenuri</a>
                </li>
                <li class="servicii-link">
                    <a href="{{ URL::to('servicii') }}"><i class="fa fa-credit-card"></i> Servicii si costuri</a>
                </li>
                <li class="despre-link">
                    <a href="{{ URL::to('despre-noi') }}"><i class="fa fa-users"></i> Despre noi</a>
                </li>
                <li class="contact-link last">
                    <a href="{{ URL::to('contact') }}"><i class="fa fa-envelope-o"></i> Contact</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>

<div class="main-nav-sm hidden-md hidden-lg">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center navbar-select-container">
                <select id="navbar-select" name="navbar" onchange="window.location = this.options[this.selectedIndex].value;">
                    <option value="">Selecteaza pagina...</option>
                    <option class="home-option" value="{{ URL::to('/') }}">Home</option>
                    <option class="apartament-option" value="{{ URL::to('anunturi?tip=apartament') }}">Apartamente</option>
                    <option class="casa-option" value="{{ URL::to('anunturi?tip=casa') }}">Case / Vile</option>
                    <option class="teren-option" value="{{ URL::to('anunturi?tip=teren') }}">Terenuri</option>
                    <option class="servicii-option" value="{{ URL::to('servicii') }}">Servicii si costuri</option>
                    <option class="despre-option" value="{{ URL::to('despre-noi') }}">Despre noi</option>
                    <option class="contact-option" value="{{ URL::to('contact') }}">Contact</option>
                </select>
            </div>
        </div>
    </div>
</div>

@yield('carousel')

@yield('page-header')

<section class="content">
    <div class="container">
        @yield('content')
    </div><!-- /.container -->
</section><!-- /.section .logo-bar -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 footer-item">
                <h2>Despre noi</h2>
                <div>
                    <p>Reprezentam evolutia in domeniul imobiliar, si dorim sa ridicam standardele serviciilor imobiliare din Romania!</p>
                    <p>Citeste mai multe la pagina <a href="{{ URL::to('despre-noi') }}">Despre noi</a>.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 footer-item">
                <h2>Curs valutar BNR</h2>
                <div id="conso-footer">
                    <script type="text/javascript" src="http://www.conso.ro/webmasteri/widget/curs_valutar/curs_valutar.php?title=Case de schimb valutar&header=FFFFFF&header_color=fcbf10&bg_box=FFFFFF">
                    </script>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 footer-item">
                <h2>Informatii utile</h2>
                @if (!empty($info_files))
                    <div>
                        <ul>
                            @foreach ($info_files as $file)
                                    <li>
                                        <a href="{{ URL::to($file->getPath() . '/' . $file->getFilename()) }}">
                                            {{ str_replace(".{$file->getExtension()}", "", $file->getBaseName()) }}
                                        </a>
                                    </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 footer-item">
                <h2>Contact</h2>
                <div>
                    <div><i class="fa fa-phone"></i> 0773 937 217 | 0773 937 205</div>
                    <div><i class="fa fa-envelope"></i> office@evocasainvest.ro</div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="bottom-bar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <a href="http://www.octavianbelu.ro" target="_blank" class="last">Web design si dezvoltare: <b>OctavianBelu.ro</b></a>
            </div>
        </div>
    </div>
</div>

<script>
    var active = null;
    switch(window.location.pathname) {
        case '/':
            active = 'home';
            break;
        case '/anunturi':
            if (window.location.search.search('tip=apartament') >= 0) {
                active = 'apartament';
                break;
            }
            if (window.location.search.search('tip=casa') >= 0) {
                active = 'casa';
                break;
            }
            active = 'teren';
            break;
        case '/servicii':
            active = 'servicii';
            break;
        case '/despre-noi':
            active = 'despre';
            break;
        case '/contact':
            active = 'contact';
            break;
        default:
            active = null;
    }
    if (active) {
        $('.' + active + '-link').addClass('active');
        $('.' + active + '-option').attr('selected', 'selected');
    }
</script>
<!-- smooth scrooling -->
<script type="text/javascript">
    jQuery(document).ready(function() {
        var offset = 250;
        var duration = 600;

        jQuery(window).scroll(function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery('#go-up').fadeIn(200);
            } else {
                jQuery('#go-up').fadeOut(200);
            }
        });

        jQuery('#go-up').click(function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        })
    });
</script>

@yield('scripts')
<script>
    var navbar_select = $('#navbar-select');
    navbar_select.select2({
        placeholder: "Selecteaza pagina...",
        minimumResultsForSearch: Infinity
    });
    $(window).resize(function() {
        navbar_select.select2({
            placeholder: "Selecteaza pagina...",
            minimumResultsForSearch: Infinity
        });
    });
</script>
</body>
</html>
