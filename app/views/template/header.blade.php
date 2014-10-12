<header>
    <div class="container">
        <div class="logo">
            <a class="brand" href="{{ URL::route('home') }}">
                @if($language == 'en')
                <img src="/images/cleanstart_logo.png" alt="Firstchoice logo">
                @else
                <img src="/images/ar_logo.png" alt="Firstchoice logo">
                @endif
            </a>
        </div>
        <div id="mainmenu" class="menu_container">
            <label class="mobile_collapser">{{ trans('header.menu') }}</label>
            <!-- Mobile menu title -->
            <ul>
                <li class="active"><a href="{{ URL::route('home') }}">{{ trans('header.home') }}</a></li>
<!--                <li><a href="about_us.html">{{ trans('header.about') }}</a></li>-->
                <li><a href="{{ URL::route('services') }} ">{{ trans('header.services') }}</a></li>
                <li><a href="{{ URL::route('products') }}">{{ trans('header.products') }}</a></li>
                <li><a href="{{ URL::route('projects') }}">{{ trans('header.projects') }}</a></li>
                @if($aboutUsPage)
                <li><a href="{{ URL::route('page', $aboutUsPage->slug) }}">{{ $aboutUsPage->title }}</a></li>
                @endif
                <li><a href="{{ URL::route('contact_us') }}">{{ trans('header.contact_us') }}</a></li>
                <li><a href="#">{{ trans('header.extra') }}</a>
                    <div class="dmui_dropdown_block full_width" style="background-image: url(/images/empty_logo.png); background-repeat:no-repeat; background-position:{{ $language == 'en' ? 'right' : 'left' }} 50px top 30px; ">
                        <div class="dmui-container">
                            <div class="span3"></div>
                            <div class="dmui-col span3">
                                <div class="dmui-container">
                                    <ul class="dmui-submenu">
                                        @foreach($news->take(5) as $oneNews)
                                        <li><a href="{{ URL::route('news', $oneNews->slug) }}">{{ str_limit($oneNews->title, 8) }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @if($aboutUsPage)
                            <div class="dmui-col span3">
                                <div class="dmui-container">
                                    <ul class="dmui-submenu">
                                        @foreach($aboutUsPage->sections->take(5) as $section)
                                        <li><a href="{{ URL::route('page', $aboutUsPage->slug) }}#{{ $section->slug }}">{{ $section->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="triangle-up-left"></div>
        <div class="triangle-up-right"></div>
    </div>
</header>