<section class="call_to_action dark_section">
    <div class="container">
        <h3>
            <strong>
                <span class="rotate">
                    @foreach($infoSliders as $infoSlider)
                        @if($infoSlider->title)
                            {{ $infoSlider->title }} ,
                        @endif
                    @endforeach
                </span>
            </strong>
        </h3>
</section>