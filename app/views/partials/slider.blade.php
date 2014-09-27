@if(isset($sliderItems) && ! $sliderItems->isEmpty())
<section id="slider_wrapper" class="slider_wrapper full_page_photo">
    <div id="main_flexslider" class="flexslider">
        <ul class="slides">
            @foreach($sliderItems as $item)
            <li class="item" style="background-image: url({{ $item->image->url }})">
                <div class="container">
                    <div class="carousel-caption animated bounceInUp">
                        <h1>{{ $item->title }}</h1>

                        <p class="lead skincolored">{{ $item->description }}</p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>

@elseif(isset($page))
<div class="full_page_photo no_photo">
    <div class="hgroup">
        <div class="hgroup_title animated bounceInUp skincolored">
            <div class="container">
                <h1 class="">{{ $page->title }}</h1>
            </div>
        </div>
        <div class="hgroup_subtitle animated bounceInUp ">
            <div class="container">
                <p>{{ $page->description }}</p>
            </div>
        </div>
    </div>
</div>
@endif