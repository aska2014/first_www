@extends('index')

@section('content')
<div class="container triangles-of-section">
    <div class="triangle-up-left"></div>
    <div class="square-left"></div>
    <div class="triangle-up-right"></div>
    <div class="square-right"></div>
</div>
<div class="container">
    <section>
        <ul class="portfolio_filters">
            <li><a href="#" data-filter="*">{{ trans('words.show_all') }}</a></li>
            @foreach($serviceCategories as $category)
            @if(isset($selectedCategory) && $category->same($selectedCategory))
            <li><a class="active" href="#" data-filter=".{{ 'category'.$category->id }}">{{ $category->title }}</a></li>
            @else
            <li><a href="#" data-filter=".{{ 'category'.$category->id }}">{{ $category->title }}</a></li>
            @endif
            @endforeach
        </ul>
    </section>
    <section class="portfolio_masonry">
        <div class="row isotope_portfolio_container">
            @foreach($services as $service)
            @if(! $service->images->isEmpty())
            <div class="{{ 'category'.$category->id }} col-sm-4 col-md-4">
                <div class="portfolio_item">
                    <a href="{{ URL::route('service', $service->slug) }}" class="lightbox">

                        <img src="{{ $service->images->first()->url }}" alt="$service->title">

                        <div class="overlay">
                            <div class="desc">
                                <h3>{{ $service->title }}</h3>
                                <span class="cross"></span>
                                <p>{{ strtoupper(trans('words.view_details')) }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </section>
</div>
@stop