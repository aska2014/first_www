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
                <aside class="widget">
                    <h4>Text Widget</h4>
                    <p>Fugiat dapibus, tellus ac cursus commodo, mauesris condime ntum nibh, ut fermentum mas justo sitters amet risus. Cras mattis cosi sectetut amet fermens etrsaters tum aecenas faucib sadips amets.</p>
                </aside>
                <aside class="widget ads clearfix">
                    <h4>Ads</h4>
                    <a href="#"><img src="http://placehold.it/110" alt=""></a> <a href="#"><img src="http://placehold.it/110" alt=""></a> <a href="#"><img src="http://placehold.it/110" alt=""></a> <a href="#"><img src="http://placehold.it/110" alt=""></a> </aside>
                <aside class="widget">
                    <h4>Tabs</h4>
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
                        <li class=""><a data-toggle="tab" href="#tags">Tags</a></li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div id="recent" class="tab-pane fade active in">
                            <ul class="media-list">
                                <li class="media"> <a href="#" class="media-photo" style="background-image:url(images/portfolio/t5.jpg)"></a> <a href="#" class="media-date">19<span>FEB</span></a>
                                    <h5 class="media-heading"><a href="#">Media heading, this is a title of a news...</a></h5>
                                    <p>Fugiat dapibus, tellus ac cursus commodo, ut fermentum...</p>
                                </li>
                                <li class="media"> <a href="#" class="media-photo" style="background-image:url(images/portfolio/t4.jpg)"></a> <a href="#" class="media-date">18<span>FEB</span></a>
                                    <h5 class="media-heading"><a href="#">Media heading, of a news item.</a></h5>
                                    <p>Fugiat dapibus, tellus ac cursus commodo, condime ntum nibh, ut fermentum...</p>
                                </li>
                                <li class="media"> <a href="#" class="media-photo" style="background-image:url(images/portfolio/t5.jpg)"></a> <a href="#" class="media-date">17<span>FEB</span></a>
                                    <h5 class="media-heading"><a href="#">Media heading, this is a title of a news...</a></h5>
                                    <p>Fugiat dapibus, tellus ac cursus commodo, ut fermentum...</p>
                                </li>
                                <li class="media"> <a href="#" class="media-photo" style="background-image:url(images/portfolio/t4.jpg)"></a> <a href="#" class="media-date">16<span>FEB</span></a>
                                    <h5 class="media-heading"><a href="#">Media heading, of a news item.</a></h5>
                                    <p>Fugiat dapibus, tellus ac cursus commodo, condime ntum nibh, ut fermentum...</p>
                                </li>
                            </ul>
                        </div>
                        <div id="tags" class="tab-pane fade"> <a class="label label-default">Default</a> <a class="label label-primary">Primary</a> <a class="label label-success">Success</a> <a class="label label-warning">Warning</a> <a class="label label-danger">Danger</a> <a class="label label-info">Info</a> <a class="label label-default">Default</a> <a class="label label-success">Success</a> <a class="label label-danger">Danger</a> <a class="label label-info">Info</a> <a class="label label-default">Default</a> <a class="label label-success">Success</a> <a class="label label-success">Success</a> <a class="label label-warning">Warning</a> <a class="label label-danger">Danger</a> <a class="label label-warning">Warning</a> <a class="label label-warning">Warning</a> <a class="label label-danger">Danger</a> <a class="label label-info">Info</a> <a class="label label-inverse">Inverse</a> </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@stop