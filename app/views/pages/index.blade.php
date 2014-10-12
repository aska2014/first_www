@extends('index')

@section('content')
<div class="container triangles-of-section">
    <div class="triangle-up-left"></div>
    <div class="square-left"></div>
    <div class="triangle-up-right"></div>
    <div class="square-right"></div>
</div>
<div class="container bs-docs-container">
    <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
            <div class="bs-docs-sidebar hidden-print" role="complementary" data-spy="affix" data-offset-top="564">
                <ul class="nav bs-docs-sidenav">
                    @foreach($page->sections as $section)
                    <li><a href="#{{ $section->slug }}">{{ $section->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9" role="main">
            @foreach($page->sections as $section)
            <div class="bs-docs-section">
                <h2 id="{{ $section->slug }}" class="page-header">{{ $section->title }}</h2>
                <p>{{ $section->description }}</p>
                <img src="{{ $section->image->url }}"  alt="main layout" style="border:0px !important;">
            </div>
            @endforeach
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>
@stop