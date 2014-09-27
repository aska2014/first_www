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
        <div class="row">
            <div id="leftcol" class="col-sm-8 col-md-8">

                @foreach($projects as $project)
                @if(! $project->images->isEmpty())
                <article class="post">
                    <div class="post_header">
                        <h3 class="post_title"><a href="{{ URL::route('project', $project->slug) }}">{{ $project->title }}</a></h3>
                        <div class="post_sub"><i class="fa-time"></i> {{ date('F d, Y', strtotime($project->created_at)) }}</div>
                    </div>
                    <div class="post_content">
                        <figure><a href="{{ URL::route('project', $project->slug) }}"><img src="{{ $project->images[0]->url }}"></a></figure>
                        <p>{{ $project->long_description }}</p>
                        <a href="{{ URL::route('project', $project->slug) }}" class="btn btn-primary">{{ trans('words.read_more') }}</a> </div>
                </article>
                @endif
                @endforeach

<!--                <div class="pagination_wrapper">-->
<!--                    <ul class="pagination pagination-centered">-->
<!--                        <li class="disabled"><a href="#">«</a></li>-->
<!--                        <li class="active"><a href="#">1</a></li>-->
<!--                        <li><a href="#">2</a></li>-->
<!--                        <li><a href="#">3</a></li>-->
<!--                        <li><a href="#">4</a></li>-->
<!--                        <li><a href="#">5</a></li>-->
<!--                        <li><a href="#">»</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
            </div>

            @include('projects.sidebar')
        </div>
    </div>
</section>
@stop