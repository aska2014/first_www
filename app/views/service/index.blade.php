@extends('index')

@section('content')
<div class="container triangles-of-section">
    <div class="triangle-up-left"></div>
    <div class="square-left"></div>
    <div class="triangle-up-right"></div>
    <div class="square-right"></div>
</div>
<section class="portfolio_slider_wrapper">
    <div class="container">
        <div class="flexslider" id="portfolio_slider">
            <ul class="slides">
                @foreach($service->images as $image)
                <li class="item" data-thumb="{{ $image->url }}" style="background-image: url({{ $image->url }})">
                    <div class="container">
                        <a href="{{ $image->url }}" class="lightbox_portfolio" title="{{ $service->title }}"></a>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div id="carousel" class="flexslider">
            <ul class="slides">
                @foreach($service->images as $image)
                <li><img src="{{ $image->url }}" alt=""></li>
                @endforeach
            </ul>
        </div>
        <div class="portfolio_details">
            <div class="row">
                <div class="col-sm-9 col-md-9">
                    <h2 class="section_header">{{ trans('titles.about_service') }}</h2>
                    <p>{{ $service->long_description }}</p>
                </div>
                <div class="well col-sm-3 col-md-3">
                    <p><strong>{{ trans('words.date') }}:</strong> {{ date("F Y", strtotime($service->created_at)) }}</p>
                    <p><strong>{{ trans('words.category') }}:</strong> {{ $service->category->title }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@stop