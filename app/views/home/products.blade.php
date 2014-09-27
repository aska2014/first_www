<div class="container">
    <h2 class="section_header fancy centered"> {{ trans('titles.our_products') }}
        <small> {{ trans('titles.our_products_subtitle') }}</small>
    </h2>
    <div class="portfolio_strict row">
        @foreach($productCategories as $category)
        <div class="col-sm-4 col-md-4">
            <div class="portfolio_item wow fadeInUp"><a href="{{ URL::route('product.category', $category->slug) }}">
                    <figure style="background-image:url({{ $category->image->url }})">
                        <figcaption>
                            <div class="portfolio_description">
                                <h3>{{ $category->title }}</h3>
                                <span class="cross"></span>
                            </div>
                        </figcaption>
                    </figure>
                </a></div>
        </div>
        @endforeach
    </div>
    <div class="centered_button"><a class="btn btn-primary" href="{{ URL::route('products') }}">{{ trans('words.more_products') }}</a></div>
</div>