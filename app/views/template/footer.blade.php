<section class="twitter_feed_wrapper skincolored_section">
    <div class="container">
        <div class="row">
            <div class="twitter_feed_icon wow fadeInDown"><a href="https://twitter.com/PlethoraThemes"><i
                        class="fa fa-twitter"></i></a></div>
            <div id="twitter_flexslider" class="flexslider">
                <ul class="slides">
                    <li class="item">
                        <blockquote>
                            <p> This Clean Flexible Multipurpose Bootstrap 3.1.1 HTML5 Template will soon become a
                                Wordpress theme with great support! <a href="#">http://unhub.com/LIot</a> — Plethora
                                Themes (@plethorathemes) <a href="https://twitter.com/plethorathemes/">April 4
                                    2014</a></p>
                        </blockquote>
                    </li>
                    <li class="item">
                        <blockquote>
                            <p> 'Game of Thrones' Opening Sequence Reimagined With Social Media http://flip.it/3AiCh
                                via @mashable </p>
                        </blockquote>
                    </li>
                    <li class="item">
                        <blockquote>
                            <p> SEO expert debunks 5 of the biggest SEO myths @CreativeBloQ
                                http://www.creativebloq.com/business/seo-expert-debunks-5-biggest-seo-myths-21410786
                                … </p>
                        </blockquote>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<footer>
    <section class="footer_teasers_wrapper dark_section">
        <div class="container triangles-of-section">
            <div class="triangle-up-left"></div>
            <div class="square-left"></div>
            <div class="triangle-up-right"></div>
            <div class="square-right"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="footer_teaser pl_about_us_widget col-sm-4 col-md-4">
                    <h3>{{ trans('footer.contact_details') }}</h3>

                    <p>{{ $contactDetails->company_name }}
                        <br>
                        {{ $contactDetails->address }}
                    </p>
                    <p><i class="fa fa-envelope"></i> {{ $contactDetails->email }}</p>

                    <p><i class="fa fa-phone"></i> {{ $contactDetails->mobile_no }}</p>

                    <div class="footer_social">
                        <div class="social_wrapper"><a href="https://www.facebook.com/plethorathemes"><i
                                    class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-youtube"></i></a> <a
                                href="#googleplus"><i class="fa fa-google-plus"></i></a></div>
                    </div>
                </div>
                <div class="footer_teaser pl_latest_news_widget col-sm-4 col-md-4">
                    <h3>{{ trans('footer.our_services') }}</h3>
                    <ul class="media-list">
                        @foreach($footerServices as $service)
                        @if($service->mainImage)
                        <li class="media"><a href="{{ URL::route('service', $service->slug) }}" class="media-photo"
                                             style="background-image:url({{ $service->mainImage->addOperation('fit', 70, 70)->cached_url }})"></a> <a
                                href="{{ URL::route('service', $service->slug) }}" class="media-date">19<span>FEB</span></a>
                            <h5 class="media-heading"><a href="#">{{ $service->title }}</a>
                            </h5>

                            <p>{{ str_limit($service->long_description, 56, '...') }}</p>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="footer_teaser pl_flickr_widget col-sm-4 col-md-4" id="latest-flickr-images">
                    <h3>{{ trans('footer.our_products') }}</h3>
                    <ul>
                        <?php $i = 0; ?>
                        @foreach($productImages as $productImage)
                        <?php $i++ ?>
                        <li class="flickr-image no-{{$i}}">
                            <a rel="prettyPhoto" href="{{ $productImage->addOperation('fit', 70, 70)->cached_url }}">
                                <img src="{{ $productImage->addOperation('fit', 70, 70)->cached_url }}" />
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    {{ trans('footer.copyrights') }}
                </div>
                <div class="col-sm-4 col-md-4"></div>
            </div>
        </div>
    </div>
</footer>