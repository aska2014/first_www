<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from plethorathemes.com/cleanstart-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jun 2014 10:36:19 GMT -->
<head>
    <meta charset="utf-8">
    <title>Home | first choice for sport courts</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <!-- All Animations CSS -->
    <link href="/css/animate.css" rel="stylesheet" type="text/css">
    <!-- Image Lightbox CSS-->
    <link rel="stylesheet" href="/css/imagelightbox.css" type="text/css" media="screen">
    <!-- Theme styles and Menu styles -->
    @if($language == 'en')
    <link href="/css/en_style.css" rel="stylesheet" type="text/css">
    <link href="/css/en_mainmenu.css" rel="stylesheet" type="text/css">
    @else
    <link href="/css/ar_style.css" rel="stylesheet" type="text/css">
    <link href="/css/ar_mainmenu.css" rel="stylesheet" type="text/css">
    @endif
    <!-- Call Fontawsome Icon Font from a CDN -->
    <link href="/css/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!--Pace Page Loader -->
    <link rel="stylesheet" href="/js/pace-0.5.1/themes/pace-theme-minimal.css" type="text/css" media="screen"/>
    <!--FlexSlider -->
    <link rel="stylesheet" href="/js/woothemes-FlexSlider-06b12f8/flexslider.css" type="text/css" media="screen">
    <!--Isotope Plugin -->
    <link rel="stylesheet" href="/js/isotope/css/style.css" type="text/css" media="screen">
    <!--Simple Text Rotator -->
    <link href="/css/simpletextrotator.css" rel="stylesheet" type="text/css">
    <!--Style Switcher, You propably want to remove this!-->
    <link href="/css/_style_switcher.css" rel="stylesheet" type="text/css">
    <!--Modernizer Custom -->
    <script type="text/javascript" src="/js/modernizr.custom.48287.js"></script>
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/apple-touch-fa-57x57-precomposed.html">
    <link rel="shortcut icon" href="/favicon.png">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhCFO56k_xL212g8j2LK88wK0I_CRwzDE&amp;sensor=false"></script>

</head>
<body class="sticky_header">
<div class="overflow_wrapper">
@include('template.header')

@include('partials.slider')
<div class="main">

    @yield('content')


    @include('template.footer')

</div>
<script src="/js/jquery-1.10.2.min.js"></script>
<script src="/twitter-bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!--Pace Page Loader -->
<script src="/js/pace-0.5.1/pace.min.js"></script>
<!--FlexSlider -->
<script src="/js/woothemes-FlexSlider-06b12f8/jquery.flexslider-min.js"></script>
<!--Isotope Plugin -->
<script src="/js/isotope/jquery.isotope.min.js" type="text/javascript"></script>
<!--To-Top Button Plugin -->
<script type="text/javascript" src="/js/jquery.ui.totop.js"></script>
<!--Easing animations Plugin -->
<script type="text/javascript" src="/js/easing.js"></script>
<!--WOW Reveal on scroll Plugin -->
<script type="text/javascript" src="/js/wow.min.js"></script>
<!--Simple Text Rotator -->
<script type="text/javascript" src="/js/jquery.simple-text-rotator.js"></script>
<!--The Theme Required Js -->
<script type="text/javascript" src="/js/cleanstart_theme.js"></script>
<!--To collapse the menu -->
<script type="text/javascript" src="/js/collapser.js"></script>
<!--Style Switcher, You probably want to remove this!-->
<script type="text/javascript" src="/js/style_switcher.js"></script>
<!-- the Simplrsmoothscroll script is used to smoothly scroll the page -->
<script src="/js/jquery.mousewheel.min.js"></script>
<script src="/js/jquery.simplr.smoothscroll.js"></script>


<!--To collapse the menu -->
<script type="text/javascript">
    //Smooth scrolling on documentation page
    jQuery('.bs-docs-sidenav a').click(function() {
        var href = $.attr(this, 'href');
        jQuery('html, body').animate({
            scrollTop: jQuery(href).offset().top
        }, 500, function () {
            window.location.hash = href;
        });
        return false;
    });
</script>
    <div class="style_switcher">
    <div class="gear"><i class="fa fa-language"></i></div>
    <div class="styles">
        <h6> Language </h6>
        <ul>
            <li class="style-classic"><i class="fa fa-circle"></i> <a href="{{ URL::route('language', 'en') }}">English</a></li>
            <li class="style-golden"><i class="fa fa-circle"></i><a href="{{ URL::route('language', 'ar') }}">Arabic</a></li>
        </ul>
    </div>
</div>
<!--END Style Switcher-->
</div>
</body>
</html>