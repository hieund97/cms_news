<aside class="homebanner d-flex flex-column justify-content-between h-100 pl-0 pl-lg-2 pl-md-2 pr-lg-3 pr-md-3 pr-0">
    @foreach ($banners as $item)
        <div class="pb-2" style="height: calc(100%/2)">
            <a
                @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif
                    href="{{ $item->link }}"
                class="h-100 d-flex"
            >
                <img
                    class="img-fluid"
                    src="{{ get_image_url($item->thumbnail, 'banner_cat') }}"
                    alt="{{ $item->title }}"
                >
            </a>
        </div>
    @endforeach
</aside>
