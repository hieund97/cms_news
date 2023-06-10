<aside class="homeslider">
    <div id='sync1' class="owl-carousel">
        @foreach ($sliders as $item)
        <div class="item">
            <a @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif href="{{ $item->link }}">
                <img class="img-fluid" src="{{ get_image_url($item->thumbnail, 'slider_home') }}" alt="{{ $item->title }}">
            </a>
        </div>
        @endforeach
    </div>
    <div id='sync2' class="owl-carousel border">
        @foreach ($sliders as $item)
        <div class="item">
            <h3>
                {{ $item->title }}
            </h3>
        </div>
        @endforeach
    </div>

</aside>
@push('scripts')
<script>
$(document).ready(function() {
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var thumbnailItemClass = '.owl-item';

    var slides = sync1.owlCarousel({
        startPosition: 1,
        items: 1,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        dots: false,
        lazyLoad : true,
        navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>']
    }).on('changed.owl.carousel', syncPosition);

    sync1.on('click', '.owl-next', function () {
        sync2.trigger('next.owl.carousel');
    });
    sync1.on('click', '.owl-prev', function () {
        sync2.trigger('prev.owl.carousel');
    });
    function syncPosition(el) {
        $owl_slider = $(this).data('owl.carousel');
        var loop = $owl_slider.options.loop;

        if (loop) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
        } else {
            var current = el.item.index;
        }

        var owl_thumbnail = sync2.data('owl.carousel');
        var itemClass = "." + owl_thumbnail.options.itemClass;


        var thumbnailCurrentItem = sync2
            .find(itemClass)
            .removeClass("synced")
            .eq(current);

        thumbnailCurrentItem.addClass('synced');

        if (!thumbnailCurrentItem.hasClass('active')) {
            var duration = 300;
            sync2.trigger('to.owl.carousel', [current, duration, true]);
        }
    }
    var thumbs = sync2.owlCarousel({
            startPosition: 1,
            //items: 5,
            loop: false,
            margin: 10,
            autoplay: false,
            nav: false,
            dots: false,
            lazyLoad : true,
            onInitialized: function(e) {
                var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
                thumbnailCurrentItem.addClass('synced');
            },
            responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
        })
        .on('click', thumbnailItemClass, function(e) {
            e.preventDefault();
            var duration = 600;
            var itemIndex = $(e.target).parents(thumbnailItemClass).index();
            sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
        }).on("changed.owl.carousel", function(el) {
            var number = el.item.index;
            $owl_slider = sync1.data('owl.carousel');
            $owl_slider.to(number, 100, true);
        });
});
</script>
@endpush
