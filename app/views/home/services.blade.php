<section class="features_teasers_wrapper">
    <div class="container">
        <h2 class="section_header fancy centered"> {{ trans('titles.our_services') }}
            <small> {{ trans('titles.our_services_subtitle') }}</small>
        </h2>

        <div class="row">
            @foreach($serviceCategories as $category)
            <div class="feature_teaser col-sm-4 col-md-4">

                <img alt="responsive" src="{{ $category->image->url }}">

                <h3>{{ $category->title }}</h3>

                <p>{{ $category->description }}</p>

                <div class="centered_button"><a class="btn btn-primary" href="{{ URL::route('services') }}">{{ trans('words.services') }}</a></div>
            </div>
            @endforeach
        </div>
    </div>
</section>