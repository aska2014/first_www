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
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="portfolio_slider_wrapper">
                    <div class="flexslider" id="portfolio_slider">
                        <ul class="slides">
                            @foreach($project->images as $image)
                            <li class="item" data-thumb="{{ $image->url }}"
                                style="background-image: url({{ $image->url }})">
                                <div class="container"><a href="{{ $image->url }}"
                                                          class="lightbox_portfolio" title="{{ $project->title }}"></a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div id="carousel" class="flexslider">
                        <ul class="slides">
                            @foreach($project->images as $image)
                            <li><img src="{{ $image->url }}" alt=""></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="portfolio_details">
                    <h2 class="section_header">{{ trans('titles.about_project') }}</h2>

                    <p>{{ $project->long_description }}</p>
                    <br>
                    <br>

                    <div>
                        <p><strong>{{ trans('words.date') }}:</strong> {{ date("F Y", strtotime($project->created_at)) }}</p>
                    </div>
                    <br>
                    <br>
            </div>
        </div>

    </div>
</section>

@stop