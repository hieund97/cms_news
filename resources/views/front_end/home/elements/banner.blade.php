<aside class="homebanner d-flex flex-column justify-content-between h-100 pl-0 pl-lg-2 pl-md-2 pr-lg-3 pr-md-3 pr-0">
    @foreach ($banners as $item)
    <div class="pb-2" style="height: calc(100%/3)">
        <a @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif class="h-100 d-flex" href="{{ $item->link }}">
            <img class="img-fluid" src="{{ get_image_url($item->thumbnail, 'banner_home') }}" alt="{{ $item->title }}">
        </a>
    </div>
    @endforeach
</aside>
