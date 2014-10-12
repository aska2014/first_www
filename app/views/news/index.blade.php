@extends('index')

@section('content')
<div class="container triangles-of-section">
    <div class="triangle-up-left"></div>
    <div class="square-left"></div>
    <div class="triangle-up-right"></div>
    <div class="square-right"></div>
</div>
<section class="with_right_sidebar">
    <div class="container">
        <h2 class="section_header elegant">{{ $news->title }}<small><i class="fa-time"></i> {{ date('F d, Y', strtotime($news->created_at)) }}</small></h2>
        <div class="row">
            <div id="leftcol" class="col-sm-8 col-md-8">
                <article class="post">
                    <div class="post_content">
                        <p>{{ $news->description }}</p>
                    </div>
                </article>
            </div>
            <div id="sidebar" class="col-sm-4 col-md-4">
                <aside class="widget ads clearfix">
                    <h4>{{ trans('words.projects') }}</h4>
                    @foreach($projects as $project)
                        @if(! $project->images->isEmpty())
                        <a href="{{ URL::route('project', $project->slug) }}">
                            <img src="{{ $project->images->first()->addOperation('fit', 110, 110)->cached_url }}">
                        </a>
                        @endif
                    @endforeach
                </aside>
                <aside class="widget">
                    <h4>Tabs</h4>
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
                        <li class=""><a data-toggle="tab" href="#tags">Tags</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div id="recent" class="tab-pane fade active in">
                            <ul class="media-list">
                                @foreach($recentNews as $oneNews)
                                <li class="media">
                                    @if(! $oneNews->images->isEmpty())
                                    <a href="{{ URL::route('news', $oneNews->slug) }}" class="media-photo" style="background-image:url({{ $oneNews->images->first()->addOperation('fit', 70, 70)->cached_url }})">

                                    </a>
                                    @endif
                                    <h5 class="media-heading"><a href="#">{{ $oneNews->title }}</a></h5>
                                    <p>{{ str_limit($oneNews->description, 30) }}</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="tags" class="tab-pane fade">
                            <?php
                                $classes = ['default', 'primary', 'success', 'danger'];
                            ?>
                            @foreach($products as $product)
                            <a class="label label-{{ $classes[rand(0, 4)] }}">{{ $product->title }}</a>
                            @endforeach
                            @foreach($services as $service)
                            <a class="label label-{{ $classes[rand(0, 4)] }}">{{ $service->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@stop