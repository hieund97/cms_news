<div class="homeslider">
    <div id='sync1' class="owl-carousel">
        @foreach ($sliders as $item)
        <div class="item">
            <a @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif href="{{ $item->link }}">
                <img class="img-fluid" src="{{ get_image_url($item->thumbnail, 'slider_cat') }}" alt="{{ $item->title }}">
            </a>
        </div>
        @endforeach
    </div>
</div>
@push('scripts')
<script>
$(document).ready(function() {

    $("#sync1").owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        nav: true,
        dots: true,
        lazyLoad : true,
        navText : ["‹","›"]
    });
});
</script>
@endpush
