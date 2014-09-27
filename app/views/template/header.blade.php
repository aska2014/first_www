<header>
    <div class="container">
        <div class="logo"><a class="brand" href="{{ URL::route('home') }}"> <img src="/images/cleanstart_logo.png" alt="optional logo">
            </a></div>
        <div id="mainmenu" class="menu_container">
            <label class="mobile_collapser">{{ trans('header.menu') }}</label>
            <!-- Mobile menu title -->
            <ul>
                <li class="active"><a href="{{ URL::route('home') }}">{{ trans('header.home') }}</a></li>
<!--                <li><a href="about_us.html">{{ trans('header.about') }}</a></li>-->
                <li><a href="{{ URL::route('services') }} ">{{ trans('header.services') }}</a></li>
                <li><a href="{{ URL::route('products') }}">{{ trans('header.products') }}</a></li>
                <li><a href="{{ URL::route('projects') }}">{{ trans('header.projects') }}</a></li>
            </ul>
        </div>
        <div class="triangle-up-left"></div>
        <div class="triangle-up-right"></div>
    </div>
</header>